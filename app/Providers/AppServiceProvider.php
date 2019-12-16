<?php

namespace App\Providers;

use App\Repository\ProductCategoryRepository;
use App\Repository\ProductCategoryRepositoryInterface;
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
        $this->app->bind(ProductCategoryRepositoryInterface::class, ProductCategoryRepository::class);
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
