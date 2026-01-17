<?php

namespace App\Helpers;

class Settings
{
    /**
     * Return default site data values without DB access.
     */
    public static function sitedata($key)
    {
        $defaults = [
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i:s',
        ];

        return $defaults[$key] ?? null;
    }
}
