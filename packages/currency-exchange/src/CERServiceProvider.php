<?php

namespace Petshop\CurrencyExchange;

use Illuminate\Support\ServiceProvider;

class CERServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        $this->publishes([
//            __DIR__ . '/../config/cer.php' => config_path('cer.php'),
//        ]);
    }

    public function register()
    {
        $this->app->singleton(CurrencyExchange::class, function () {
            return new CurrencyExchange();
        });
    }

}