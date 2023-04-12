<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'b9tnhj4554d5x655',
                    'publicKey' => 'pmrtm7bqzsrh7ytr',
                    'privateKey' => 'fc995134a1ecea6344ad0a47acab4206'
                ]
            );
        });


    }
}