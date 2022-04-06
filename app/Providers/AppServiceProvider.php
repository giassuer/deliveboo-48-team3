<?php

namespace App\Providers;
use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => '7qfbpdbfqr8s4qmq',
                    'publicKey' => 'r4nt3x8m92xzc8w2',
                    'privateKey' => '5f00657e74581a3a8cd7aebb50cef372'
                ]
            );
        });
    }
}