<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Share global settings to all views
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $global_settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                \Illuminate\Support\Facades\View::share('global_settings', $global_settings);
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('posts')) {
                $latest_news_marquee = \App\Models\Post::where('status', 'published')->latest()->take(5)->get();
                \Illuminate\Support\Facades\View::share('latest_news_marquee', $latest_news_marquee);
            }
        } catch (\Exception $e) {
            // Ignore if DB not ready
        }
    }
}
