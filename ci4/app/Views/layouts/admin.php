<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title ?? 'Admin Dashboard' ?> - Island Art Admin</title>
  <meta name="description" content="<?= $description ?? 'Island Art Admin Dashboard' ?>">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?= csrf_token() ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Tailwind CSS via CDN (for development) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Admin CSS -->
  <?= vite_css(['resources/css/admin.css']) ?>

  <!-- Additional CSS -->
  <?= $this->renderSection('css') ?>

  <script>
    // Tailwind config for admin
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            'sans': ['Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            'island-blue': '#0ea5e9',
            'island-teal': '#14b8a6',
            'island-emerald': '#10b981',
          }
        }
      }
    }
  </script>
</head>

<body class="bg-slate-50 dark:bg-slate-900 font-sans antialiased">

  <!-- Mobile sidebar overlay -->
  <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden"></div>

  <!-- Sidebar -->
  <aside id="admin-sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out admin-scrollbar overflow-y-auto">
    <!-- Logo -->
    <div class="flex items-center h-16 px-6 border-b border-slate-200 dark:border-slate-700">
      <div class="flex items-center space-x-3">
        <div
          class="w-8 h-8 bg-gradient-to-br from-island-blue to-island-teal rounded-lg flex items-center justify-center">
          <i class="fas fa-palette text-white text-sm"></i>
        </div>
        <div>
          <h1 class="text-lg font-semibold text-slate-900 dark:text-white">Island Art</h1>
          <p class="text-xs text-slate-500 dark:text-slate-400">Admin Panel</p>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="px-4 py-6 space-y-2">
      <!-- Dashboard -->
      <a href="<?= route_to('admin.dashboard') ?>"
        class="admin-nav-item <?= uri_string() == 'admin' ? 'active' : '' ?>">
        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
        <span>Dashboard</span>
      </a>

      <!-- Content Management -->
      <div class="pt-4">
        <h3 class="px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Content
        </h3>

        <a href="<?= route_to('admin.artists') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'artists') ? 'active' : '' ?>">
          <i class="fas fa-users w-5 h-5 mr-3"></i>
          <span>Artists</span>
        </a>

        <a href="<?= route_to('admin.galleries') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'galleries') ? 'active' : '' ?>">
          <i class="fas fa-images w-5 h-5 mr-3"></i>
          <span>Galleries</span>
        </a>

        <a href="<?= route_to('admin.exhibitions') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'exhibitions') ? 'active' : '' ?>">
          <i class="fas fa-building-columns w-5 h-5 mr-3"></i>
          <span>Exhibitions</span>
        </a>

        <a href="<?= route_to('admin.events') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'events') ? 'active' : '' ?>">
          <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
          <span>Events</span>
        </a>

        <a href="<?= route_to('admin.artwork') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'artwork') ? 'active' : '' ?>">
          <i class="fas fa-paintbrush w-5 h-5 mr-3"></i>
          <span>Artwork</span>
        </a>
      </div>

      <!-- Media Management -->
      <div class="pt-4">
        <h3 class="px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Media
        </h3>

        <a href="<?= route_to('admin.media') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'media') ? 'active' : '' ?>">
          <i class="fas fa-photo-video w-5 h-5 mr-3"></i>
          <span>Media Library</span>
        </a>

        <a href="<?= route_to('admin.submissions') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'submissions') ? 'active' : '' ?>">
          <i class="fas fa-inbox w-5 h-5 mr-3"></i>
          <span>Submissions</span>
        </a>
      </div>

      <!-- System -->
      <div class="pt-4">
        <h3 class="px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">System
        </h3>

        <a href="<?= route_to('admin.users') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'users') ? 'active' : '' ?>">
          <i class="fas fa-user-cog w-5 h-5 mr-3"></i>
          <span>Users</span>
        </a>

        <a href="<?= route_to('admin.settings') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'settings') ? 'active' : '' ?>">
          <i class="fas fa-cog w-5 h-5 mr-3"></i>
          <span>Settings</span>
        </a>

        <a href="<?= route_to('admin.analytics') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'analytics') ? 'active' : '' ?>">
          <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
          <span>Analytics</span>
        </a>

        <a href="<?= route_to('admin.logs') ?>"
          class="admin-nav-item <?= str_contains(uri_string(), 'logs') ? 'active' : '' ?>">
          <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
          <span>Logs</span>
        </a>
      </div>
    </nav>

    <!-- Footer -->
    <div
      class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
      <a href="<?= route_to('home') ?>"
        class="flex items-center text-sm text-slate-600 dark:text-slate-400 hover:text-island-blue transition-colors">
        <i class="fas fa-external-link-alt w-4 h-4 mr-2"></i>
        <span>View Website</span>
      </a>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="lg:ml-64">
    <!-- Top Navigation -->
    <header
      class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 h-16 flex items-center justify-between px-6">
      <!-- Mobile menu button -->
      <button id="sidebar-toggle"
        class="lg:hidden text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
        <i class="fas fa-bars text-xl"></i>
      </button>

      <!-- Page title -->
      <div class="flex-1 lg:flex-none">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white"><?= $pageTitle ?? 'Dashboard' ?></h2>
      </div>

      <!-- Top navigation actions -->
      <div class="flex items-center space-x-4">
        <!-- Notifications -->
        <div class="relative">
          <button class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white relative"
            data-dropdown-toggle="notifications-dropdown">
            <i class="fas fa-bell text-lg"></i>
            <span
              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
          </button>

          <!-- Notifications dropdown -->
          <div id="notifications-dropdown"
            class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 z-50">
            <div class="p-4 border-b border-slate-200 dark:border-slate-700">
              <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Notifications</h3>
            </div>
            <div class="max-h-64 overflow-y-auto">
              <a href="#"
                class="block p-4 hover:bg-slate-50 dark:hover:bg-slate-700 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-start">
                  <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                  <div class="flex-1">
                    <p class="text-sm text-slate-900 dark:text-white">New artwork submission</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">2 minutes ago</p>
                  </div>
                </div>
              </a>
              <a href="#"
                class="block p-4 hover:bg-slate-50 dark:hover:bg-slate-700 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-start">
                  <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                  <div class="flex-1">
                    <p class="text-sm text-slate-900 dark:text-white">Gallery updated</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">1 hour ago</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="p-4 text-center border-t border-slate-200 dark:border-slate-700">
              <a href="<?= route_to('admin.notifications') ?>"
                class="text-sm text-island-blue hover:text-island-blue/80">View all notifications</a>
            </div>
          </div>
        </div>

        <!-- Dark mode toggle -->
        <button id="dark-mode-toggle"
          class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white"
          data-tooltip="Toggle dark mode">
          <i class="fas fa-moon text-lg"></i>
        </button>

        <!-- User menu -->
        <div class="relative">
          <button
            class="flex items-center space-x-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white"
            data-dropdown-toggle="user-dropdown">
            <img
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=32&h=32&q=80"
              alt="User" class="w-8 h-8 rounded-full">
            <span class="hidden md:block text-sm font-medium"><?= auth()->user()?->username ?? 'Admin' ?></span>
            <i class="fas fa-chevron-down text-xs"></i>
          </button>

          <!-- User dropdown -->
          <div id="user-dropdown"
            class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 z-50">
            <div class="p-4 border-b border-slate-200 dark:border-slate-700">
              <p class="text-sm font-medium text-slate-900 dark:text-white">
                <?= auth()->user()?->username ?? 'Administrator' ?></p>
              <p class="text-xs text-slate-500 dark:text-slate-400">
                <?= auth()->user()?->email ?? 'admin@islandart.com' ?></p>
            </div>
            <div class="py-2">
              <a href="<?= route_to('admin.profile') ?>"
                class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                <i class="fas fa-user-circle w-4 h-4 mr-2"></i>
                Profile
              </a>
              <a href="<?= route_to('admin.settings') ?>"
                class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                <i class="fas fa-cog w-4 h-4 mr-2"></i>
                Settings
              </a>
              <hr class="my-2 border-slate-200 dark:border-slate-700">
              <a href="<?= route_to('logout') ?>"
                class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                <i class="fas fa-sign-out-alt w-4 h-4 mr-2"></i>
                Logout
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <main class="p-6">
      <!-- Breadcrumbs -->
      <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
        <nav class="mb-6" aria-label="Breadcrumb">
          <ol class="flex items-center space-x-2 text-sm text-slate-500 dark:text-slate-400">
            <li>
              <a href="<?= route_to('admin.dashboard') ?>" class="hover:text-island-blue">
                <i class="fas fa-home"></i>
              </a>
            </li>
            <?php foreach ($breadcrumbs as $breadcrumb): ?>
              <li class="flex items-center">
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <?php if (isset($breadcrumb['url'])): ?>
                  <a href="<?= $breadcrumb['url'] ?>" class="hover:text-island-blue"><?= $breadcrumb['title'] ?></a>
                <?php else: ?>
                  <span class="text-slate-900 dark:text-white"><?= $breadcrumb['title'] ?></span>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ol>
        </nav>
      <?php endif; ?>

      <!-- Flash Messages -->
      <?php if (session()->has('success')): ?>
        <div class="admin-alert-success mb-6">
          <i class="fas fa-check-circle mr-2"></i>
          <?= session('success') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->has('error')): ?>
        <div class="admin-alert-error mb-6">
          <i class="fas fa-exclamation-circle mr-2"></i>
          <?= session('error') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->has('warning')): ?>
        <div class="admin-alert-warning mb-6">
          <i class="fas fa-exclamation-triangle mr-2"></i>
          <?= session('warning') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->has('info')): ?>
        <div class="admin-alert-info mb-6">
          <i class="fas fa-info-circle mr-2"></i>
          <?= session('info') ?>
        </div>
      <?php endif; ?>

      <!-- Page Content -->
      <?= $this->renderSection('content') ?>
    </main>
  </div>

  <!-- Admin JavaScript -->
  <?= vite_js(['resources/js/admin.js']) ?>

  <!-- Additional JavaScript -->
  <?= $this->renderSection('js') ?>

</body>

</html>
