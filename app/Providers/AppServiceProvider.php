<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Frontend page rate limiter — 60 req/min per IP
        RateLimiter::for('web-pages', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });

        // Booking page rate limiter — stricter, 30 req/min per IP
        // This page was responsible for ~52 GiB of bot bandwidth
        RateLimiter::for('web-booking', function (Request $request) {
            return Limit::perMinute(30)->by($request->ip());
        });

        // AJAX endpoints rate limiter — 60 req/min per IP
        // Higher headroom so real users can click through calendar dates quickly
        RateLimiter::for('web-ajax', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
