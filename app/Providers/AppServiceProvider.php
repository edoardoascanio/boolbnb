<?php

namespace App\Providers;
use Braintree;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        Braintree\Configuration::environment(env('BRAINTREE_ENV'));
        Braintree\Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        Braintree\Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        Braintree\Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
    }
}
