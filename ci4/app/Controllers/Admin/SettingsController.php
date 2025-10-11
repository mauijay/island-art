<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SettingsController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Settings - Island Art Admin',
            'pageTitle' => 'Settings',
            'description' => 'Manage Island Art CMS settings, configuration, and preferences',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route_to('admin.dashboard')],
                ['title' => 'Settings']
            ],
            'settings' => $this->getSettings(),
        ];

        return view('admin/settings/index', $data);
    }

    public function show($section = 'general')
    {
        $data = [
            'title' => ucfirst($section) . ' Settings - Island Art Admin',
            'pageTitle' => ucfirst($section) . ' Settings',
            'description' => 'Manage ' . $section . ' settings for Island Art',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route_to('admin.dashboard')],
                ['title' => 'Settings', 'url' => route_to('admin.settings')],
                ['title' => ucfirst($section)]
            ],
            'section' => $section,
            'settings' => $this->getSectionSettings($section),
        ];

        return view('admin/settings/section', $data);
    }

    public function update()
    {
        $rules = [
            'section' => 'required|in_list[general,cms,analytics,users,email,security]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Invalid form data');
        }

        $section = $this->request->getPost('section');
        $settings = $this->request->getPost('settings');

        try {
            $this->updateSectionSettings($section, $settings);
            
            return redirect()->to(route_to('admin.settings.show', $section))
                           ->with('success', ucfirst($section) . ' settings updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                           ->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }

    private function getSettings(): array
    {
        return [
            'general' => [
                'title' => 'General Settings',
                'description' => 'Basic site configuration and branding',
                'icon' => 'fas fa-cog',
                'count' => 8
            ],
            'cms' => [
                'title' => 'CMS Settings',
                'description' => 'Content management system preferences',
                'icon' => 'fas fa-edit',
                'count' => 12
            ],
            'analytics' => [
                'title' => 'Analytics',
                'description' => 'Tracking and analytics configuration',
                'icon' => 'fas fa-chart-line',
                'count' => 5
            ],
            'users' => [
                'title' => 'User Management',
                'description' => 'User registration and access control',
                'icon' => 'fas fa-users',
                'count' => 6
            ],
            'email' => [
                'title' => 'Email Settings',
                'description' => 'SMTP and email notification settings',
                'icon' => 'fas fa-envelope',
                'count' => 7
            ],
            'security' => [
                'title' => 'Security',
                'description' => 'Security and authentication settings',
                'icon' => 'fas fa-shield-alt',
                'count' => 9
            ],
        ];
    }

    private function getSectionSettings($section): array
    {
        switch ($section) {
            case 'general':
                return [
                    'site_name' => site_title(),
                    'site_description' => setting('App.siteDescription') ?? 'Discover Hawaiian Art',
                    'site_keywords' => setting('App.siteKeywords') ?? 'hawaii, art, gallery, artists',
                    'contact_email' => setting('App.contactEmail') ?? 'info@islandart.com',
                    'timezone' => setting('App.timezone') ?? 'Pacific/Honolulu',
                    'language' => setting('App.language') ?? 'en',
                    'maintenance_mode' => setting('App.maintenanceMode') ?? false,
                    'debug_mode' => setting('App.debugMode') ?? false,
                ];

            case 'cms':
                return [
                    'posts_per_page' => setting('CMS.postsPerPage') ?? 12,
                    'auto_save_interval' => setting('CMS.autoSaveInterval') ?? 60,
                    'allow_comments' => setting('CMS.allowComments') ?? true,
                    'moderate_comments' => setting('CMS.moderateComments') ?? true,
                    'max_upload_size' => setting('CMS.maxUploadSize') ?? 10,
                    'allowed_file_types' => setting('CMS.allowedFileTypes') ?? 'jpg,jpeg,png,gif,pdf',
                    'enable_revisions' => setting('CMS.enableRevisions') ?? true,
                    'max_revisions' => setting('CMS.maxRevisions') ?? 10,
                    'enable_seo' => setting('CMS.enableSEO') ?? true,
                    'default_meta_description' => setting('CMS.defaultMetaDescription') ?? '',
                    'enable_social_sharing' => setting('CMS.enableSocialSharing') ?? true,
                    'cache_duration' => setting('CMS.cacheDuration') ?? 3600,
                ];

            case 'analytics':
                return [
                    'google_analytics_id' => setting('Analytics.googleAnalyticsId') ?? '',
                    'google_tag_manager_id' => setting('Analytics.googleTagManagerId') ?? '',
                    'facebook_pixel_id' => setting('Analytics.facebookPixelId') ?? '',
                    'enable_visitor_tracking' => setting('Analytics.enableVisitorTracking') ?? true,
                    'track_downloads' => setting('Analytics.trackDownloads') ?? true,
                ];

            case 'users':
                return [
                    'allow_registration' => setting('Users.allowRegistration') ?? true,
                    'require_email_verification' => setting('Users.requireEmailVerification') ?? true,
                    'default_user_role' => setting('Users.defaultUserRole') ?? 'user',
                    'session_timeout' => setting('Users.sessionTimeout') ?? 7200,
                    'max_login_attempts' => setting('Users.maxLoginAttempts') ?? 5,
                    'lockout_duration' => setting('Users.lockoutDuration') ?? 300,
                ];

            case 'email':
                return [
                    'smtp_host' => setting('Email.SMTPHost') ?? '',
                    'smtp_port' => setting('Email.SMTPPort') ?? 587,
                    'smtp_username' => setting('Email.SMTPUser') ?? '',
                    'smtp_password' => setting('Email.SMTPPass') ?? '',
                    'smtp_encryption' => setting('Email.SMTPCrypto') ?? 'tls',
                    'from_email' => setting('Email.fromEmail') ?? 'noreply@islandart.com',
                    'from_name' => setting('Email.fromName') ?? 'Island Art',
                ];

            case 'security':
                return [
                    'enable_csrf' => setting('Security.enableCSRF') ?? true,
                    'csrf_token_name' => setting('Security.CSRFTokenName') ?? 'csrf_token',
                    'csrf_expire' => setting('Security.CSRFExpire') ?? 7200,
                    'enable_rate_limiting' => setting('Security.enableRateLimiting') ?? true,
                    'rate_limit_requests' => setting('Security.rateLimitRequests') ?? 100,
                    'rate_limit_window' => setting('Security.rateLimitWindow') ?? 3600,
                    'force_https' => setting('Security.forceHTTPS') ?? false,
                    'secure_headers' => setting('Security.secureHeaders') ?? true,
                    'content_security_policy' => setting('Security.contentSecurityPolicy') ?? false,
                ];

            default:
                return [];
        }
    }

    private function updateSectionSettings($section, $settings): void
    {
        if (!is_array($settings)) {
            throw new \InvalidArgumentException('Settings must be an array');
        }

        foreach ($settings as $key => $value) {
            $settingKey = ucfirst($section) . '.' . $key;
            setting($settingKey, $value);
        }

        // Clear cache after updating settings
        cache()->clean();
    }
}