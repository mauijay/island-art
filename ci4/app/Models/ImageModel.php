<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model {
  protected $table = 'images';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType = 'array';
  protected $useSoftDeletes = true;
  protected $protectFields = true;

  protected $allowedFields = [
    'user_id',
    'thread_id',
    'post_id',
    'artwork_id',
    'artist_id',
    'gallery_id',
    'exhibition_id',
    'name',
    'original_name',
    'file_path',
    'file_type',
    'mime_type',
    'size',
    'width',
    'height',
    'thumbnail_path',
    'alt_text',
    'caption',
    'image_order',
    'is_primary',
    'is_watermarked',
    'image_type',
    'is_used',
    'ip_address'
  ];

  protected array $casts = [
    'user_id' => 'integer',
    'thread_id' => 'integer',
    'post_id' => 'integer',
    'artwork_id' => 'integer',
    'artist_id' => 'integer',
    'gallery_id' => 'integer',
    'exhibition_id' => 'integer',
    'size' => 'integer',
    'width' => 'integer',
    'height' => 'integer',
    'image_order' => 'integer',
    'is_primary' => 'boolean',
    'is_watermarked' => 'boolean',
    'is_used' => 'boolean'
  ];

  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [
    'name' => 'required|max_length[255]',
    'file_path' => 'permit_empty|max_length[500]',
    'size' => 'required|integer|greater_than[0]',
    'image_type' => 'permit_empty|in_list[artwork,thumbnail,profile,gallery,exhibition,event,other]'
  ];

  protected $skipValidation = false;
  protected $cleanValidationRules = true;
  protected $allowCallbacks = true;

  public function getArtworkImages(int $artworkId): array
  {
    return $this->where('artwork_id', $artworkId)
      ->where('image_type', 'artwork')
      ->orderBy('image_order', 'ASC')
      ->findAll();
  }

  public function getPrimaryImage(int $artworkId): ?array
  {
    return $this->where('artwork_id', $artworkId)
      ->where('is_primary', 1)
      ->first();
  }

  public function getArtistImages(int $artistId): array
  {
    return $this->where('artist_id', $artistId)
      ->orderBy('created_at', 'DESC')
      ->findAll();
  }
}
