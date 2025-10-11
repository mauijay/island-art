<?php

if (!function_exists('formatEventDates')) {
  /**
   * Helper function to format event dates for display
   */
  function formatEventDates($event)
  {
    $startDate = date('M j', strtotime($event['start_date']));

    if (!empty($event['end_date']) && $event['end_date'] !== $event['start_date']) {
      $endDate = date('M j', strtotime($event['end_date']));
      return $startDate . ' - ' . $endDate;
    }

    return $startDate;
  }
}

if (!function_exists('getEventIsland')) {
  /**
   * Helper function to get event island based on location
   */
  function getEventIsland($event)
  {
    // Use venue_island if available (normalized database)
    if (!empty($event['venue_island'])) {
      return $event['venue_island'];
    }

    // Fallback to location parsing for legacy data
    $location = strtolower(($event['venue_city'] ?? $event['city'] ?? '') . ' ' . ($event['venue_address'] ?? $event['address'] ?? ''));

    if (strpos($location, 'honolulu') !== false || strpos($location, 'oahu') !== false) {
      return 'Oʻahu';
    } elseif (strpos($location, 'hilo') !== false || strpos($location, 'kona') !== false || strpos($location, 'volcano') !== false) {
      return 'Big Island';
    } elseif (strpos($location, 'maui') !== false || strpos($location, 'lahaina') !== false) {
      return 'Maui';
    } elseif (strpos($location, 'kauai') !== false || strpos($location, 'lihue') !== false) {
      return 'Kauai';
    }

    return 'Hawaii';
  }
}

if (!function_exists('formatEventLocation')) {
  /**
   * Helper function to format event location from venue fields
   */
  function formatEventLocation($event)
  {
    $locationParts = [];

    // Add venue name if available
    if (!empty($event['venue_name'])) {
      $locationParts[] = $event['venue_name'];
    }

    // Add city if available
    if (!empty($event['venue_city'])) {
      $locationParts[] = $event['venue_city'];
    }

    // If no venue fields, try legacy location field
    if (empty($locationParts) && !empty($event['location'])) {
      return $event['location'];
    }

    // If still no location parts, try address
    if (empty($locationParts) && !empty($event['venue_address'])) {
      $locationParts[] = $event['venue_address'];
    }

    return !empty($locationParts) ? implode(', ', $locationParts) : 'Location TBD';
  }
}
