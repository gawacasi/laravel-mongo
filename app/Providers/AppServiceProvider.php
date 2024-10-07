<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ClashRoyaleService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ClashRoyaleService::class, function ($app) {
            return new ClashRoyaleService();
        });
    }
    
    public function boot()
    {
        //
    }
}
