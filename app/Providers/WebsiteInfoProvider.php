<?php

namespace App\Providers;

use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class WebsiteInfoProvider extends ServiceProvider
{
    private $cacheKey = 'websiteInfo';

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
        $siteInfo = getCache($this->cacheKey);

        if (!$siteInfo) {
            $siteInfo = WebsiteInfo::first() ?? new WebsiteInfo();
            setCache($this->cacheKey, $siteInfo);
        }

        Config::set('website_info', $siteInfo);
        // initSeo();
    }
}
