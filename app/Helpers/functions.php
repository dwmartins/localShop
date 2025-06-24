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

/**
 * @param string $messageType The type of message to display. Can be 'success', 'error', 'warning', etc.
 * @param string $title The title of the message. May be an empty string if there is no title.
 * @param string|array $messageOrFields The message or an array of field errors. It can be a simple string
 * or an associative array with fields as key and messages as value.
 * @param string|null $route (Optional) The route to which the user will be redirected. If not provided,
 * the user will be redirected to the previous page.
 * @param array $params (option) Is an array of parameters to be passed to the URL.
 */
function redirectWithMessage($messageType, $title, $messageOrFields, $route = null, $params = []) {
    $message = ['type' => $messageType, 'title' => $title, 'fields' => $messageOrFields];

    if ($route) {
        abort(redirect()->route($route, $params)->with('message', $message));
    }

    abort(redirect()->back()->withInput()->with('message', $message));
}

/**
 * Validate form fields to check for malicious characters.
 * 
 * @param array $data The submitted form data (e.g., $_POST).
 * @return array An associative array of errors, where the key is the field name 
 *               and the value is the error message if any malicious characters are found.
 */
function validateFields($data) {
    $errors = [];

    $maliciousPattern = '/<[^>]*>|javascript:|data:|url\(|<script.*?>.*?<\/script>/i';

    foreach ($data as $key => $value) {
        if($key === '_token') {
            continue;
        }

        if($key === 'keywords') {
            $value = json_encode($value);
        }

        if(preg_match($maliciousPattern, $value)) {
            $errors[$key] = [
                trans('validation.field_invalid_characters', [
                    'attribute' => trans('validation.attributes.' . $key)
                ])
            ];
        }
    }

    return $errors;
}