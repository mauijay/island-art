<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * AdminSettingsController
 * 
 * Manages admin settings through web interface
 */
class AdminSettingsController extends BaseController
{
    protected SettingsModel $settingsModel;
    protected array $managedCategories;

    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
        
        // Define which settings categories can be managed via admin interface
        $this->managedCategories = [
            'site' => [
                'title' => 'Site Settings',
                'description' => 'Basic site configuration',
                'icon' => 'globe',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Site Title', 'required' => true, 'placeholder' => 'Your site title'],
                    'url' => ['type' => 'url', 'label' => 'Site URL', 'required' => true, 'placeholder' => 'https://yoursite.com'],
                    'language' => ['type' => 'text', 'label' => 'Language Code', 'required' => true, 'placeholder' => 'en'],
                    'timezone' => ['type' => 'text', 'label' => 'Timezone', 'required' => true, 'placeholder' => 'Pacific/Honolulu']
                ]
            ],
            'theme' => [
                'title' => 'Theme Settings',
                'description' => 'Visual appearance configuration',
                'icon' => 'palette',
                'fields' => [
                    'name' => ['type' => 'text', 'label' => 'Theme Name', 'required' => true, 'placeholder' => 'default'],
                    'dark_mode' => ['type' => 'checkbox', 'label' => 'Enable Dark Mode', 'required' => false]
                ]
            ],
            'company' => [
                'title' => 'Company Information',
                'description' => 'Business details and contact information',
                'icon' => 'building',
                'fields' => [
                    'name' => ['type' => 'text', 'label' => 'Company Name', 'required' => true, 'placeholder' => 'Your Company Name'],
                    'email' => ['type' => 'email', 'label' => 'Contact Email', 'required' => true, 'placeholder' => 'contact@company.com'],
                    'phone' => ['type' => 'tel', 'label' => 'Phone Number', 'required' => false, 'placeholder' => '(555) 123-4567'],
                    'address' => ['type' => 'textarea', 'label' => 'Address', 'required' => false, 'placeholder' => 'Company address'],
                    'website' => ['type' => 'url', 'label' => 'Website', 'required' => false, 'placeholder' => 'https://company.com']
                ]
            ],
            'legal' => [
                'title' => 'Legal Settings',
                'description' => 'Legal and compliance configuration',
                'icon' => 'shield-check',
                'fields' => [
                    'copyrightHolder' => ['type' => 'text', 'label' => 'Copyright Holder', 'required' => true, 'placeholder' => 'Your Company Name'],
                    'privacy_policy' => ['type' => 'url', 'label' => 'Privacy Policy URL', 'required' => false, 'placeholder' => 'https://yoursite.com/privacy'],
                    'terms_of_service' => ['type' => 'url', 'label' => 'Terms of Service URL', 'required' => false, 'placeholder' => 'https://yoursite.com/terms']
                ]
            ],
            'meta' => [
                'title' => 'SEO & Meta Settings',
                'description' => 'Search engine optimization and metadata',
                'icon' => 'search',
                'fields' => [
                    'site_title' => ['type' => 'text', 'label' => 'Meta Site Title', 'required' => false, 'placeholder' => 'Your Site — Tagline'],
                    'site_description' => ['type' => 'textarea', 'label' => 'Meta Description', 'required' => false, 'placeholder' => 'Site description for search engines'],
                    'twitter' => ['type' => 'text', 'label' => 'Twitter Handle', 'required' => false, 'placeholder' => '@yourhandle']
                ]
            ]
        ];
    }

    /**
     * Display settings overview
     */
    public function index(): string
    {
        $data = [
            'title' => 'Admin Settings',
            'categories' => $this->managedCategories,
            'settings_count' => []
        ];

        // Get count of settings per category
        foreach (array_keys($this->managedCategories) as $category) {
            $data['settings_count'][$category] = count($this->settingsModel->getClassSettings($category));
        }

        return view('admin/settings/index', $data);
    }

    /**
     * Display settings for a specific category
     */
    public function category(string $category): string
    {
        if (!isset($this->managedCategories[$category])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Settings category '{$category}' not found");
        }

        $categoryConfig = $this->managedCategories[$category];
        $currentSettings = $this->settingsModel->getClassSettings($category);

        $data = [
            'title' => $categoryConfig['title'],
            'category' => $category,
            'category_config' => $categoryConfig,
            'current_settings' => $currentSettings,
            'breadcrumb' => [
                'Admin Settings' => '/admin/settings',
                $categoryConfig['title'] => ''
            ]
        ];

        return view('admin/settings/category', $data);
    }

    /**
     * Update settings for a category
     */
    public function update(string $category): ResponseInterface
    {
        if (!isset($this->managedCategories[$category])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => "Settings category '{$category}' not found"
            ])->setStatusCode(404);
        }

        $categoryConfig = $this->managedCategories[$category];
        $postData = $this->request->getPost();
        $errors = [];
        $updates = [];

        // Validate each field
        foreach ($categoryConfig['fields'] as $fieldKey => $fieldConfig) {
            $value = $postData[$fieldKey] ?? null;

            // Check required fields
            if ($fieldConfig['required'] && empty($value)) {
                $errors[$fieldKey] = $fieldConfig['label'] . ' is required';
                continue;
            }

            // Type-specific validation
            if (!empty($value)) {
                switch ($fieldConfig['type']) {
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$fieldKey] = 'Please enter a valid email address';
                            continue 2;
                        }
                        break;
                    
                    case 'url':
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $errors[$fieldKey] = 'Please enter a valid URL';
                            continue 2;
                        }
                        break;
                }
            }

            // Prepare for update
            $updates[$fieldKey] = $value;
        }

        if (!empty($errors)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errors
            ])->setStatusCode(400);
        }

        // Update settings
        $success = $this->settingsModel->setClassSettings($category, $updates);

        if ($success) {
            // Clear any cached settings
            $this->settingsModel->clearCache();

            return $this->response->setJSON([
                'success' => true,
                'message' => $categoryConfig['title'] . ' updated successfully',
                'redirect' => '/admin/settings/' . $category
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update settings. Please try again.'
            ])->setStatusCode(500);
        }
    }

    /**
     * Reset settings for a category to defaults
     */
    public function reset(string $category): ResponseInterface
    {
        if (!isset($this->managedCategories[$category])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => "Settings category '{$category}' not found"
            ])->setStatusCode(404);
        }

        // Get default values from Admin config
        $adminConfig = config('Admin');
        $defaults = [];

        switch ($category) {
            case 'site':
                $defaults = $adminConfig->site;
                break;
            case 'theme':
                $defaults = $adminConfig->theme;
                break;
            case 'company':
                $defaults = $adminConfig->company;
                break;
            case 'legal':
                $defaults = $adminConfig->legal;
                break;
            case 'meta':
                $defaults = $adminConfig->meta;
                break;
        }

        if (empty($defaults)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No defaults found for this category'
            ])->setStatusCode(400);
        }

        // Update settings with defaults
        $success = $this->settingsModel->setClassSettings($category, $defaults);

        if ($success) {
            $this->settingsModel->clearCache();
            
            return $this->response->setJSON([
                'success' => true,
                'message' => $this->managedCategories[$category]['title'] . ' reset to defaults',
                'redirect' => '/admin/settings/' . $category
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to reset settings. Please try again.'
            ])->setStatusCode(500);
        }
    }

    /**
     * Initialize all default settings
     */
    public function initialize(): ResponseInterface
    {
        $success = $this->settingsModel->initializeDefaults();

        if ($success) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'All settings initialized with default values',
                'redirect' => '/admin/settings'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to initialize settings. Please try again.'
            ])->setStatusCode(500);
        }
    }

    /**
     * Export all settings as JSON
     */
    public function export(): ResponseInterface
    {
        $allSettings = [];

        foreach (array_keys($this->managedCategories) as $category) {
            $allSettings[$category] = $this->settingsModel->getClassSettings($category);
        }

        $filename = 'settings_export_' . date('Y-m-d_H-i-s') . '.json';

        return $this->response
            ->setJSON($allSettings)
            ->setHeader('Content-Type', 'application/json')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Get current settings as JSON (for AJAX requests)
     */
    public function getSettings(?string $category = null): ResponseInterface
    {
        if ($category) {
            if (!isset($this->managedCategories[$category])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => "Settings category '{$category}' not found"
                ])->setStatusCode(404);
            }

            $settings = $this->settingsModel->getClassSettings($category);
        } else {
            $settings = [];
            foreach (array_keys($this->managedCategories) as $cat) {
                $settings[$cat] = $this->settingsModel->getClassSettings($cat);
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'settings' => $settings
        ]);
    }
}