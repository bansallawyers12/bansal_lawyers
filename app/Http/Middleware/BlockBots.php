<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockBots
{
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
}
