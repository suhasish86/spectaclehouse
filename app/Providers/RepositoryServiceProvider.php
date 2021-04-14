<?php

namespace App\Providers;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\FacilityRepositoryInterface;

use App\Repositories\ProductRepository;
use App\Repositories\FacilityRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            FacilityRepositoryInterface::class,
            FacilityRepository::class
        );
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
}
