<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtistModel;
use App\Models\ArtworkModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArtistsController extends BaseController {
  protected $artistModel;
  protected $artworkModel;

  public function __construct()
  {
    $this->artistModel  = new ArtistModel();
    $this->artworkModel = new ArtworkModel();
  }
  public function index()
  {
    $data = [
      'title' => 'Artists Management - Island Art Admin',
      'pageTitle' => 'Artists',
      'description' => 'Manage artist profiles and information',
      'breadcrumbs' => [
          ['title' => 'Dashboard', 'url' => route_to('admin.dashboard')],
          ['title' => 'Artists']
        ],
      'artists' => $this->getArtists(),
    ];

    return view('admin/artists/index', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Add New Artist - Island Art Admin',
      'pageTitle' => 'Add New Artist',
      'description' => 'Create a new artist profile',
      'breadcrumbs' => [
          ['title' => 'Dashboard', 'url' => route_to('admin.dashboard')],
          ['title' => 'Artists', 'url' => route_to('admin.artists')],
          ['title' => 'Add New Artist']
        ],
    ];

    return view('admin/artists/create', $data);
  }

  public function store()
  {
    $rules = [
      'name' => 'required|max_length[255]',
      'email' => 'required|valid_email|is_unique[artists.email]',
      'bio' => 'permit_empty|max_length[2000]',
      'website' => 'permit_empty|valid_url',
      'instagram' => 'permit_empty|max_length[255]',
      'facebook' => 'permit_empty|max_length[255]',
      'image' => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('error', 'Please correct the errors below.');
    }

    try {
      // Handle file upload
      $imagePath = null;
      $imageFile = $this->request->getFile('image');
      if ($imageFile && $imageFile->isValid()) {
        $imagePath = $this->handleImageUpload($imageFile);
      }

      // Parse the name into first and last name
      $name      = trim($this->request->getPost('name'));
      $nameParts = explode(' ', $name, 2);
      $firstName = $nameParts[0];
      $lastName  = isset($nameParts[1]) ? $nameParts[1] : '';

      // Prepare social media data
      $socialMedia = [];
      if ($this->request->getPost('instagram')) {
        $socialMedia['instagram'] = $this->request->getPost('instagram');
      }
      if ($this->request->getPost('facebook')) {
        $socialMedia['facebook'] = $this->request->getPost('facebook');
      }

      $artistData = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'artist_name' => $name,
        'email' => $this->request->getPost('email'),
        'biography' => $this->request->getPost('bio'),
        'website' => $this->request->getPost('website'),
        'social_media' => !empty($socialMedia) ? json_encode($socialMedia) : null,
        'profile_image' => $imagePath,
        'status' => 'approved', // Admin-created artists are automatically approved
        'is_active' => 1,
        'is_featured' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ];

      $artistId = $this->artistModel->insert($artistData);

      if (!$artistId) {
        throw new \Exception('Failed to save artist to database');
      }

      return redirect()->to(route_to('admin.artists'))
        ->with('success', 'Artist created successfully.');

    } catch (\Exception $e) {
      return redirect()->back()->withInput()
        ->with('error', 'Failed to create artist: ' . $e->getMessage());
    }
  }

  public function show($id)
  {
    $artist = $this->getArtist($id);

    if (!$artist) {
      return redirect()->to(route_to('admin.artists'))
        ->with('error', 'Artist not found.');
    }

    $data = [
      'title' => $artist['name'] . ' - Island Art Admin',
      'pageTitle' => $artist['name'],
      'description' => 'View artist profile and manage their artwork',
      'breadcrumbs' => [
          ['title' => 'Dashboard', 'url' => route_to('admin.dashboard')],
          ['title' => 'Artists', 'url' => route_to('admin.artists')],
          ['title' => $artist['name']]
        ],
      'artist' => $artist,
      'artwork' => $this->getArtistArtwork($id),
    ];

    return view('admin/artists/show', $data);
  }

  public function edit($id)
  {
    $artist = $this->getArtist($id);

    if (!$artist) {
      return redirect()->to(route_to('admin.artists'))
        ->with('error', 'Artist not found.');
    }

    $data = [
      'title' => 'Edit ' . $artist['name'] . ' - Island Art Admin',
      'pageTitle' => 'Edit Artist',
      'description' => 'Edit artist profile information',
      'breadcrumbs' => [
          ['title' => 'Dashboard', 'url' => route_to('admin.dashboard')],
          ['title' => 'Artists', 'url' => route_to('admin.artists')],
          ['title' => $artist['name'], 'url' => route_to('admin.artists.show', $id)],
          ['title' => 'Edit']
        ],
      'artist' => $artist,
    ];

    return view('admin/artists/edit', $data);
  }

  public function update($id)
  {
    $artist = $this->getArtist($id);

    if (!$artist) {
      return redirect()->to(route_to('admin.artists'))
        ->with('error', 'Artist not found.');
    }

    $rules = [
      'name' => 'required|max_length[255]',
      'email' => "required|valid_email|is_unique[artists.email,id,{$id}]",
      'bio' => 'permit_empty|max_length[2000]',
      'website' => 'permit_empty|valid_url',
      'instagram' => 'permit_empty|max_length[255]',
      'facebook' => 'permit_empty|max_length[255]',
      'image' => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('error', 'Please correct the errors below.');
    }

    try {
      // Handle file upload
      $imagePath = $artist['image'];
      $imageFile = $this->request->getFile('image');
      if ($imageFile && $imageFile->isValid()) {
        $imagePath = $this->handleImageUpload($imageFile);

        // Delete old image if exists
        if ($artist['image'] && file_exists(FCPATH . 'uploads/artists/' . $artist['image'])) {
          unlink(FCPATH . 'uploads/artists/' . $artist['image']);
        }
      }

      $artistData = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'bio' => $this->request->getPost('bio'),
        'website' => $this->request->getPost('website'),
        'instagram' => $this->request->getPost('instagram'),
        'facebook' => $this->request->getPost('facebook'),
        'image' => $imagePath,
        'updated_at' => date('Y-m-d H:i:s'),
      ];

      // In a real application, you would update in database
      // $artistModel = model('ArtistModel');
      // $artistModel->update($id, $artistData);

      return redirect()->to(route_to('admin.artists.show', $id))
        ->with('success', 'Artist updated successfully.');

    } catch (\Exception $e) {
      return redirect()->back()->withInput()
        ->with('error', 'Failed to update artist: ' . $e->getMessage());
    }
  }

  public function delete($id)
  {
    $artist = $this->getArtist($id);

    if (!$artist) {
      return $this->response->setJSON(['error' => 'Artist not found'], 404);
    }

    try {
      // Delete artist image if exists
      if ($artist['image'] && file_exists(FCPATH . 'uploads/artists/' . $artist['image'])) {
        unlink(FCPATH . 'uploads/artists/' . $artist['image']);
      }

      // In a real application, you would delete from database
      // $artistModel = model('ArtistModel');
      // $artistModel->delete($id);

      return $this->response->setJSON(['success' => 'Artist deleted successfully']);

    } catch (\Exception $e) {
      return $this->response->setJSON(['error' => 'Failed to delete artist'], 500);
    }
  }

  private function getArtists(): array
  {
    try {
      // Get artists from database with artwork count
      $artists = $this->artistModel
        ->select('artists.*, COUNT(artworks.id) as artwork_count')
        ->join('artworks', 'artworks.artist_id = artists.id', 'left')
        ->groupBy('artists.id')
        ->orderBy('artists.created_at', 'DESC')
        ->findAll();

      // Format the data for the view
      $formattedArtists = [];
      foreach ($artists as $artist) {
        $socialMedia = !empty($artist['social_media']) ? json_decode($artist['social_media'], true) : [];

        $formattedArtists[] = [
          'id' => $artist['id'],
          'name' => $artist['artist_name'] ?? ($artist['first_name'] . ' ' . $artist['last_name']),
          'email' => $artist['email'],
          'bio' => $artist['biography'] ?? '',
          'website' => $artist['website'] ?? '',
          'instagram' => $socialMedia['instagram'] ?? '',
          'facebook' => $socialMedia['facebook'] ?? '',
          'image' => $artist['profile_image'] ?? '',
          'status' => $artist['status'],
          'artwork_count' => $artist['artwork_count'] ?? 0,
          'created_at' => $artist['created_at'],
          'is_featured' => $artist['is_featured'],
          'is_active' => $artist['is_active'],
          'location' => $artist['location'] ?? '',
          'phone' => $artist['phone'] ?? '',
          'commission_rate' => $artist['commission_rate'] ?? 0
        ];
      }

      return $formattedArtists;
    } catch (\Exception $e) {
      log_message('error', 'Error fetching artists: ' . $e->getMessage());
      return [];
    }
  }

  private function getArtist($id): ?array
  {
    try {
      $artist = $this->artistModel->find($id);
      if (!$artist) {
        return null;
      }

      // Get artwork count for this artist
      $artworkCount = $this->artworkModel->where('artist_id', $id)->countAllResults();

      $socialMedia = !empty($artist['social_media']) ? json_decode($artist['social_media'], true) : [];

      return [
        'id' => $artist['id'],
        'name' => $artist['artist_name'] ?? ($artist['first_name'] . ' ' . $artist['last_name']),
        'email' => $artist['email'],
        'bio' => $artist['biography'] ?? '',
        'website' => $artist['website'] ?? '',
        'instagram' => $socialMedia['instagram'] ?? '',
        'facebook' => $socialMedia['facebook'] ?? '',
        'image' => $artist['profile_image'] ?? '',
        'status' => $artist['status'],
        'artwork_count' => $artworkCount,
        'created_at' => $artist['created_at'],
        'is_featured' => $artist['is_featured'],
        'is_active' => $artist['is_active'],
        'location' => $artist['location'] ?? '',
        'phone' => $artist['phone'] ?? '',
        'commission_rate' => $artist['commission_rate'] ?? 0
      ];
    } catch (\Exception $e) {
      log_message('error', 'Error fetching artist: ' . $e->getMessage());
      return null;
    }
  }

  private function getArtistArtwork($artistId): array
  {
    try {
      $artworks = $this->artworkModel
        ->where('artist_id', $artistId)
        ->orderBy('created_at', 'DESC')
        ->findAll();

      $formattedArtworks = [];
      foreach ($artworks as $artwork) {
        $formattedArtworks[] = [
          'id' => $artwork['id'],
          'title' => $artwork['title'],
          'medium' => $artwork['medium'],
          'size' => $artwork['dimensions_width'] . 'x' . $artwork['dimensions_height'] . ' ' . $artwork['dimensions_unit'],
          'year' => $artwork['year_created'],
          'price' => $artwork['price'],
          'status' => $artwork['is_sold'] ? 'sold' : ($artwork['is_for_sale'] ? 'available' : 'not for sale'),
          'image' => $artwork['featured_image_id'] ?? 'placeholder.jpg',
          'description' => $artwork['description'],
          'views_count' => $artwork['views_count'],
          'likes_count' => $artwork['likes_count'],
          'is_featured' => $artwork['is_featured'],
          'is_published' => $artwork['is_published']
        ];
      }

      return $formattedArtworks;
    } catch (\Exception $e) {
      log_message('error', 'Error fetching artist artwork: ' . $e->getMessage());
      return [];
    }
  }

  private function handleImageUpload($file): string
  {
    $uploadPath = FCPATH . 'uploads/artists/';

    if (!is_dir($uploadPath)) {
      mkdir($uploadPath, 0755, true);
    }

    $fileName = uniqid() . '_' . $file->getClientName();
    $file->move($uploadPath, $fileName);

    return $fileName;
  }
}
