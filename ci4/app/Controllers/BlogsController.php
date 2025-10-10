<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BlogsController extends BaseController {
  public function index()
  {
    $data = [
      'title' => 'News and Blogs',
      'meta_description' => 'Latest news and blog posts about art, artists, galleries, and exhibitions.',
    ];
    return view('blogs/index', $data);
  }
}
