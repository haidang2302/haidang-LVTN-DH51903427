<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     public $bindings = [
        'App\Repositories\Interfaces\CustomerRepositoryInterface' => 'App\Repositories\CustomerRepository',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        'App\Repositories\Interfaces\GenerateRepositoryInterface' => 'App\Repositories\GenerateRepository',
        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\ProductCatalogueRepositoryInterface' => 'App\Repositories\ProductCatalogueRepository',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',
        'App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface' => 'App\Repositories\AttributeCatalogueRepository',
        'App\Repositories\Interfaces\AttributeRepositoryInterface' => 'App\Repositories\AttributeRepository',
        'App\Repositories\Interfaces\MenuCatalogueRepositoryInterface' => 'App\Repositories\MenuCatalogueRepository',
        'App\Repositories\Interfaces\MenuRepositoryInterface' => 'App\Repositories\MenuRepository',
        'App\Repositories\Interfaces\OrderRepositoryInterface' => 'App\Repositories\OrderRepository',
        'App\Repositories\Interfaces\AgencyRepositoryInterface' => 'App\Repositories\AgencyRepository',
        'App\Repositories\Interfaces\RouterRepositoryInterface' => 'App\Repositories\RouterRepository',
    ];

    public function register(): void
    {
        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
