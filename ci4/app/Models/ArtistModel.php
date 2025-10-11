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
    'artist_name',
    'social_media',
    'biography',
    'artist_statement',
    'style',
    'medium',
    'experience_years',
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
    'user_id' => 'required|integer|is_not_unique[users.id]',
    'artist_name' => 'permit_empty|max_length[255]',
    'biography' => 'permit_empty|max_length[5000]',
    'artist_statement' => 'permit_empty|max_length[5000]',
    'style' => 'permit_empty|max_length[100]',
    'medium' => 'permit_empty|max_length[100]',
    'experience_years' => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
    'commission_rate' => 'permit_empty|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
    'status' => 'permit_empty|in_list[pending,approved,rejected,suspended]'
  ];

  protected $validationMessages = [
    'user_id' => [
      'required' => 'User ID is required',
      'integer' => 'User ID must be a valid integer',
      'is_not_unique' => 'User must exist in the system'
    ],
    'artist_name' => [
      'max_length' => 'Artist name cannot exceed 255 characters'
    ],
    'commission_rate' => [
      'decimal' => 'Commission rate must be a valid decimal',
      'greater_than_equal_to' => 'Commission rate cannot be negative',
      'less_than_equal_to' => 'Commission rate cannot exceed 100%'
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
