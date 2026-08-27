<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ShipmentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // For a simple CRUD, specific bindings are typically not immediately needed here.
        // This is where you might bind interfaces to concrete implementations, e.g.:
        // $this->app->bind(
        //     \App\Interfaces\ShipmentRepositoryInterface::class,
        //     \App\Repositories\EloquentShipmentRepository::class
        // );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
