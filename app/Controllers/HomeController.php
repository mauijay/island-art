<?php

namespace App\Controllers;

class HomeController extends BaseController {
  public function index(): string
  {
    $data = [
      'title' => 'Welcome to Island Art News',
      'description' => 'Your source for the latest art news and events on the island.'
    ];
    return view('home', $data);
  }

  public function contact(): string
  {
    $data = [
      'title' => 'Contact Us - Island Art News',
      'description' => 'Get in touch with the Island Art News team.'
    ];
    return view('contact', $data);
  }
  public function submitArtForm(): string
  {
    // Handle form submission logic here (e.g., save to database, send email, etc.)
    // For now, we'll just return a simple confirmation message.
    return 'Art submission received! Thank you for contributing to Island Art News.';
  }
}
