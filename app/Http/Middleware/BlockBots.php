<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockBots
{
    /**
     * Specific IPs confirmed as bot sources (AWS EC2 Ohio scrapers identified Apr 2026).
     * Each had 1 "visitor" but 74k–220k hits, consuming ~107 GiB of bandwidth.
     */
    private const BLOCKED_IPS = [
        '18.118.22.193',
        '3.20.238.191',
        '3.21.53.113',
        '18.189.17.45',
        '18.117.187.83',
        '3.142.92.177',
        '3.135.232.160',
    ];

    /**
     * AWS EC2 us-east-2 (Ohio) CIDR ranges.
     * Real website visitors never browse from EC2 servers, so blocking the
     * entire region is safe and covers any future IPs from the same campaign.
     * Source: https://ip-ranges.amazonaws.com/ip-ranges.json (service=EC2, region=us-east-2)
     */
    private const BLOCKED_CIDR_RANGES = [
        '3.5.100.0/22',
        '3.5.92.0/23',
        '18.191.0.0/16',
        '35.50.143.0/24',
        '3.132.0.0/14',
        '64.252.74.0/24',
        '18.116.0.0/14',
        '35.96.26.0/23',
        '24.110.8.0/23',
        '3.5.88.0/22',
        '64.252.76.0/24',
        '3.144.0.0/13',
        '3.2.67.0/24',
        '18.34.72.0/21',
        '99.77.153.0/24',
        '35.111.136.0/22',
        '3.5.128.0/22',
        '18.216.0.0/14',
        '18.224.0.0/14',
        '3.131.0.0/16',
        '16.214.56.0/22',
        '35.96.254.0/24',
        '18.190.0.0/16',
        '216.198.194.0/24',
        '192.43.184.0/24',
        '35.111.128.0/22',
        '75.3.128.0/18',
        '99.77.131.0/24',
        '35.50.161.0/24',
        '216.244.8.0/24',
        '15.177.66.0/23',
        '35.71.102.0/24',
        '35.55.34.0/24',
        '216.244.12.0/23',
        '35.96.246.0/24',
        '52.94.248.160/28',
        '18.188.0.0/16',
        '216.198.216.0/21',
        '3.5.132.0/23',
        '18.97.128.0/18',
        '3.5.104.0/22',
        '99.77.162.0/24',
        '99.77.252.0/24',
        '52.15.0.0/16',
        '18.189.0.0/16',
        '110.238.2.0/23',
        '18.220.0.0/14',
        '151.148.32.0/24',
        '35.55.35.0/24',
        '35.50.160.0/24',
        '3.5.108.0/22',
        '3.130.0.0/16',
        '52.14.0.0/16',
        '173.83.228.0/22',
        '18.34.252.0/22',
        '3.12.0.0/16',
        '1.178.86.0/23',
        '35.55.33.0/24',
        '3.136.0.0/13',
        '75.3.0.0/18',
        '16.58.0.0/16',
        '13.58.0.0/15',
        '3.13.0.0/16',
        '99.150.0.0/21',
        '1.178.8.0/24',
        '3.16.0.0/14',
        '35.50.144.0/24',
        '202.174.132.0/22',
        '3.14.0.0/15',
        '3.43.64.0/18',
        '168.185.6.0/24',
        '35.50.142.0/24',
        '198.41.103.0/24',
        '198.99.2.0/24',
        '192.189.197.0/24',
        '3.20.0.0/14',
        '40.235.192.0/18',
        '64.252.77.0/24',
        '16.59.0.0/16',
        '15.129.16.0/21',
        '52.95.251.0/24',
        '64.252.75.0/24',
        '35.111.132.0/22',
        '3.128.0.0/15',
        '173.83.192.0/22',
    ];

    /**
     * Well-known legitimate crawlers — never blocked.
     * These bots are important for SEO and social sharing.
     */
    private const ALLOWED_BOTS = [
        'Googlebot',
        'Googlebot-Image',
        'Googlebot-News',
        'Googlebot-Video',
        'AdsBot-Google',
        'APIs-Google',
        'Google-InspectionTool',
        'bingbot',
        'BingPreview',
        'Slurp',            // Yahoo
        'DuckDuckBot',
        'Baiduspider',
        'facebookexternalhit',
        'Twitterbot',
        'LinkedInBot',
        'WhatsApp',
        'Applebot',
        'ia_archiver',      // Wayback Machine / Archive.org
        'Stripe',
    ];

    /**
     * Known scrapers, AI crawlers, and bandwidth-wasting bots.
     * These are NOT search engines and have no SEO value.
     */
    private const BLOCKED_BOTS = [
        // SEO tool scrapers
        'AhrefsBot',
        'SemrushBot',
        'MJ12bot',
        'DotBot',
        'BLEXBot',
        'SeznamBot',
        'DataForSeoBot',
        'MegaIndex',
        'SEOkicks',
        'sistrix',
        'rogerbot',
        'Screaming Frog',
        // AI training crawlers
        'GPTBot',
        'ClaudeBot',
        'Claude-Web',
        'anthropic-ai',
        'Bytespider',
        'PerplexityBot',
        'OAI-SearchBot',
        'cohere-ai',
        'Diffbot',
        'CCBot',
        // Generic automated clients
        'python-requests',
        'Go-http-client',
        'libwww-perl',
        'Scrapy',
        'masscan',
        'zgrab',
        'Nimbostratus',
        'PetalBot',
        // Headless browsers (not from legitimate Google services)
        'HeadlessChrome',
        'PhantomJS',
    ];

    public function handle(Request $request, Closure $next)
    {
        $clientIp = $request->ip();

        // Fast exact-match block for confirmed attacker IPs
        if (in_array($clientIp, self::BLOCKED_IPS, true)) {
            abort(403);
        }

        // CIDR-range block for entire AWS EC2 us-east-2 region
        if ($clientIp && $this->isIpInBlockedRange($clientIp)) {
            abort(403);
        }

        $userAgent = $request->header('User-Agent', '');

        // Block empty/missing User-Agent on any write method — no real browser omits it
        if (empty($userAgent) && $request->isMethod('post')) {
            abort(403);
        }

        // Allow empty UA on safe read-only methods (some minimal HTTP clients are benign)
        if (empty($userAgent)) {
            return $next($request);
        }

        // Always allow known-good crawlers first
        foreach (self::ALLOWED_BOTS as $allowed) {
            if (stripos($userAgent, $allowed) !== false) {
                return $next($request);
            }
        }

        // Block known bad crawlers and scrapers
        foreach (self::BLOCKED_BOTS as $blocked) {
            if (stripos($userAgent, $blocked) !== false) {
                abort(403);
            }
        }

        return $next($request);
    }

    /**
     * Returns true if the given IPv4 address falls within any blocked CIDR range.
     */
    private function isIpInBlockedRange(string $ip): bool
    {
        $ipLong = ip2long($ip);

        // ip2long returns false for invalid/IPv6 addresses — skip CIDR check
        if ($ipLong === false) {
            return false;
        }

        foreach (self::BLOCKED_CIDR_RANGES as $cidr) {
            [$subnet, $bits] = explode('/', $cidr);
            $mask    = $bits == 0 ? 0 : (~0 << (32 - (int) $bits));
            $netLong = ip2long($subnet);

            if (($ipLong & $mask) === ($netLong & $mask)) {
                return true;
            }
        }

        return false;
    }
}
