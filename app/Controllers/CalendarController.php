<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CalendarController extends BaseController {
  public function index()
  {
    $data = [
      'title' => 'Events Calendar',
      'description' => 'This is the calendar page description.'
    ];
    return view('calendar', $data);
  }
}
