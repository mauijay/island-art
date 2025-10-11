<?php declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventModel;
use CodeIgniter\HTTP\ResponseInterface;

class EventsController extends BaseController {

  protected $eventModel;

  public function __construct()
  {
    $this->eventModel = new EventModel();
    helper('event'); // Load the event helper
  }

  public function index()
  {
    // Get current and upcoming events
    $currentDate = date('Y-m-d');

    // Featured events for the hero section
    $featuredEvents = $this->eventModel
      ->where('is_featured', 1)
      ->where('status', 'published')
      ->where('start_date >=', $currentDate)
      ->orderBy('start_date', 'ASC')
      ->limit(3)
      ->findAll();

    // Events by island
    $oahuEvents      = $this->getEventsByIsland('Oahu');
    $bigIslandEvents = $this->getEventsByIsland('Big Island');
    $mauiEvents      = $this->getEventsByIsland('Maui');
    $kauaiEvents     = $this->getEventsByIsland('Kauai');

    // Get current month name for the header
    $currentMonth = date('F Y');

    $data = [
      'title' => 'Events Calendar',
      'keyword' => 'Events, Calendar, Art Shows, Exhibitions',
      'description' => 'Discover upcoming art events, exhibitions, and cultural happenings across the Hawaiian islands.',
      'meta_description' => 'Stay updated with the latest art events and exhibitions across Hawaii. Discover gallery openings, art shows, workshops, and cultural happenings on Oahu, Maui, Big Island, and Kauai.',
      'featuredEvents' => $featuredEvents,
      'oahuEvents' => $oahuEvents,
      'bigIslandEvents' => $bigIslandEvents,
      'mauiEvents' => $mauiEvents,
      'kauaiEvents' => $kauaiEvents,
      'currentMonth' => $currentMonth,
      'lastUpdated' => $this->getLastUpdateTime()
    ];

    return view('calendar_dynamic', $data);
  }

  /**
   * Show individual event details
   */
  public function show($slug = null)
  {
    if (!$slug) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $event = $this->eventModel
      ->where('slug', $slug)
      ->where('status', 'published')
      ->first();

    if (!$event) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $data = [
      'title' => $event['title'] . ' - Event Details',
      'keyword' => 'Event, ' . $event['title'] . ', Hawaiian Art',
      'description' => 'Event details for ' . $event['title'],
      'meta_description' => substr($event['description'] ?? $event['title'], 0, 160),
      'event' => $event
    ];

    return view('event_detail', $data);
  }

  /**
   * Calendar view for events
   */
  public function calendar()
  {
    $data = [
      'title' => 'Events Calendar',
      'keyword' => 'Calendar, Events, Art Shows, Exhibitions',
      'description' => 'Interactive calendar view of upcoming art events and exhibitions.',
      'meta_description' => 'Browse upcoming art events and exhibitions in an interactive calendar format. Find events by date, location, and type across the Hawaiian islands.',
    ];

    return view('calendar', $data);
  }

  /**
   * Get events by island
   */
  private function getEventsByIsland(string $island, int $limit = 10): array
  {
    $currentDate = date('Y-m-d');

    return $this->eventModel
      ->where('status', 'published')
      ->where('start_date >=', $currentDate)
      ->where('venue_island', $island)
      ->orderBy('start_date', 'ASC')
      ->limit($limit)
      ->findAll();
  }

  /**
   * Get the last time events were updated
   */
  private function getLastUpdateTime(): string
  {
    $lastEvent = $this->eventModel
      ->orderBy('updated_at', 'DESC')
      ->first();

    if ($lastEvent) {
      return date('F j, Y', strtotime($lastEvent['updated_at']));
    }

    return date('F j, Y');
  }

  /**
   * API endpoint to get events as JSON
   */
  public function apiEvents()
  {
    $island      = $this->request->getGet('island');
    $limit       = (int) ($this->request->getGet('limit') ?? 20);
    $offset      = (int) ($this->request->getGet('offset') ?? 0);
    $currentDate = date('Y-m-d');

    $query = $this->eventModel
      ->where('status', 'published')
      ->where('start_date >=', $currentDate);

    if ($island) {
      $query->where('venue_island', $island);
    }

    $events = $query->orderBy('start_date', 'ASC')
      ->limit($limit, $offset)
      ->findAll();

    return $this->response->setJSON([
      'success' => true,
      'events' => $events,
      'count' => count($events)
    ]);
  }

  /**
   * Get events for a specific date range (for calendar widget)
   */
  public function apiCalendar()
  {
    $start = $this->request->getGet('start');
    $end   = $this->request->getGet('end');

    if (!$start || !$end) {
      return $this->response->setJSON([
        'error' => 'Start and end dates are required'
      ])->setStatusCode(400);
    }

    $events = $this->eventModel
      ->where('status', 'published')
      ->where('start_date >=', $start)
      ->where('start_date <=', $end)
      ->orderBy('start_date', 'ASC')
      ->findAll();

    // Format events for calendar display
    $calendarEvents = [];
    foreach ($events as $event) {
      $calendarEvents[] = [
        'id' => $event['id'],
        'title' => $event['title'],
        'start' => $event['start_date'],
        'end' => $event['end_date'] ?? $event['start_date'],
        'url' => base_url('events/' . $event['slug']),
        'backgroundColor' => $event['is_featured'] ? '#ff6b35' : '#007bff',
        'borderColor' => $event['is_featured'] ? '#ff6b35' : '#007bff'
      ];
    }

    return $this->response->setJSON($calendarEvents);
  }
}
