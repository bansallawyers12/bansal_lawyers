<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CmsPage;
use App\Models\RecentCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /** Public frontend paths with optional priority (defaults to 0.80). */
    private const STATIC_PATHS = [
        '/' => '1.00',
        '/about' => '0.80',
        '/practice-areas' => '0.80',
        '/case' => '0.80',
        '/blog' => '0.80',
        '/contact' => '0.80',
        '/book-an-appointment' => '0.80',
        '/family-law' => '0.80',
        '/migration-law' => '0.80',
        '/criminal-law' => '0.80',
        '/commercial-law' => '0.80',
        '/property-law' => '0.80',
        '/divorce' => '0.80',
        '/divorce-lawyers-melbourne' => '0.80',
        '/child-custody' => '0.80',
        '/family-violence' => '0.80',
        '/property-settlement' => '0.80',
        '/family-violence-orders' => '0.80',
        '/juridicational-error-federal-circuit-court-application' => '0.80',
        '/art-application' => '0.80',
        '/visa-refusals-visa-cancellation' => '0.80',
        '/federal-court-application' => '0.80',
        '/intervenition-orders' => '0.80',
        '/trafic-offences' => '0.80',
        '/drink-driving-offences' => '0.80',
        '/assualt-charges' => '0.80',
        '/business-law' => '0.80',
        '/leasing-or-selling-a-business' => '0.80',
        '/contracts-or-business-agreements' => '0.80',
        '/loan-agreement' => '0.80',
        '/conveyancing' => '0.80',
        '/building-and-construction-disputes' => '0.80',
        '/caveats-disputs-and-removal' => '0.80',
    ];

    public function index(): Response
    {
        $xml = Cache::remember('sitemap_xml_v1', 3600, fn () => $this->buildXml());

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function buildXml(): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $entries = [];
        $seen = [];

        foreach (self::STATIC_PATHS as $path => $priority) {
            $loc = $path === '/' ? $baseUrl . '/' : $baseUrl . $path;
            $entries[] = $this->urlEntry($loc, now(), $priority);
            $seen[$path === '/' ? '' : ltrim($path, '/')] = true;
        }

        BlogCategory::where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('slug')
            ->get(['slug', 'updated_at'])
            ->each(function (BlogCategory $category) use (&$entries, $baseUrl) {
                $entries[] = $this->urlEntry(
                    $baseUrl . '/blog/category/' . rawurlencode($category->slug),
                    $category->updated_at,
                    '0.64'
                );
            });

        Blog::where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at'])
            ->each(function (Blog $blog) use (&$entries, $baseUrl) {
                $entries[] = $this->urlEntry(
                    $baseUrl . '/blog/' . rawurlencode($blog->slug),
                    $blog->updated_at,
                    '0.64'
                );
            });

        RecentCase::where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at'])
            ->each(function (RecentCase $case) use (&$entries, &$seen, $baseUrl) {
                if (isset($seen[$case->slug])) {
                    return;
                }
                $entries[] = $this->urlEntry(
                    $baseUrl . '/' . rawurlencode($case->slug),
                    $case->updated_at,
                    '0.64'
                );
                $seen[$case->slug] = true;
            });

        CmsPage::where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('updated_at', 'desc')
            ->get(['slug', 'updated_at'])
            ->each(function (CmsPage $page) use (&$entries, &$seen, $baseUrl) {
                if (isset($seen[$page->slug])) {
                    return;
                }
                $entries[] = $this->urlEntry(
                    $baseUrl . '/' . rawurlencode($page->slug),
                    $page->updated_at,
                    '0.64'
                );
                $seen[$page->slug] = true;
            });

        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n"
            . implode("\n", $entries)
            . "\n</urlset>\n";
    }

    private function urlEntry(string $loc, $lastmod, string $priority): string
    {
        $lastmodIso = $lastmod
            ? (\is_string($lastmod) ? \Carbon\Carbon::parse($lastmod) : $lastmod)->toAtomString()
            : now()->toAtomString();

        return '  <url>'
            . '<loc>' . htmlspecialchars($loc, ENT_XML1 | ENT_COMPAT, 'UTF-8') . '</loc>'
            . '<lastmod>' . $lastmodIso . '</lastmod>'
            . '<priority>' . $priority . '</priority>'
            . '</url>';
    }
}
