<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    private $settingCacheKey = 'settings';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (App::runningInConsole()) {
            return;
        }

        $this->handle();
    }

    private function handle()
    {
        $settings = getCache($this->settingCacheKey);

        if(!$settings) {
            $settings = Settings::pluck('value', 'name')->toArray();
            setCache($this->settingCacheKey, $settings);
        }

        Config::set('settings', $settings);
    }
}
