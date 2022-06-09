<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\Repositories\AuthorRepositoryInterface',
            'App\Repositories\AuthorRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::share('parentCategories', ParentCategory::all());
        View::share('setting', Setting::first());
    }
}
