<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LegalController extends BaseController {
  public function index()
  {
    // --- IGNORE ---
  }

  public function terms(): ResponseInterface|string
  {
    $data = [
      'title' => 'Terms of Service',
      'description' => 'This is the terms of service page description.'
    ];
    return view('legal/terms', $data);
  }

  public function privacy(): ResponseInterface|string
  {
    $data = [
      'title' => 'Privacy Policy',
      'description' => 'This is the privacy policy page description.'
    ];
    return view('legal/privacy', $data);
  }
}
