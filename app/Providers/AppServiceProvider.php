<?php

namespace App\Providers;

use App\Repositories\Demo\DemoRepository;
use App\Repositories\Demo\EloquentDemoRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DemoRepository::class, function () {
            return new EloquentDemoRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Load helpers.
        include __DIR__.'/../Helpers/global.php';
    }
}
