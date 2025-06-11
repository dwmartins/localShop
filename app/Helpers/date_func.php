<?php

use Carbon\Carbon;

/**
 * Converts a date to a localized string format.
 *
 * @param string $date The date to format (e.g., "2025-02-26").
 * @return string Formatted date based on the current locale.
 */
function getDateAsString($date) {
    return Carbon::parse($date)
    ->locale(app()->getLocale())
    ->isoFormat('D MMMM YYYY');
}

/**
 * Formats a date and time according to website settings.
 *
 * @param string $dateTime The date and time to format (e.g., "2025-02-26 20:42:00").
 * @return string Formatted date and time based on locale, date format, and clock type.
 *
 * Example output:
 * - If locale is "pt-BR" and format is "DD-MM-YYYY" with 24-hour clock:
 *   → "26 fevereiro 2025, 20:42"
 * - If locale is "en" and format is "MM-DD-YYYY" with 12-hour clock:
 *   → "Feb 26, 2025 8:42 PM"
 */
function formatDateTime($dateTime) {
    $date = Carbon::parse($dateTime, config('settings.timezone'));
    $date->locale(app()->getLocale());

    if (config('settings.date_format') === 'DD-MM-YYYY') {
        $dateFormat = 'D MMMM YYYY';
    } else {
        $dateFormat = 'MMM D, YYYY';
    }
    
    if (config('settings.clock_type') == 12) {
        $timeFormat = 'h:mm a';
    } else {
        $timeFormat = 'HH:mm';
    }

    return $date->isoFormat($dateFormat . ', ' . $timeFormat);
}

/**
 * Formats a date according to the configured website date format.
 *
 * @param string $date The date to format (expected format: "YYYY-MM-DD").
 * @return string Formatted date based on the configured format or the original input if invalid.
 *
 * Example output:
 * - If format is "DD-MM-YYYY": → "26/02/2025"
 * - If format is "MM-DD-YYYY": → "02/26/2025"
 */
function getSimpleDate($date) {
    $format = config('settings.date_format', 'DD-MM-YYYY');

    $dateTime = Carbon::createFromFormat('Y-m-d', $date);

    if ($dateTime) {
        $normalizedFormat = str_replace('-', '/', $format);
        $phpFormat = str_replace(['DD', 'MM', 'YYYY'], ['d', 'm', 'Y'], $normalizedFormat);

        return $dateTime->format($phpFormat);
    }

    return $date;
}

function formatDateForUrl($dateTime) {
    return Carbon::parse($dateTime)->format('Y-m-d-H-i-s');
}