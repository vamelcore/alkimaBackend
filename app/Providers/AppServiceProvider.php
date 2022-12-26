<?php

namespace App\Providers;

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
        //
    }

    /**
     * @var string[]
     */
    public $bindings = [
        \App\Contracts\ImportDriverInterface::class => \App\Utilities\JsonFileImportDriver::class,
    ];
}
