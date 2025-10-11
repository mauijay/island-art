<?php

/**
 * Setting Helper
 * 
 * Helper functions for managing application settings
 */

if (!function_exists('app_setting')) {
    /**
     * Get a setting value from the database
     * 
     * @param string $class Settings class (e.g., 'site', 'legal')
     * @param string $key Settings key (e.g., 'title', 'copyrightHolder')
     * @param mixed $default Default value if setting not found
     * @return mixed
     */
    function app_setting(string $class, string $key, $default = null)
    {
        static $model = null;
        
        if ($model === null) {
            $model = new \App\Models\SettingsModel();
        }
        
        return $model->getSetting($class, $key, $default);
    }
}

if (!function_exists('set_app_setting')) {
    /**
     * Set a setting value in the database
     * 
     * @param string $class Settings class
     * @param string $key Settings key
     * @param mixed $value The value to set
     * @param string $type The data type for casting
     * @return bool
     */
    function set_app_setting(string $class, string $key, $value, string $type = 'string'): bool
    {
        static $model = null;
        
        if ($model === null) {
            $model = new \App\Models\SettingsModel();
        }
        
        return $model->setSetting($class, $key, $value, $type);
    }
}

if (!function_exists('site_title')) {
    /**
     * Get the site title
     * 
     * @return string
     */
    function site_title(): string
    {
        return app_setting('site', 'title', 'Island Art News');
    }
}

if (!function_exists('copyright_holder')) {
    /**
     * Get the copyright holder
     * 
     * @return string
     */
    function copyright_holder(): string
    {
        return app_setting('legal', 'copyrightHolder', '808 Business Solutions, LLC');
    }
}

if (!function_exists('site_url_setting')) {
    /**
     * Get the site URL from settings
     * 
     * @return string
     */
    function site_url_setting(): string
    {
        return app_setting('site', 'url', site_url());
    }
}

if (!function_exists('company_name')) {
    /**
     * Get the company name
     * 
     * @return string
     */
    function company_name(): string
    {
        return app_setting('company', 'name', '808 Business Solutions');
    }
}

if (!function_exists('company_email')) {
    /**
     * Get the company email
     * 
     * @return string
     */
    function company_email(): string
    {
        return app_setting('company', 'email', 'info@808businesssolutions.com');
    }
}

if (!function_exists('company_phone')) {
    /**
     * Get the company phone
     * 
     * @return string
     */
    function company_phone(): string
    {
        return app_setting('company', 'phone', '(808) 600-7400');
    }
}

if (!function_exists('company_address')) {
    /**
     * Get the company address
     * 
     * @return string
     */
    function company_address(): string
    {
        return app_setting('company', 'address', '909 Kapiolani Blvd #1901, Honolulu, HI 96814');
    }
}