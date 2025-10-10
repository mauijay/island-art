<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtworkModel extends Model {
  protected $table = 'artworks';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType = 'array';
  protected $useSoftDeletes = true;
  protected $protectFields = true;

  protected $allowedFields = [
    'artist_id',
    'gallery_id',
    'exhibition_id',
    'title',
    'slug',
    'description',
    'medium',
    'style',
    'category',
    'subject_matter',
    'dimensions_height',
    'dimensions_width',
    'dimensions_depth',
    'dimensions_unit',
    'weight',
    'weight_unit',
    'year_created',
    'price',
    'currency',
    'is_for_sale',
    'is_sold',
    'sale_date',
    'edition_number',
    'certificate_authenticity',
    'provenance',
    'condition_report',
    'condition_rating',
    'tags',
    'keywords',
    'location',
    'insurance_value',
    'status',
    'is_featured',
    'is_published',
    'views_count',
    'likes_count',
    'featured_image_id',
    'meta_title',
    'meta_description'
  ];

  protected bool $allowEmptyInserts = false;
  protected bool $updateOnlyChanged = true;

  protected array $casts = [
    'artist_id' => 'integer',
    'gallery_id' => 'integer',
    'exhibition_id' => 'integer',
    'dimensions_height' => 'float',
    'dimensions_width' => 'float',
    'dimensions_depth' => 'float',
    'weight' => 'float',
    'year_created' => 'integer',
    'price' => 'float',
    'is_for_sale' => 'boolean',
    'is_sold' => 'boolean',
    'insurance_value' => 'float',
    'is_featured' => 'boolean',
    'is_published' => 'boolean',
    'views_count' => 'integer',
    'likes_count' => 'integer',
    'featured_image_id' => 'integer',
    'tags' => 'json'
  ];

  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [
    'artist_id' => 'required|integer|is_not_unique[artists.id]',
    'title' => 'required|min_length[2]|max_length[255]',
    'slug' => 'required|alpha_dash|max_length[255]|is_unique[artworks.slug,id,{id}]',
    'description' => 'permit_empty|max_length[5000]',
    'medium' => 'permit_empty|max_length[100]',
    'style' => 'permit_empty|max_length[100]',
    'category' => 'permit_empty|in_list[painting,sculpture,photography,digital,mixed_media,drawing,printmaking,textile,ceramics,jewelry,other]',
    'dimensions_height' => 'permit_empty|decimal|greater_than[0]',
    'dimensions_width' => 'permit_empty|decimal|greater_than[0]',
    'dimensions_depth' => 'permit_empty|decimal|greater_than[0]',
    'dimensions_unit' => 'permit_empty|in_list[inches,cm,feet,meters]',
    'weight' => 'permit_empty|decimal|greater_than[0]',
    'weight_unit' => 'permit_empty|in_list[lbs,kg,oz,grams]',
    'year_created' => 'permit_empty|integer|greater_than[1800]|less_than_equal_to[' . date('Y') . ']',
    'price' => 'permit_empty|decimal|greater_than_equal_to[0]',
    'currency' => 'permit_empty|max_length[3]',
    'condition_rating' => 'permit_empty|in_list[excellent,very_good,good,fair,poor]',
    'status' => 'permit_empty|in_list[draft,pending,approved,rejected,archived]'
  ];

  protected $validationMessages = [
    'artist_id' => [
      'required' => 'Artist is required',
      'is_not_unique' => 'Selected artist does not exist'
    ],
    'title' => [
      'required' => 'Artwork title is required',
      'min_length' => 'Title must be at least 2 characters long',
      'max_length' => 'Title cannot exceed 255 characters'
    ],
    'slug' => [
      'required' => 'Artwork slug is required',
      'alpha_dash' => 'Slug can only contain letters, numbers, dashes, and underscores',
      'is_unique' => 'This artwork slug is already taken'
    ]
  ];

  protected $skipValidation = false;
  protected $cleanValidationRules = true;
  protected $allowCallbacks = true;

  protected $beforeInsert = ['generateSlug', 'setDefaults'];
  protected $beforeUpdate = ['generateSlug'];

  // Relationships
  public function artist()
  {
    return $this->belongsTo(ArtistModel::class, 'artist_id');
  }

  public function gallery()
  {
    return $this->belongsTo(GalleryModel::class, 'gallery_id');
  }

  public function exhibition()
  {
    return $this->belongsTo(ExhibitionModel::class, 'exhibition_id');
  }

  public function images()
  {
    return $this->hasMany(ImageModel::class, 'artwork_id');
  }

  public function featuredImage()
  {
    return $this->belongsTo(ImageModel::class, 'featured_image_id');
  }

  // Custom methods
  public function getFeaturedArtworks(int $limit = 10): array
  {
    return $this->where('is_featured', 1)
      ->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC')
      ->findAll($limit);
  }

  public function getPublishedArtworks(int $limit = null): array
  {
    $query = $this->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function getArtworksByArtist(int $artistId, int $limit = null): array
  {
    $query = $this->where('artist_id', $artistId)
      ->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function getArtworksByGallery(int $galleryId, int $limit = null): array
  {
    $query = $this->where('gallery_id', $galleryId)
      ->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function getArtworksByCategory(string $category, int $limit = null): array
  {
    $query = $this->where('category', $category)
      ->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function getArtworksForSale(int $limit = null): array
  {
    $query = $this->where('is_for_sale', 1)
      ->where('is_sold', 0)
      ->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC');

    return $limit ? $query->findAll($limit) : $query->findAll();
  }

  public function searchArtworks(string $search, int $limit = 20): array
  {
    return $this->groupStart()
      ->like('title', $search)
      ->orLike('description', $search)
      ->orLike('medium', $search)
      ->orLike('style', $search)
      ->orLike('keywords', $search)
      ->groupEnd()
      ->where('is_published', 1)
      ->where('status', 'approved')
      ->orderBy('created_at', 'DESC')
      ->findAll($limit);
  }

  public function getArtworkWithDetails(int $artworkId): ?array
  {
    $artwork = $this->find($artworkId);
    if (!$artwork) {
      return null;
    }

    // Load related data
    $artistModel  = new ArtistModel();
    $galleryModel = new GalleryModel();
    $imageModel   = new ImageModel();

    $artwork['artist'] = $artistModel->find($artwork['artist_id']);

    if ($artwork['gallery_id']) {
      $artwork['gallery'] = $galleryModel->find($artwork['gallery_id']);
    }

    // Get all images for this artwork
    $artwork['images'] = $imageModel->where('artwork_id', $artworkId)
      ->orderBy('image_order', 'ASC')
      ->findAll();

    return $artwork;
  }

  public function incrementViews(int $artworkId): bool
  {
    return $this->where('id', $artworkId)
      ->set('views_count', 'views_count + 1', false)
      ->update();
  }

  public function incrementLikes(int $artworkId): bool
  {
    return $this->where('id', $artworkId)
      ->set('likes_count', 'likes_count + 1', false)
      ->update();
  }

  public function markAsSold(int $artworkId, string $saleDate = null): bool
  {
    $data = [
      'is_sold' => 1,
      'sale_date' => $saleDate ?: date('Y-m-d H:i:s')
    ];

    return $this->update($artworkId, $data);
  }

  protected function generateSlug(array $data): array
  {
    if (isset($data['data']['title']) && !isset($data['data']['slug'])) {
      $data['data']['slug'] = url_title($data['data']['title'], '-', true);
    } elseif (isset($data['data']['title']) && isset($data['data']['slug'])) {
      // Ensure slug is properly formatted
      $data['data']['slug'] = url_title($data['data']['slug'], '-', true);
    }

    return $data;
  }

  protected function setDefaults(array $data): array
  {
    if (!isset($data['data']['currency'])) {
      $data['data']['currency'] = 'USD';
    }

    if (!isset($data['data']['dimensions_unit'])) {
      $data['data']['dimensions_unit'] = 'inches';
    }

    if (!isset($data['data']['weight_unit'])) {
      $data['data']['weight_unit'] = 'lbs';
    }

    return $data;
  }

  // Validation callback
  public function validateTags(?string $tagsJson): bool
  {
    if (empty($tagsJson)) {
      return true;
    }

    $tags = json_decode($tagsJson, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      return false;
    }

    // Validate tags are strings and not too long
    foreach ($tags as $tag) {
      if (!is_string($tag) || strlen($tag) > 50) {
        return false;
      }
    }

    return true;
  }
}
