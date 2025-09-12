<?php

namespace App\Helpers;

use App\Models\WebsiteSetting;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class Settings
{
    /**
     * Get site data by key
     * Handles both global website settings and office-specific settings
     */
    public static function sitedata($key)
    {
        // First try to get office-specific setting
        if (Auth::check() && Auth::user()->office_id) {
            $officeSetting = Setting::where('office_id', Auth::user()->office_id)->first();
            if ($officeSetting && isset($officeSetting->$key)) {
                return $officeSetting->$key;
            }
        }
        
        // Fallback to global website setting
        $websiteSetting = WebsiteSetting::first();
        if ($websiteSetting) {
            switch ($key) {
                case 'date_format':
                    return $websiteSetting->date_format ?? 'Y-m-d';
                case 'time_format':
                    return $websiteSetting->time_format ?? 'H:i:s';
                case 'phone':
                    return $websiteSetting->phone;
                case 'email':
                    return $websiteSetting->email;
                case 'ofc_timing':
                    return $websiteSetting->ofc_timing;
                case 'logo':
                    return $websiteSetting->logo;
                default:
                    return $websiteSetting->$key ?? null;
            }
        }
        
        // Final fallback to default values
        return self::getDefaultValue($key);
    }
    
    /**
     * Get default value for a setting key
     */
    private static function getDefaultValue($key)
    {
        $defaults = [
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i:s',
            'phone' => '',
            'email' => '',
            'ofc_timing' => '',
            'logo' => '',
        ];
        
        return $defaults[$key] ?? null;
    }
    
    /**
     * Set office-specific setting
     */
    public static function setOfficeSetting($key, $value, $officeId = null)
    {
        $officeId = $officeId ?? (Auth::check() ? Auth::user()->office_id : null);
        
        if (!$officeId) {
            return false;
        }
        
        $setting = Setting::where('office_id', $officeId)->first();
        
        if (!$setting) {
            $setting = new Setting();
            $setting->office_id = $officeId;
        }
        
        $setting->$key = $value;
        return $setting->save();
    }
}
