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
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'p9wgxwybzjzsmg23',
                    'publicKey' => 'w2yq5mk28mx5dhsq',
                    'privateKey' => '49ea0d8ef8aa2074dcb5ee9d842d5bd7',
                ]
            );
        });
    }
}
