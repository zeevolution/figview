<?php

namespace Figview\Providers;

use Illuminate\Support\ServiceProvider;

class FigviewRepositoryProvider extends ServiceProvider
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
        $this->app->bind(
            \Figview\Repositories\OrionRepository::class,
            \Figview\Repositories\OrionRepositoryEloquent::class);
        $this->app->bind(
            \Figview\Repositories\IdasRepository::class,
            \Figview\Repositories\IdasRepositoryEloquent::class);
    }
}
