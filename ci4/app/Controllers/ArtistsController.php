<?php declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ArtistsController extends BaseController {
  public function index()
  {
    $data = [
      'title' => 'Artists - Island Art',
      'description' => 'Explore the talented artists behind Island Art. Discover their unique styles and creative journeys.',
      'keyword' => 'artists, local artists, art community, creative journeys, art styles',
      'meta_description' => 'Discover the talented artists behind Island Art. Explore their unique styles and creative journeys.',
    ];
    return view('artists', $data);
  }
}
