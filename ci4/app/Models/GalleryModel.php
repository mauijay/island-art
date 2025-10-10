<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model {
  protected $table = 'galleries';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType = 'array';
  protected $useSoftDeletes = true;
  protected $protectFields = true;

  protected $allowedFields = [
    'user_id',
    'name',
    'slug',
    'description',
    'email',
    'phone',
    'website',
    'social_media',
    'address',
    'city',
    'state',
    'zip_code',
    'country',
    'latitude',
    'longitude',
    'opening_hours',
    'gallery_type',
    'capacity',
    'commission_rate',
    'featured_image',
    'status',
    'is_featured',
    'is_active'
  ];

  protected bool $allowEmptyInserts = false;
  protected bool $updateOnlyChanged = true;

  protected array $casts = [
    'social_media' => 'json',
    'opening_hours' => 'json',
    'latitude' => 'float',
    'longitude' => 'float',
    'capacity' => 'integer',
    'commission_rate' => 'float',
    'is_featured' => 'boolean',
    'is_active' => 'boolean'
  ];

  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [
    'name' => 'required|min_length[2]|max_length[255]',
    'slug' => 'required|alpha_dash|max_length[255]|is_unique[galleries.slug,id,{id}]',
    'email' => 'required|valid_email|max_length[255]|is_unique[galleries.email,id,{id}]',
    'phone' => 'permit_empty|max_length[20]',
    'website' => 'permit_empty|valid_url|max_length[255]',
    'description' => 'permit_empty|max_length[5000]',
    'gallery_type' => 'permit_empty|in_list[commercial,non_profit,museum,cooperative,online]',
    'capacity' => 'permit_empty|integer|greater_than[0]',
    'commission_rate' => 'permit_empty|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
    'status' => 'permit_empty|in_list[pending,approved,rejected,suspended]'
  ];

  protected $validationMessages = [
    'name' => [
      'required' => 'Gallery name is required',
      'min_length' => 'Gallery name must be at least 2 characters long',
      'max_length' => 'Gallery name cannot exceed 255 characters'
    ],
    'slug' => [
      'required' => 'Gallery slug is required',
      'alpha_dash' => 'Gallery slug can only contain letters, numbers, dashes, and underscores',
      'is_unique' => 'This gallery slug is already taken'
    ],
    'email' => [
      'required' => 'Email address is required',
      'valid_email' => 'Please provide a valid email address',
      'is_unique' => 'This email address is already registered'
    ]
  ];

  protected $skipValidation = false;
  protected $cleanValidationRules = true;
  protected $allowCallbacks = true;

  protected $beforeInsert = ['generateSlug'];
  protected $beforeUpdate = ['generateSlug'];

  // Relationships
  public function user()
  {
    return $this->belongsTo(UserModel::class, 'user_id');
  }

  public function exhibitions()
  {
    return $this->hasMany(ExhibitionModel::class, 'gallery_id');
  }

  public function events()
  {
    return $this->hasMany(EventModel::class, 'gallery_id');
  }

  public function artworks()
  {
    return $this->hasMany(ArtworkModel::class, 'gallery_id');
  }

  public function images()
  {
    return $this->hasMany(ImageModel::class, 'gallery_id');
  }

  // Custom methods
  public function getFeaturedGalleries(int $limit = 10): array
  {
    return $this->where('is_featured', 1)
      ->where('is_active', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC')
      ->findAll($limit);
  }

  public function getActiveGalleries(int $limit = null): array
  {
    $query = $this->where('is_active', 1)
      ->where('status', 'approved')
      ->orderBy('name', 'ASC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function searchGalleries(string $search, int $limit = 20): array
  {
    return $this->groupStart()
      ->like('name', $search)
      ->orLike('description', $search)
      ->orLike('city', $search)
      ->orLike('state', $search)
      ->groupEnd()
      ->where('is_active', 1)
      ->where('status', 'approved')
      ->orderBy('name', 'ASC')
      ->findAll($limit);
  }

  public function getGalleriesByType(string $type, int $limit = null): array
  {
    $query = $this->where('gallery_type', $type)
      ->where('is_active', 1)
      ->where('status', 'approved')
      ->orderBy('name', 'ASC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function getGalleriesByLocation(string $city = null, string $state = null, int $limit = null): array
  {
    $query = $this->where('is_active', 1)
      ->where('status', 'approved');

    if ($city) {
      $query->where('city', $city);
    }

    if ($state) {
      $query->where('state', $state);
    }

    $query->orderBy('name', 'ASC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function getGalleryWithStats(int $galleryId): ?array
  {
    $gallery = $this->find($galleryId);
    if (!$gallery) {
      return null;
    }

    // Add statistics
    $exhibitionModel = new ExhibitionModel();
    $eventModel      = new EventModel();
    $artworkModel    = new ArtworkModel();

    $gallery['exhibition_count'] = $exhibitionModel->where('gallery_id', $galleryId)->countAllResults();
    $gallery['event_count']      = $eventModel->where('gallery_id', $galleryId)->countAllResults();
    $gallery['artwork_count']    = $artworkModel->where('gallery_id', $galleryId)->countAllResults();

    return $gallery;
  }

  protected function generateSlug(array $data): array
  {
    if (isset($data['data']['name']) && !isset($data['data']['slug'])) {
      $data['data']['slug'] = url_title($data['data']['name'], '-', true);
    } elseif (isset($data['data']['name']) && isset($data['data']['slug'])) {
      // Ensure slug is properly formatted
      $data['data']['slug'] = url_title($data['data']['slug'], '-', true);
    }

    return $data;
  }

  // Validation callback
  public function validateOpeningHours(?string $openingHoursJson): bool
  {
    if (empty($openingHoursJson)) {
      return true;
    }

    $openingHours = json_decode($openingHoursJson, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      return false;
    }

    // Validate structure
    $allowedDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    foreach ($openingHours as $day => $hours) {
      if (!in_array($day, $allowedDays)) {
        return false;
      }

      if (isset($hours['open']) && isset($hours['close'])) {
        // Validate time format (HH:MM)
        if (
          !preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $hours['open']) ||
          !preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $hours['close'])
        ) {
          return false;
        }
      }
    }

    return true;
  }

  public function validateSocialMedia(?string $socialMediaJson): bool
  {
    if (empty($socialMediaJson)) {
      return true;
    }

    $socialMedia = json_decode($socialMediaJson, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      return false;
    }

    // Validate URLs if provided
    $allowedPlatforms = ['facebook', 'instagram', 'twitter', 'linkedin', 'tiktok', 'youtube', 'website'];
    foreach ($socialMedia as $platform => $url) {
      if (!in_array($platform, $allowedPlatforms)) {
        return false;
      }
      if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
      }
    }

    return true;
  }
}
