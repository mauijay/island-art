<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController {
  
  public function index()
  {
    // Get dashboard statistics
    $stats = $this->getDashboardStats();
    $recentActivity = $this->getRecentActivity();
    $pendingSubmissions = $this->getPendingSubmissions();
    
    $data = [
      'title' => 'Admin Dashboard - Island Art',
      'pageTitle' => 'Dashboard',
      'description' => 'Island Art Admin Dashboard - Manage artists, galleries, exhibitions and more',
      'breadcrumbs' => [
        ['title' => 'Dashboard']
      ],
      'stats' => $stats,
      'recentActivity' => $recentActivity,
      'pendingSubmissions' => $pendingSubmissions,
    ];
    
    return view('admin/dashboard', $data);
  }
  
  private function getDashboardStats(): array
  {
    return [
      'total_artists' => 0, // model('ArtistModel')->countAllResults(),
      'total_galleries' => 0, // model('GalleryModel')->countAllResults(),
      'total_exhibitions' => 0, // model('ExhibitionModel')->countAllResults(),
      'total_artwork' => 0, // model('ArtworkModel')->countAllResults(),
      'pending_submissions' => 0, // model('SubmissionModel')->where('status', 'pending')->countAllResults(),
      'monthly_visitors' => 0, // Analytics data would go here
    ];
  }
  
  private function getRecentActivity(): array
  {
    // This would typically fetch from an activity log table
    return [
      [
        'type' => 'artwork_submitted',
        'description' => 'New artwork submission from John Doe',
        'time' => '2 minutes ago',
        'icon' => 'fas fa-paintbrush',
        'color' => 'text-blue-600'
      ],
      [
        'type' => 'gallery_updated',
        'description' => 'Ocean Views gallery was updated',
        'time' => '1 hour ago',
        'icon' => 'fas fa-images',
        'color' => 'text-green-600'
      ],
      [
        'type' => 'user_registered',
        'description' => 'New user registration: jane@example.com',
        'time' => '3 hours ago',
        'icon' => 'fas fa-user-plus',
        'color' => 'text-purple-600'
      ],
    ];
  }
  
  private function getPendingSubmissions(): array
  {
    // Mock data - would fetch from submissions table
    return [
      [
        'id' => 1,
        'artist_name' => 'John Doe',
        'artwork_title' => 'Sunset Over Waikiki',
        'submitted_at' => '2025-10-09 10:30:00',
        'image' => 'sunset-waikiki.jpg'
      ],
      [
        'id' => 2,
        'artist_name' => 'Jane Smith',
        'artwork_title' => 'Diamond Head Morning',
        'submitted_at' => '2025-10-09 09:15:00',
        'image' => 'diamond-head.jpg'
      ],
    ];
  }
}
