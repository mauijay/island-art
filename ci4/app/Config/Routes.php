<?php declare(strict_types=1);

use App\Controllers\ApiController;
use App\Controllers\ArtistsController;
use App\Controllers\BlogsController;
use App\Controllers\CalendarController;
use App\Controllers\ExhibitionsController;
use App\Controllers\GalleriesController;
use App\Controllers\HomeController;
use App\Controllers\LegalController;
use App\Controllers\DashboardController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

//$routes->get('/', 'Home::index'); --- IGNORE ---
$routes->get('/', [HomeController::class, 'index'], ['as' => 'home']);
$routes->get('contact', [HomeController::class, 'contact'], ['as' => 'contact']);
$routes->get('calendar', [CalendarController::class, 'index'], ['as' => 'calendar']);
$routes->get('artists', [ArtistsController::class, 'index'], ['as' => 'artists']);
// Galleries
$routes->get('galleries', [GalleriesController::class, 'index'], ['as' => 'galleries']);
$routes->get('galleries/(:num)', [GalleriesController::class, 'show/$1'], ['as' => 'galleries.show']);
$routes->get('galleries/create', [GalleriesController::class, 'create'], ['as' => 'galleries.create']);
$routes->post('galleries', [GalleriesController::class, 'store'], ['as' => 'galleries.store']);
$routes->get('galleries/(:num)/edit', [GalleriesController::class, 'edit/$1'], ['as' => 'galleries.edit']);
$routes->post('galleries/(:num)', [GalleriesController::class, 'update/$1'], ['as' => 'galleries.update']);
$routes->post('galleries/(:num)/delete', [GalleriesController::class, 'delete/$1'], ['as' => 'galleries.delete']);
// Exhibitions
$routes->get('exhibitions', [ExhibitionsController::class, 'index'], ['as' => 'exhibitions']);
$routes->get('exhibitions/(:num)', [ExhibitionsController::class, 'show/$1'], ['as' => 'exhibitions.show']);
$routes->get('exhibitions/create', [ExhibitionsController::class, 'create'], ['as' => 'exhibitions.create']);
$routes->post('exhibitions', [ExhibitionsController::class, 'store'], ['as' => 'exhibitions.store']);
$routes->get('exhibitions/(:num)/edit', [ExhibitionsController::class, 'edit/$1'], ['as' => 'exhibitions.edit']);
$routes->post('exhibitions/(:num)', [ExhibitionsController::class, 'update/$1'], ['as' => 'exhibitions.update']);
$routes->post('exhibitions/(:num)/delete', [ExhibitionsController::class, 'delete/$1'], ['as' => 'exhibitions.delete']);
// Art Submission
// API Routes
$routes->get('api/test', [ApiController::class, 'test']);
$routes->get('api/artworks', [ApiController::class, 'getArtworks']);
$routes->post('api/submit-artwork', [ApiController::class, 'submitArtwork']);
// News and Blogs
$routes->get('blogs', [BlogsController::class, 'index'], ['as' => 'news']);
// Legal Stuff
$routes->get('terms-of-service', [LegalController::class, 'terms'], ['as' => 'terms']);
$routes->get('privacy-policy', [LegalController::class, 'privacy'], ['as' => 'privacy']);

service('auth')->routes($routes);

