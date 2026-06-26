<?php

use App\Models\Setting;

if (! function_exists('money')) {
    function money($amount, bool $symbol = true): string
    {
        $formatted = number_format((float) $amount, 2);

        return $symbol ? Setting::get('currency', '₱').$formatted : $formatted;
    }
}

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}
