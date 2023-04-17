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
                // [
                //     'environment' => 'sandbox',
                //     'merchantId' => 'y8rkq77b4hhyxp83',
                //     'publicKey' => 'x2hmg6rjhwjccw8n',
                //     'privateKey' => '96916fce579cf8453b19dabfe289ea70'
                // ]

                //!credenziali braintree daniele
                // [
                //  'environment' => 'sandbox',
                //   'merchantId' => 'b9tnhj4554d5x655',
                //   'publicKey' => 'pmrtm7bqzsrh7ytr',
                //   'privateKey' => 'fc995134a1ecea6344ad0a47acab4206'
                // ]

                //!credenziali braintree Pino
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'jfry7pjmf4w5x83c',
                    'publicKey' => 'bxtqm8mxzgccb8s4',
                    'privateKey' => '4facd4b285ec5672ff2f400e8b739fef'
                ]
            );
        });
    }
}