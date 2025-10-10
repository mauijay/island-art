<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Dashboard Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
    <!-- Total Artists -->
    <div class="admin-stat-card">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Artists</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['total_artists'] ?></p>
                <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                    <i class="fas fa-arrow-up"></i> +12% from last month
                </p>
            </div>
            <div class="admin-stat-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Total Galleries -->
    <div class="admin-stat-card">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Galleries</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['total_galleries'] ?></p>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                    <i class="fas fa-arrow-up"></i> +5% from last month
                </p>
            </div>
            <div class="admin-stat-icon">
                <i class="fas fa-images"></i>
            </div>
        </div>
    </div>

    <!-- Total Exhibitions -->
    <div class="admin-stat-card">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Exhibitions</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['total_exhibitions'] ?></p>
                <p class="text-xs text-purple-600 dark:text-purple-400 mt-1">
                    <i class="fas fa-arrow-up"></i> +8% from last month
                </p>
            </div>
            <div class="admin-stat-icon">
                <i class="fas fa-building-columns"></i>
            </div>
        </div>
    </div>

    <!-- Total Artwork -->
    <div class="admin-stat-card">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Artwork</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['total_artwork'] ?></p>
                <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">
                    <i class="fas fa-arrow-up"></i> +15% from last month
                </p>
            </div>
            <div class="admin-stat-icon">
                <i class="fas fa-paintbrush"></i>
            </div>
        </div>
    </div>

    <!-- Pending Submissions -->
    <div class="admin-stat-card">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Pending</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['pending_submissions'] ?></p>
                <p class="text-xs text-red-600 dark:text-red-400 mt-1">
                    <i class="fas fa-clock"></i> Needs review
                </p>
            </div>
            <div class="admin-stat-icon">
                <i class="fas fa-inbox"></i>
            </div>
        </div>
    </div>

    <!-- Monthly Visitors -->
    <div class="admin-stat-card">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Visitors</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= number_format($stats['monthly_visitors']) ?></p>
                <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                    <i class="fas fa-arrow-up"></i> +23% from last month
                </p>
            </div>
            <div class="admin-stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Activity -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Activity</h3>
            <a href="<?= route_to('admin.activity') ?>" class="text-sm text-island-blue hover:text-island-blue/80">View All</a>
        </div>
        
        <div class="space-y-4">
            <?php foreach ($recentActivity as $activity): ?>
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center">
                        <i class="<?= $activity['icon'] ?> text-sm <?= $activity['color'] ?>"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-slate-900 dark:text-white"><?= $activity['description'] ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><?= $activity['time'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (empty($recentActivity)): ?>
        <div class="text-center py-8">
            <i class="fas fa-inbox text-4xl text-slate-300 dark:text-slate-600 mb-4"></i>
            <p class="text-slate-500 dark:text-slate-400">No recent activity</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pending Submissions -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Pending Submissions</h3>
            <a href="<?= route_to('admin.submissions') ?>" class="text-sm text-island-blue hover:text-island-blue/80">View All</a>
        </div>
        
        <div class="space-y-4">
            <?php foreach ($pendingSubmissions as $submission): ?>
            <div class="flex items-center space-x-4 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                <div class="flex-shrink-0">
                    <img src="<?= base_url('uploads/thumbnails/' . $submission['image']) ?>" 
                         alt="<?= esc($submission['artwork_title']) ?>"
                         class="w-12 h-12 rounded-lg object-cover"
                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'%23ccc\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'/%3E%3C/svg%3E'">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-900 dark:text-white truncate"><?= esc($submission['artwork_title']) ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">by <?= esc($submission['artist_name']) ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><?= date('M j, Y', strtotime($submission['submitted_at'])) ?></p>
                </div>
                <div class="flex-shrink-0 flex space-x-2">
                    <button class="btn-admin-primary text-xs px-3 py-1" data-modal-target="review-modal-<?= $submission['id'] ?>">
                        Review
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (empty($pendingSubmissions)): ?>
        <div class="text-center py-8">
            <i class="fas fa-check-circle text-4xl text-green-300 dark:text-green-600 mb-4"></i>
            <p class="text-slate-500 dark:text-slate-400">No pending submissions</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <div class="admin-card">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">Quick Actions</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="<?= route_to('admin.artists.create') ?>" class="flex items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 group">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-plus text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium">Add Artist</p>
                    <p class="text-xs opacity-90">Create new artist profile</p>
                </div>
                <div class="ml-auto">
                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>
            
            <a href="<?= route_to('admin.galleries.create') ?>" class="flex items-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 group">
                <div class="flex-shrink-0">
                    <i class="fas fa-images text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium">New Gallery</p>
                    <p class="text-xs opacity-90">Create image gallery</p>
                </div>
                <div class="ml-auto">
                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>
            
            <a href="<?= route_to('admin.exhibitions.create') ?>" class="flex items-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-200 group">
                <div class="flex-shrink-0">
                    <i class="fas fa-building-columns text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium">Add Exhibition</p>
                    <p class="text-xs opacity-90">Schedule new exhibition</p>
                </div>
                <div class="ml-auto">
                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>
            
            <a href="<?= route_to('admin.events.create') ?>" class="flex items-center p-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 group">
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar-plus text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium">New Event</p>
                    <p class="text-xs opacity-90">Schedule calendar event</p>
                </div>
                <div class="ml-auto">
                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<style>
/* Additional dashboard-specific styles */
.admin-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.admin-stat-card {
    transition: all 0.2s ease-in-out;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
// Dashboard-specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh dashboard stats every 30 seconds
    setInterval(function() {
        // You could implement auto-refresh here
        console.log('Dashboard auto-refresh would happen here');
    }, 30000);
    
    // Initialize any dashboard-specific components
    initializeDashboardCharts();
});

function initializeDashboardCharts() {
    // Placeholder for chart initialization
    // You could integrate Chart.js or similar library here
    console.log('Dashboard charts would be initialized here');
}
</script>
<?= $this->endSection() ?>