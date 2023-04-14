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
        $this->app->singleton(Gateway::class, function ($pp) {
            return new Gateway(



                //!credenziali test braintree Marco


                [
                    'environment' => 'sandbox',
                    'merchantId' => 'y8rkq77b4hhyxp83',
                    'publicKey' => 'x2hmg6rjhwjccw8n',
                    'privateKey' => '96916fce579cf8453b19dabfe289ea70'
                ]
            );
        });
    }
}
