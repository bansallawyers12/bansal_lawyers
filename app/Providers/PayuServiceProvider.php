<?php
namespace App\Providers;

use App\Services\Payu\PaymentManager;
use Illuminate\Support\ServiceProvider;

class PayuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('payu.payment', function ($app) {
            return new PaymentManager($app['request'], $app['url']);
        });
    }

    public function boot(): void
    {
    }
}


