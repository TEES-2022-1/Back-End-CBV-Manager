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
            $classificatoryConfrontationsService = new ClassificatoryConfrontationsService();
            $classificatoryConfrontationsService->classificatoryConfrontation = app()->make(ClassificatoryConfrontation::class);
            return $classificatoryConfrontationsService;
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
