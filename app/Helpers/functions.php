<?php

use Illuminate\Support\Facades\Cache;

/**
 * Retrieve a value from the cache.
 *
 * @param string $cacheKey The key used to store the cached value.
 * @return mixed The cached value or null if not found.
 */
function getCache($cacheKey) {
    return Cache::get($cacheKey);
}

/**
 * Store a value in the cache for a specified duration.
 *
 * @param string $cacheKey The key to store the value under.
 * @param mixed $content The content to be cached.
 * @param int|null $time The cache duration in minutes (defaults to the configured cache time).
 * @return void
 */
function setCache($cacheKey, $content, $time = null) {
    if(!$time) {
        $time = 10080; // 7 days = 10,080 minutes
    }

    Cache::put($cacheKey, $content, now()->addMinutes($time));
}