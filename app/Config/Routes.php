<?php declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;
use App\Controllers\HomeController;
use App\Controllers\LegalController;
use App\Controllers\CalendarController;
use App\Controllers\ArtistsController;
use App\Controllers\GalleriesController;

/**
 * @var RouteCollection $routes
 */

//$routes->get('/', 'Home::index'); --- IGNORE ---
$routes->get('/', [HomeController::class, 'index'], ['as' => 'home']);
$routes->get('contact', [HomeController::class, 'contact'], ['as' => 'contact']);
$routes->get('calendar', [CalendarController::class, 'index'], ['as' => 'calendar']);
$routes->get('artists', [ArtistsController::class, 'index'], ['as' => 'artists']);
$routes->get('galleries', [GalleriesController::class, 'index'], ['as' => 'galleries']);
$routes->get('art/submit', [HomeController::class, 'submitArtForm'], ['as' => 'art.submit']);
// Legal Stuff
$routes->get('terms-of-service', [LegalController::class, 'terms'], ['as' => 'terms']);
$routes->get('privacy-policy', [LegalController::class, 'privacy'], ['as' => 'privacy']);
