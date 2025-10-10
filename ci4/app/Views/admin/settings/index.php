<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Settings Navigation -->
    <div class="lg:col-span-1">
        <div class="admin-card">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">Settings Categories</h3>
            
            <nav class="space-y-2">
                <?php foreach ($settings as $key => $setting): ?>
                <a href="<?= route_to('admin.settings.show', $key) ?>" 
                   class="flex items-center p-3 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group">
                    <div class="flex-shrink-0">
                        <i class="<?= $setting['icon'] ?> w-5 h-5 text-slate-400 group-hover:text-island-blue"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium"><?= $setting['title'] ?></p>
                        <p class="text-xs text-slate-500 dark:text-slate-400"><?= $setting['description'] ?></p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                            <?= $setting['count'] ?>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </nav>
        </div>
        
        <!-- Quick Actions -->
        <div class="admin-card mt-6">
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Quick Actions</h4>
            
            <div class="space-y-3">
                <button onclick="clearCache()" class="w-full flex items-center p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg text-yellow-800 dark:text-yellow-200 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 transition-colors">
                    <i class="fas fa-broom w-4 h-4 mr-3"></i>
                    <span class="text-sm">Clear Cache</span>
                </button>
                
                <button onclick="exportSettings()" class="w-full flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg text-blue-800 dark:text-blue-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                    <i class="fas fa-download w-4 h-4 mr-3"></i>
                    <span class="text-sm">Export Settings</span>
                </button>
                
                <button onclick="backupDatabase()" class="w-full flex items-center p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-200 hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors">
                    <i class="fas fa-database w-4 h-4 mr-3"></i>
                    <span class="text-sm">Backup Database</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Settings Overview -->
    <div class="lg:col-span-2">
        <div class="admin-card">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Settings Overview</h3>
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-200">
                        <i class="fas fa-check-circle w-3 h-3 mr-1"></i>
                        All systems operational
                    </span>
                </div>
            </div>
            
            <!-- Settings Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($settings as $key => $setting): ?>
                <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-6 hover:border-island-blue dark:hover:border-island-blue transition-colors group">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center group-hover:bg-island-blue group-hover:text-white transition-colors">
                                <i class="<?= $setting['icon'] ?> text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-slate-900 dark:text-white mb-1"><?= $setting['title'] ?></h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3"><?= $setting['description'] ?></p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-500 dark:text-slate-400"><?= $setting['count'] ?> settings</span>
                                <a href="<?= route_to('admin.settings.show', $key) ?>" class="inline-flex items-center text-xs text-island-blue hover:text-island-blue/80">
                                    Configure
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- System Information -->
        <div class="admin-card mt-6">
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">System Information</h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dl class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">CodeIgniter Version</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= \CodeIgniter\CodeIgniter::CI_VERSION ?></dd>
                        </div>
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">PHP Version</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= PHP_VERSION ?></dd>
                        </div>
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">Environment</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= ENVIRONMENT ?></dd>
                        </div>
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">Timezone</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= date_default_timezone_get() ?></dd>
                        </div>
                    </dl>
                </div>
                
                <div>
                    <dl class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">Memory Limit</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= ini_get('memory_limit') ?></dd>
                        </div>
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">Upload Max Size</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= ini_get('upload_max_filesize') ?></dd>
                        </div>
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">Post Max Size</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= ini_get('post_max_size') ?></dd>
                        </div>
                        <div class="flex justify-between text-sm">
                            <dt class="text-slate-500 dark:text-slate-400">Max Execution Time</dt>
                            <dd class="text-slate-900 dark:text-white font-medium"><?= ini_get('max_execution_time') ?>s</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
function clearCache() {
    if (confirm('Are you sure you want to clear the cache? This may temporarily slow down the site.')) {
        adminDashboard.apiRequest('/admin/cache/clear', {
            method: 'POST'
        }).then(data => {
            adminDashboard.showNotification('Cache cleared successfully', 'success');
        }).catch(error => {
            adminDashboard.showNotification('Failed to clear cache', 'error');
        });
    }
}

function exportSettings() {
    adminDashboard.apiRequest('/admin/settings/export', {
        method: 'POST'
    }).then(data => {
        // Create download link
        const blob = new Blob([JSON.stringify(data.settings, null, 2)], { type: 'application/json' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'island-art-settings-' + new Date().toISOString().split('T')[0] + '.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        
        adminDashboard.showNotification('Settings exported successfully', 'success');
    }).catch(error => {
        adminDashboard.showNotification('Failed to export settings', 'error');
    });
}

function backupDatabase() {
    if (confirm('Are you sure you want to create a database backup? This may take a few minutes.')) {
        adminDashboard.showNotification('Database backup started...', 'info');
        
        adminDashboard.apiRequest('/admin/database/backup', {
            method: 'POST'
        }).then(data => {
            adminDashboard.showNotification('Database backup completed successfully', 'success');
        }).catch(error => {
            adminDashboard.showNotification('Failed to backup database', 'error');
        });
    }
}
</script>
<?= $this->endSection() ?>