// Admin Routes Group
$routes->group('admin', ['filter' => 'group:admin,superadmin'], static function ($routes): void {
  // Dashboard
  $routes->get('', [DashboardController::class, 'index'], ['as' => 'admin.dashboard']);

  // Artists Management
  $routes->get('artists', 'Admin\ArtistsController::index', ['as' => 'admin.artists']);
  $routes->get('artists/create', 'Admin\ArtistsController::create', ['as' => 'admin.artists.create']);
  $routes->post('artists', 'Admin\ArtistsController::store', ['as' => 'admin.artists.store']);
  $routes->get('artists/(:num)', 'Admin\ArtistsController::show/$1', ['as' => 'admin.artists.show']);
  $routes->get('artists/(:num)/edit', 'Admin\ArtistsController::edit/$1', ['as' => 'admin.artists.edit']);
  $routes->post('artists/(:num)', 'Admin\ArtistsController::update/$1', ['as' => 'admin.artists.update']);
  $routes->delete('artists/(:num)', 'Admin\ArtistsController::delete/$1', ['as' => 'admin.artists.delete']);

  // Galleries Management
  $routes->get('galleries', 'Admin\GalleriesController::index', ['as' => 'admin.galleries']);
  $routes->get('galleries/create', 'Admin\GalleriesController::create', ['as' => 'admin.galleries.create']);
  $routes->post('galleries', 'Admin\GalleriesController::store', ['as' => 'admin.galleries.store']);
  $routes->get('galleries/(:num)', 'Admin\GalleriesController::show/$1', ['as' => 'admin.galleries.show']);
  $routes->get('galleries/(:num)/edit', 'Admin\GalleriesController::edit/$1', ['as' => 'admin.galleries.edit']);
  $routes->post('galleries/(:num)', 'Admin\GalleriesController::update/$1', ['as' => 'admin.galleries.update']);
  $routes->delete('galleries/(:num)', 'Admin\GalleriesController::delete/$1', ['as' => 'admin.galleries.delete']);

  // Exhibitions Management
  $routes->get('exhibitions', 'Admin\ExhibitionsController::index', ['as' => 'admin.exhibitions']);
  $routes->get('exhibitions/create', 'Admin\ExhibitionsController::create', ['as' => 'admin.exhibitions.create']);
  $routes->post('exhibitions', 'Admin\ExhibitionsController::store', ['as' => 'admin.exhibitions.store']);
  $routes->get('exhibitions/(:num)', 'Admin\ExhibitionsController::show/$1', ['as' => 'admin.exhibitions.show']);
  $routes->get('exhibitions/(:num)/edit', 'Admin\ExhibitionsController::edit/$1', ['as' => 'admin.exhibitions.edit']);
  $routes->post('exhibitions/(:num)', 'Admin\ExhibitionsController::update/$1', ['as' => 'admin.exhibitions.update']);
  $routes->delete('exhibitions/(:num)', 'Admin\ExhibitionsController::delete/$1', ['as' => 'admin.exhibitions.delete']);

  // Events Management
  $routes->get('events', 'Admin\EventsController::index', ['as' => 'admin.events']);
  $routes->get('events/create', 'Admin\EventsController::create', ['as' => 'admin.events.create']);
  $routes->post('events', 'Admin\EventsController::store', ['as' => 'admin.events.store']);
  $routes->get('events/(:num)', 'Admin\EventsController::show/$1', ['as' => 'admin.events.show']);
  $routes->get('events/(:num)/edit', 'Admin\EventsController::edit/$1', ['as' => 'admin.events.edit']);
  $routes->post('events/(:num)', 'Admin\EventsController::update/$1', ['as' => 'admin.events.update']);
  $routes->delete('events/(:num)', 'Admin\EventsController::delete/$1', ['as' => 'admin.events.delete']);

  // Artwork Management
  $routes->get('artwork', 'Admin\ArtworkController::index', ['as' => 'admin.artwork']);
  $routes->get('artwork/create', 'Admin\ArtworkController::create', ['as' => 'admin.artwork.create']);
  $routes->post('artwork', 'Admin\ArtworkController::store', ['as' => 'admin.artwork.store']);
  $routes->get('artwork/(:num)', 'Admin\ArtworkController::show/$1', ['as' => 'admin.artwork.show']);
  $routes->get('artwork/(:num)/edit', 'Admin\ArtworkController::edit/$1', ['as' => 'admin.artwork.edit']);
  $routes->post('artwork/(:num)', 'Admin\ArtworkController::update/$1', ['as' => 'admin.artwork.update']);
  $routes->delete('artwork/(:num)', 'Admin\ArtworkController::delete/$1', ['as' => 'admin.artwork.delete']);

  // Media Management
  $routes->get('media', 'Admin\MediaController::index', ['as' => 'admin.media']);
  $routes->post('media/upload', 'Admin\MediaController::upload', ['as' => 'admin.media.upload']);
  $routes->delete('media/(:num)', 'Admin\MediaController::delete/$1', ['as' => 'admin.media.delete']);

  // Submissions Management
  $routes->get('submissions', 'Admin\SubmissionsController::index', ['as' => 'admin.submissions']);
  $routes->get('submissions/(:num)', 'Admin\SubmissionsController::show/$1', ['as' => 'admin.submissions.show']);
  $routes->post('submissions/(:num)/approve', 'Admin\SubmissionsController::approve/$1', ['as' => 'admin.submissions.approve']);
  $routes->post('submissions/(:num)/reject', 'Admin\SubmissionsController::reject/$1', ['as' => 'admin.submissions.reject']);

  // Users Management
  $routes->get('users', 'Admin\UsersController::index', ['as' => 'admin.users']);
  $routes->get('users/create', 'Admin\UsersController::create', ['as' => 'admin.users.create']);
  $routes->post('users', 'Admin\UsersController::store', ['as' => 'admin.users.store']);
  $routes->get('users/(:num)', 'Admin\UsersController::show/$1', ['as' => 'admin.users.show']);
  $routes->get('users/(:num)/edit', 'Admin\UsersController::edit/$1', ['as' => 'admin.users.edit']);
  $routes->post('users/(:num)', 'Admin\UsersController::update/$1', ['as' => 'admin.users.update']);
  $routes->delete('users/(:num)', 'Admin\UsersController::delete/$1', ['as' => 'admin.users.delete']);

  // Settings
  $routes->get('settings', 'Admin\SettingsController::index', ['as' => 'admin.settings']);
  $routes->post('settings', 'Admin\SettingsController::update', ['as' => 'admin.settings.update']);
  $routes->get('settings/(:alpha)', 'Admin\SettingsController::show/$1', ['as' => 'admin.settings.show']);

  // Analytics
  $routes->get('analytics', 'Admin\AnalyticsController::index', ['as' => 'admin.analytics']);
  $routes->get('analytics/(:alpha)', 'Admin\AnalyticsController::show/$1', ['as' => 'admin.analytics.show']);

  // Logs
  $routes->get('logs', 'Admin\LogsController::index', ['as' => 'admin.logs']);
  $routes->get('logs/(:alpha)', 'Admin\LogsController::show/$1', ['as' => 'admin.logs.show']);

  // Activity & Notifications
  $routes->get('activity', 'Admin\ActivityController::index', ['as' => 'admin.activity']);
  $routes->get('notifications', 'Admin\NotificationsController::index', ['as' => 'admin.notifications']);

  // Profile
  $routes->get('profile', 'Admin\ProfileController::index', ['as' => 'admin.profile']);
  $routes->post('profile', 'Admin\ProfileController::update', ['as' => 'admin.profile.update']);
});

