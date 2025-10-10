<?php declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CalendarController extends BaseController {
  public function index()
  {
    $data = [
      'title' => 'Events Calendar',
      'keyword' => 'Calendar, Events',
      'description' => 'This is the calendar page description.',
      'meta_description' => 'Stay updated with the latest events and exhibitions in our comprehensive events calendar. Discover art shows, gallery openings, and cultural happenings around the island.',
    ];
    return view('calendar', $data);
  }
}
