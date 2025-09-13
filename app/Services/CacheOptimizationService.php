<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class CacheOptimizationService
{
    /**
     * Cache keys used throughout the application
     */
    const CACHE_KEYS = [
        'website_settings' => 'website_settings',
        'homepage_data' => 'homepage_data_',
        'page_data' => 'page_data_',
        'latest_blogs_homepage' => 'latest_blogs_homepage',
        'testimonials_data' => 'testimonials_data',
        'services_data' => 'services_data',
        'blog_data' => 'blog_data',
        'blog_categories' => 'blog_categories',
    ];

    /**
     * Clear all application caches
     */
    public function clearAllCaches(): void
    {
        // Clear Laravel caches
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        
        // Clear application-specific caches
        foreach (self::CACHE_KEYS as $key) {
            Cache::forget($key);
        }
        
        // Clear paginated caches (homepage_data_1, homepage_data_2, etc.)
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("homepage_data_{$i}");
        }
    }

    /**
     * Clear cache for specific content type
     */
    public function clearContentCache(string $contentType, ?string $identifier = null): void
    {
        switch ($contentType) {
            case 'blog':
                Cache::forget('latest_blogs_homepage');
                Cache::forget('blog_categories');
                // Clear paginated blog caches
                for ($i = 1; $i <= 10; $i++) {
                    Cache::forget("homepage_data_{$i}");
                }
                if ($identifier) {
                    Cache::forget("page_data_{$identifier}_blog");
                    Cache::forget("blog_data_{$identifier}");
                }
                break;
                
            case 'service':
                Cache::forget('services_data');
                if ($identifier) {
                    Cache::forget("page_data_{$identifier}_service");
                }
                break;
                
            case 'testimonial':
                Cache::forget('testimonials_data');
                break;
                
            case 'page':
                Cache::forget('website_settings');
                if ($identifier) {
                    Cache::forget("page_data_{$identifier}_cms");
                }
                break;
                
            case 'case':
                if ($identifier) {
                    Cache::forget("page_data_{$identifier}_case");
                }
                break;
        }
    }

    /**
     * Warm up frequently accessed caches
     */
    public function warmUpCaches(): void
    {
        // Warm up website settings
        Cache::remember('website_settings', 3600, function() {
            return \App\Models\WebsiteSetting::first();
        });
        
        // Warm up blog categories
        Cache::remember('blog_categories', 3600, function() {
            return \App\Models\BlogCategory::where('status', 1)
                ->select(['id', 'name', 'slug'])
                ->orderBy('name', 'asc')
                ->get();
        });
        
        // Warm up services
        Cache::remember('services_data', 7200, function() {
            return [
                'servicelists' => \App\Models\OurService::where('status', 1)
                    ->select(['id', 'title', 'slug', 'description', 'image', 'created_at'])
                    ->orderBy('id', 'ASC')
                    ->get(),
                'serviceData' => \App\Models\OurService::where('status', 1)->count()
            ];
        });
        
        // Warm up testimonials
        Cache::remember('testimonials_data', 3600, function() {
            return [
                'testimoniallists' => \App\Models\Testimonial::where('status', 1)
                    ->select(['id', 'name', 'content', 'image', 'created_at'])
                    ->orderBy('id', 'DESC')
                    ->get(),
                'testimonialData' => \App\Models\Testimonial::where('status', 1)->count()
            ];
        });
    }

    /**
     * Get cache statistics
     */
    public function getCacheStats(): array
    {
        $stats = [];
        
        foreach (self::CACHE_KEYS as $key) {
            $stats[$key] = Cache::has($key) ? 'cached' : 'not cached';
        }
        
        return $stats;
    }

    /**
     * Optimize cache configuration
     */
    public function optimizeCacheConfig(): void
    {
        // Set optimal cache settings
        config([
            'cache.stores.file.path' => storage_path('framework/cache/data'),
            'cache.prefix' => env('CACHE_PREFIX', 'bansal_lawyers_cache'),
        ]);
    }
}

