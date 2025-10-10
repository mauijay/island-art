<?php declare(strict_types=1);

namespace App\Controllers;

class HomeController extends BaseController {
  public function index(): string
  {
    $data = [
      'title' => 'Hawaiian Islands Art News',
      'keyword' => 'Art, News, Events, Hawaii, Island',
      'description' => 'Your source for the latest art news and events on the island.',
      'meta_description' => 'Stay updated with the latest art news and events happening across the Hawaiian Islands. Discover exhibitions, artist features, and cultural happenings in our vibrant art community.'
    ];
    return view('home', $data);
  }

  public function contact(): string
  {
    $data = [
      'title' => 'Contact Us - Island Art News',
      'keyword' => 'Contact Us',
      'description' => 'Get in touch with the Island Art News team.',
      'meta_description' => 'Have questions or want to submit your art? Contact the Island Art News team for inquiries, submissions, and more information about our platform.'
    ];
    return view('contact', $data);
  }

}
