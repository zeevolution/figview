<?php

namespace Figview\Providers;

use Figview\Repositories\ContextTreePathRepository;
use Figview\Repositories\ContextTreePathRepositoryEloquent;
use Figview\Repositories\DeviceModelRepository;
use Figview\Repositories\DeviceModelRepositoryEloquent;
use Figview\Repositories\IdasRepository;
use Figview\Repositories\IdasRepositoryEloquent;
use Figview\Repositories\IotEnvRepository;
use Figview\Repositories\IotEnvRepositoryEloquent;
use Figview\Repositories\OrionRepository;
use Figview\Repositories\OrionRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
            OrionRepository::class,
            OrionRepositoryEloquent::class);
        $this->app->bind(
            IdasRepository::class,
            IdasRepositoryEloquent::class);
        $this->app->bind(
            IotEnvRepository::class,
            IotEnvRepositoryEloquent::class);
        $this->app->bind(
            ContextTreePathRepository::class,
            ContextTreePathRepositoryEloquent::class);
        $this->app->bind(
            DeviceModelRepository::class,
            DeviceModelRepositoryEloquent::class);
        $this->app->bind(\Figview\Repositories\IoTEnvMemberRepository::class, \Figview\Repositories\IoTEnvMemberRepositoryEloquent::class);
        //:end-bindings:
    }
}
