<?php declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GalleriesController extends BaseController
{
    public function index()
    {
        $data = [
          'title' => 'Galleries - Island Art',
          'description' => 'Discover the vibrant art galleries featured on Island Art. Explore exhibitions, events, and the creative spaces that showcase local talent.',
          'keywords' => 'art galleries, exhibitions, local art, creative spaces, art events',
          'meta_description' => 'Explore the vibrant art galleries featured on Island Art. Discover exhibitions, events, and creative spaces showcasing local talent.',
        ];
        return view('galleries', $data);
    }
}
