<?php declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Exception;

/**
 * Settings Model
 * 
 * Manages application settings stored in the database
 * Provides caching, validation, and type casting for settings
 */
class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'class', 'key', 'value', 'type', 'context'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'class' => 'required|max_length[100]',
        'key' => 'required|max_length[100]',
        'value' => 'permit_empty',
        'type' => 'permit_empty|max_length[50]',
        'context' => 'permit_empty|max_length[100]'
    ];

    protected $validationMessages = [
        'class' => [
            'required' => 'Settings class is required',
            'max_length' => 'Settings class cannot exceed 100 characters'
        ],
        'key' => [
            'required' => 'Settings key is required',
            'max_length' => 'Settings key cannot exceed 100 characters'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Cache settings for better performance
    protected static $cache = [];
    protected static $cacheExpiry = 3600; // 1 hour

    /**
     * Get a setting value by class and key
     * 
     * @param string $class The settings class (e.g., 'site', 'legal')
     * @param string $key The settings key (e.g., 'title', 'copyrightHolder')
     * @param mixed $default Default value if setting not found
     * @return mixed
     */
    public function getSetting(string $class, string $key, $default = null)
    {
        $cacheKey = $class . '.' . $key;
        
        // Check cache first
        if (isset(static::$cache[$cacheKey])) {
            return static::$cache[$cacheKey];
        }

        $setting = $this->where('class', $class)
                        ->where('key', $key)
                        ->first();

        if (!$setting) {
            static::$cache[$cacheKey] = $default;
            return $default;
        }

        $value = $this->castValue($setting['value'], $setting['type'] ?? 'string');
        static::$cache[$cacheKey] = $value;
        
        return $value;
    }

    /**
     * Set a setting value
     * 
     * @param string $class The settings class
     * @param string $key The settings key
     * @param mixed $value The value to set
     * @param string $type The data type for casting
     * @param string $context Optional context for the setting
     * @return bool
     */
    public function setSetting(string $class, string $key, $value, string $type = 'string', string $context = ''): bool
    {
        $cacheKey = $class . '.' . $key;
        
        // Convert value to string for storage
        $valueString = $this->valueToString($value, $type);
        
        $data = [
            'class' => $class,
            'key' => $key,
            'value' => $valueString,
            'type' => $type,
            'context' => $context
        ];

        // Check if setting exists
        $existing = $this->where('class', $class)
                         ->where('key', $key)
                         ->first();

        if ($existing) {
            $result = $this->update($existing['id'], $data);
        } else {
            $result = $this->insert($data);
        }

        if ($result) {
            // Update cache
            static::$cache[$cacheKey] = $value;
        }

        return (bool) $result;
    }

    /**
     * Get all settings for a class
     * 
     * @param string $class The settings class
     * @return array
     */
    public function getClassSettings(string $class): array
    {
        $settings = $this->where('class', $class)->findAll();
        $result = [];

        foreach ($settings as $setting) {
            $result[$setting['key']] = $this->castValue(
                $setting['value'], 
                $setting['type'] ?? 'string'
            );
        }

        return $result;
    }

    /**
     * Set multiple settings for a class
     * 
     * @param string $class The settings class
     * @param array $settings Array of key => value pairs
     * @param string $defaultType Default type for casting
     * @return bool
     */
    public function setClassSettings(string $class, array $settings, string $defaultType = 'string'): bool
    {
        $success = true;

        foreach ($settings as $key => $value) {
            $type = $defaultType;
            
            // Auto-detect type if possible
            if (is_bool($value)) {
                $type = 'boolean';
            } elseif (is_int($value)) {
                $type = 'integer';
            } elseif (is_array($value)) {
                $type = 'json';
            }

            if (!$this->setSetting($class, $key, $value, $type)) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Delete a setting
     * 
     * @param string $class The settings class
     * @param string $key The settings key
     * @return bool
     */
    public function deleteSetting(string $class, string $key): bool
    {
        $cacheKey = $class . '.' . $key;
        
        $setting = $this->where('class', $class)
                        ->where('key', $key)
                        ->first();

        if (!$setting) {
            return false;
        }

        $result = $this->delete($setting['id']);
        
        if ($result) {
            unset(static::$cache[$cacheKey]);
        }

        return (bool) $result;
    }

    /**
     * Clear all cached settings
     */
    public function clearCache(): void
    {
        static::$cache = [];
    }

    /**
     * Cast a value to its proper type
     * 
     * @param string $value The string value from database
     * @param string $type The target type
     * @return mixed
     */
    protected function castValue(string $value, string $type)
    {
        switch ($type) {
            case 'boolean':
                return in_array(strtolower($value), ['1', 'true', 'yes', 'on']);
            
            case 'integer':
                return (int) $value;
            
            case 'float':
                return (float) $value;
            
            case 'json':
            case 'array':
                $decoded = json_decode($value, true);
                return $decoded !== null ? $decoded : [];
            
            case 'string':
            default:
                return $value;
        }
    }

    /**
     * Convert a value to string for storage
     * 
     * @param mixed $value The value to convert
     * @param string $type The value type
     * @return string
     */
    protected function valueToString($value, string $type): string
    {
        switch ($type) {
            case 'boolean':
                return $value ? '1' : '0';
            
            case 'json':
            case 'array':
                return json_encode($value);
            
            default:
                return (string) $value;
        }
    }

    /**
     * Initialize default settings from Admin config
     * 
     * @return bool
     */
    public function initializeDefaults(): bool
    {
        $adminConfig = config('Admin');
        $success = true;

        // Initialize site settings
        if (!$this->setClassSettings('site', $adminConfig->site)) {
            $success = false;
        }

        // Initialize theme settings
        if (!$this->setClassSettings('theme', $adminConfig->theme)) {
            $success = false;
        }

        // Initialize company settings
        if (!$this->setClassSettings('company', $adminConfig->company)) {
            $success = false;
        }

        // Initialize legal settings
        if (!$this->setClassSettings('legal', $adminConfig->legal)) {
            $success = false;
        }

        // Initialize meta settings
        if (!$this->setClassSettings('meta', $adminConfig->meta)) {
            $success = false;
        }

        return $success;
    }
}

/**
 * Global helper function to get settings
 * 
 * @param string $class Settings class
 * @param string $key Settings key
 * @param mixed $default Default value
 * @return mixed
 */
if (!function_exists('app_setting')) {
    function app_setting(string $class, string $key, $default = null)
    {
        static $model = null;
        
        if ($model === null) {
            $model = new \App\Models\SettingsModel();
        }
        
        return $model->getSetting($class, $key, $default);
    }
}