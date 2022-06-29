<?php

namespace App\Providers;

use App\Models\ClassificatoryConfrontation;
use App\Services\ClassificatoryConfrontationsService;
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
        $this->app->singleton(ClassificatoryConfrontationsService::class, function ($app) {
            return new ClassificatoryConfrontationsService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
