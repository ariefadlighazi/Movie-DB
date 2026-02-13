<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OmdbClient;
use Illuminate\Support\Facades\URL;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OmdbClient::class, function ($app) {
            return new OmdbClient($app['config']['services.omdb']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
    }
}
