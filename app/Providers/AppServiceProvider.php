<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CategoryService;
use App\Models\{Category,User};
use App\Events\UserSaved;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });
        User::saved(function ($user) {
            event(new UserSaved($user));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
