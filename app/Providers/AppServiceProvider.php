<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as myView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // تعيين قيمة المتغير
//        $setting = Setting::first();
//        $this->app->bind('setting', function ()use($setting) {
//            return $setting;
//        });
        }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
//        $setting = Setting::first();
//        view()->composer('*', function ($view) use ($setting) {
//            return $view->with('setting', $setting);
//        });
    }
}
