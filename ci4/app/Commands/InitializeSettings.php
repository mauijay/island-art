<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\SettingsModel;

class InitializeSettings extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Settings';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'settings:init';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Initialize default settings from Admin config';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'settings:init [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '--force' => 'Force override existing settings'
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        CLI::write('Initializing application settings...', 'green');

        $settingsModel = new SettingsModel();
        $force = CLI::getOption('force');

        // Initialize default settings
        $adminConfig = config('Admin');

        $categories = [
            'site' => $adminConfig->site,
            'theme' => $adminConfig->theme,
            'company' => $adminConfig->company,
            'legal' => $adminConfig->legal,
            'meta' => $adminConfig->meta
        ];

        $totalSettings = 0;
        $newSettings = 0;
        $updatedSettings = 0;

        foreach ($categories as $category => $settings) {
            CLI::write("Processing {$category} settings...", 'yellow');

            foreach ($settings as $key => $value) {
                $totalSettings++;

                // Check if setting already exists
                $existing = $settingsModel->getSetting($category, $key);

                if ($existing === null || $force) {
                    // Determine type
                    $type = 'string';
                    if (is_bool($value)) {
                        $type = 'boolean';
                    } elseif (is_int($value)) {
                        $type = 'integer';
                    } elseif (is_array($value)) {
                        $type = 'json';
                    }

                    $success = $settingsModel->setSetting($category, $key, $value, $type);

                    if ($success) {
                        if ($existing === null) {
                            $newSettings++;
                            CLI::write("  ✓ Created: {$category}.{$key}", 'green');
                        } else {
                            $updatedSettings++;
                            CLI::write("  ✓ Updated: {$category}.{$key}", 'blue');
                        }
                    } else {
                        CLI::write("  ✗ Failed: {$category}.{$key}", 'red');
                    }
                } else {
                    CLI::write("  - Skipped: {$category}.{$key} (exists)", 'white');
                }
            }
        }

        CLI::newLine();
        CLI::write('Settings initialization complete!', 'green');
        CLI::write("Total settings processed: {$totalSettings}", 'white');
        CLI::write("New settings created: {$newSettings}", 'green');
        CLI::write("Settings updated: {$updatedSettings}", 'blue');
        CLI::newLine();

        if ($newSettings === 0 && $updatedSettings === 0 && !$force) {
            CLI::write('Tip: Use --force to override existing settings', 'yellow');
        }
    }
}
