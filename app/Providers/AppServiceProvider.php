<?php

namespace App\Providers;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
           View::share('setting', \App\Models\Setting::first());
        } catch (\Exception $e) {
            // Handle the exception, e.g., log it or ignore it
        }
    }
}
