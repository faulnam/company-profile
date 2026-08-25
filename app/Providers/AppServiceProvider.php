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

            // Track content created by demo users and set 3-minute expiration
            \Illuminate\Support\Facades\Event::listen('eloquent.created: *', function ($eventName, array $data) {
                try {
                    if (!empty($data[0]) && is_object($data[0])) {
                        $model = $data[0];
                        if ($model instanceof \App\Models\DemoRecord) {
                            return;
                        }

                        if (auth()->check()) {
                            $user = auth()->user();
                            $isDemo = str_starts_with(strtolower($user->email ?? ''), 'demo') || 
                                      str_contains(strtolower($user->email ?? ''), 'demo');

                            if ($isDemo && $model->getKey()) {
                                if (\Illuminate\Support\Facades\Schema::hasTable('demo_records')) {
                                    \App\Models\DemoRecord::create([
                                        'record_type' => get_class($model),
                                        'record_id' => $model->getKey(),
                                        'user_id' => $user->id,
                                        'expires_at' => now()->addMinutes(3),
                                    ]);
                                }
                            }
                        }
                    }
                } catch (\Throwable $e) {
                    // Silently fail if DB table is migrating
                }
            });
        } catch (\Exception $e) {
            // Ignore if DB not ready
        }
    }
}
