<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtistModel extends Model {
  protected $table = 'artists';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType = 'array';
  protected $useSoftDeletes = true;
  protected $protectFields = true;

  protected $allowedFields = [
    'user_id',
    'first_name',
    'last_name',
    'artist_name',
    'email',
    'phone',
    'website',
    'social_media',
    'biography',
    'artist_statement',
    'style',
    'medium',
    'experience_years',
    'location',
    'address',
    'city',
    'state',
    'zip_code',
    'country',
    'profile_image',
    'commission_rate',
    'status',
    'is_featured',
    'is_active'
  ];

  protected bool $allowEmptyInserts = false;
  protected bool $updateOnlyChanged = true;

  protected array $casts = [
    'social_media' => 'json',
    'experience_years' => 'integer',
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
    'first_name' => 'required|min_length[2]|max_length[100]',
    'last_name' => 'required|min_length[2]|max_length[100]',
    'email' => 'required|valid_email|max_length[255]|is_unique[artists.email,id,{id}]',
    'phone' => 'permit_empty|max_length[20]',
    'website' => 'permit_empty|valid_url|max_length[255]',
    'biography' => 'permit_empty|max_length[5000]',
    'artist_statement' => 'permit_empty|max_length[5000]',
    'style' => 'permit_empty|max_length[100]',
    'medium' => 'permit_empty|max_length[100]',
    'experience_years' => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
    'commission_rate' => 'permit_empty|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
    'status' => 'permit_empty|in_list[pending,approved,rejected,suspended]'
  ];

  protected $validationMessages = [
    'first_name' => [
      'required' => 'First name is required',
      'min_length' => 'First name must be at least 2 characters long',
      'max_length' => 'First name cannot exceed 100 characters'
    ],
    'last_name' => [
      'required' => 'Last name is required',
      'min_length' => 'Last name must be at least 2 characters long',
      'max_length' => 'Last name cannot exceed 100 characters'
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
  protected $beforeInsert = ['hashPassword'];
  protected $beforeUpdate = ['hashPassword'];

  // Relationships
  public function user()
  {
    return $this->belongsTo(UserModel::class, 'user_id');
  }

  public function artworks()
  {
    return $this->hasMany(ArtworkModel::class, 'artist_id');
  }

  public function images()
  {
    return $this->hasMany(ImageModel::class, 'artist_id');
  }

  // Custom methods
  public function getFullName(array $artist): string
  {
    return trim($artist['first_name'] . ' ' . $artist['last_name']);
  }

  public function getDisplayName(array $artist): string
  {
    return !empty($artist['artist_name']) ? $artist['artist_name'] : $this->getFullName($artist);
  }

  public function getFeaturedArtists(int $limit = 10): array
  {
    return $this->where('is_featured', 1)
      ->where('is_active', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC')
      ->findAll($limit);
  }

  public function getActiveArtists(int $limit = null): array
  {
    $query = $this->where('is_active', 1)
      ->where('status', 'approved')
      ->orderBy('last_name', 'ASC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function searchArtists(string $search, int $limit = 20): array
  {
    return $this->groupStart()
      ->like('first_name', $search)
      ->orLike('last_name', $search)
      ->orLike('artist_name', $search)
      ->orLike('email', $search)
      ->groupEnd()
      ->where('is_active', 1)
      ->orderBy('last_name', 'ASC')
      ->findAll($limit);
  }

  public function getArtistWithStats(int $artistId): ?array
  {
    $artist = $this->find($artistId);
    if (!$artist) {
      return null;
    }

    // Add artwork count
    $artworkModel            = new ArtworkModel();
    $artist['artwork_count'] = $artworkModel->where('artist_id', $artistId)->countAllResults();

    // Add sold artwork count
    $artist['sold_count'] = $artworkModel->where('artist_id', $artistId)
      ->where('is_sold', 1)
      ->countAllResults();

    return $artist;
  }

  protected function hashPassword(array $data): array
  {
    // This method is called before insert/update but artists don't store passwords
    // Password handling is done in the UserModel
    return $data;
  }

  // Validation callback
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
