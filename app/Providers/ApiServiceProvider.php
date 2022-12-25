<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * All the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        \App\Contracts\Api\CategoryInterface::class => \App\Services\Api\CategoryService::class,
        \App\Contracts\Api\ProductInterface::class => \App\Services\Api\ProductService::class,
    ];

    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [

    ];
}
