<?php

namespace App\Providers;

use App\Models\WebsiteCustomization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class WebsiteCustomizationProvider extends ServiceProvider
{
    private $cacheKey = 'websiteCustomization';

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
        $website_customization = getCache($this->cacheKey);

        if(!$website_customization) {
            $website_customization = WebsiteCustomization::first();
            setCache($this->cacheKey, $website_customization);
        }

        Config::set('website_customization', $website_customization);
    }
}
