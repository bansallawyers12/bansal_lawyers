<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CacheOptimizationService;

class ClearContentCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-content 
                            {type : Content type (blog|service|testimonial|page|case|all)}
                            {--identifier= : Specific content identifier (slug/id)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cache for specific content types';

    /**
     * The cache optimization service
     *
     * @var CacheOptimizationService
     */
    protected $cacheService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CacheOptimizationService $cacheService)
    {
        parent::__construct();
        $this->cacheService = $cacheService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');
        $identifier = $this->option('identifier');

        if ($type === 'all') {
            $this->info('🧹 Clearing all content caches...');
            $this->cacheService->clearAllCaches();
            $this->info('✅ All content caches cleared successfully');
        } else {
            $this->info("🧹 Clearing {$type} cache" . ($identifier ? " for {$identifier}" : "") . "...");
            $this->cacheService->clearContentCache($type, $identifier);
            $this->info("✅ {$type} cache cleared successfully");
        }

        return 0;
    }
}

