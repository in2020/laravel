<?php

namespace App\Providers;

use App\MyCompany\Contracts\MyClass as MyClassContracts;
use App\MyCompany\Services\MyClass;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('MyClass', function($app){
            return new MyClass();
        });
    }
}
