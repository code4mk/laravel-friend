<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any services.
     */
    public function register(): void
    {
        $bindings = [
            \App\Repositories\Demo\DemoRepository::class => \App\Repositories\Demo\EloquentDemoRepository::class,
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any services.
     */
    public function boot(): void
    {
        //
    }
}
