<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model {
  protected $table = 'events';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $returnType = 'array';
  protected $useSoftDeletes = true;
  protected $protectFields = true;

  protected $allowedFields = [
    'gallery_id',
    'organizer_id',
    'title',
    'slug',
    'description',
    'event_type',
    'start_date',
    'end_date',
    'start_time',
    'end_time',
    'is_all_day',
    'location',
    'address',
    'city',
    'state',
    'zip_code',
    'country',
    'latitude',
    'longitude',
    'ticket_price',
    'is_free',
    'max_attendees',
    'current_attendees',
    'featured_image',
    'status',
    'is_featured',
    'requires_rsvp',
    'contact_email',
    'contact_phone',
    'website_url',
    'social_media',
    'meta_data'
  ];

  protected array $casts = [
    'gallery_id' => 'integer',
    'organizer_id' => 'integer',
    'latitude' => 'float',
    'longitude' => 'float',
    'ticket_price' => 'float',
    'is_all_day' => 'boolean',
    'is_free' => 'boolean',
    'max_attendees' => 'integer',
    'current_attendees' => 'integer',
    'is_featured' => 'boolean',
    'requires_rsvp' => 'boolean',
    'social_media' => 'json',
    'meta_data' => 'json'
  ];

  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [
    'title' => 'required|min_length[2]|max_length[255]',
    'slug' => 'required|alpha_dash|max_length[255]|is_unique[events.slug,id,{id}]',
    'start_date' => 'required|valid_date',
    'end_date' => 'permit_empty|valid_date',
    'event_type' => 'permit_empty|in_list[exhibition,workshop,lecture,opening,festival,auction,tour,other]',
    'ticket_price' => 'permit_empty|decimal|greater_than_equal_to[0]',
    'max_attendees' => 'permit_empty|integer|greater_than[0]',
    'status' => 'permit_empty|in_list[draft,published,cancelled,completed]'
  ];

  protected $skipValidation = false;
  protected $cleanValidationRules = true;
  protected $allowCallbacks = true;
  protected $beforeInsert = ['generateSlug'];
  protected $beforeUpdate = ['generateSlug'];

  public function getUpcomingEvents(int $limit = 10): array
  {
    return $this->where('start_date >=', date('Y-m-d'))
      ->where('status', 'published')
      ->orderBy('start_date', 'ASC')
      ->findAll($limit);
  }

  public function getFeaturedEvents(int $limit = 10): array
  {
    return $this->where('is_featured', 1)
      ->where('status', 'published')
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
