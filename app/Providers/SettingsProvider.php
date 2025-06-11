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

        // Set the timezone (if found in the database, otherwise 'America/Sao_Paulo')
        $this->setTimezone($settings);

        // Set default date (if found in database)
        $this->setDateFormat($settings);
    }

    private function setTimezone($settings) {
        $timezone = $settings['timezone'] ?? 'America/Sao_Paulo';
        Config::set('app.timezone', $timezone);

        date_default_timezone_set($timezone);
    }

    private function setDateFormat($settings) {
        $dateFormat = $settings['date_format'] ?? 'DD-MM-YYYY';
        Config::set('app.date_format', $dateFormat);

        Config::set('app.clock_type', $settings['clock_type']);
    }
}
