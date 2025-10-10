<?php

namespace App\Models;

use CodeIgniter\Model;

class ExhibitionModel extends Model {
  protected $table = 'exhibitions';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType = 'array';
  protected $useSoftDeletes = true;
  protected $protectFields = true;

  protected $allowedFields = [
    'gallery_id',
    'curator_id',
    'title',
    'slug',
    'description',
    'curator_statement',
    'exhibition_type',
    'start_date',
    'end_date',
    'opening_reception',
    'closing_reception',
    'featured_image',
    'banner_image',
    'catalog_pdf',
    'press_release',
    'status',
    'is_featured',
    'is_published',
    'views_count',
    'meta_title',
    'meta_description',
    'meta_keywords'
  ];

  protected array $casts = [
    'gallery_id' => 'integer',
    'curator_id' => 'integer',
    'is_featured' => 'boolean',
    'is_published' => 'boolean',
    'views_count' => 'integer'
  ];

  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [
    'gallery_id' => 'required|integer|is_not_unique[galleries.id]',
    'title' => 'required|min_length[2]|max_length[255]',
    'slug' => 'required|alpha_dash|max_length[255]|is_unique[exhibitions.slug,id,{id}]',
    'start_date' => 'required|valid_date',
    'end_date' => 'required|valid_date',
    'exhibition_type' => 'permit_empty|in_list[solo,group,themed,retrospective,contemporary,historical]',
    'status' => 'permit_empty|in_list[upcoming,current,past,cancelled]'
  ];

  protected $skipValidation = false;
  protected $cleanValidationRules = true;
  protected $allowCallbacks = true;
  protected $beforeInsert = ['generateSlug'];
  protected $beforeUpdate = ['generateSlug'];

  public function getCurrentExhibitions(): array
  {
    $today = date('Y-m-d');
    return $this->where('start_date <=', $today)
      ->where('end_date >=', $today)
      ->where('status', 'current')
      ->where('is_published', 1)
      ->orderBy('start_date', 'ASC')
      ->findAll();
  }

  public function getUpcomingExhibitions(int $limit = 10): array
  {
    return $this->where('start_date >', date('Y-m-d'))
      ->where('status', 'upcoming')
      ->where('is_published', 1)
      ->orderBy('start_date', 'ASC')
      ->findAll($limit);
  }

  protected function generateSlug(array $data): array
  {
    if (isset($data['data']['title']) && !isset($data['data']['slug'])) {
      $data['data']['slug'] = url_title($data['data']['title'], '-', true);
    }
    return $data;
  }
}
