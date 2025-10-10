<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;
use App\Entities\User;
class UserModel extends ShieldUserModel {

  protected function initialize(): void
  {
    parent::initialize();

    $this->allowedFields = [
      ...$this->allowedFields,

      'first_name',
      'last_name',
      'address',
      'alternative_address',
      'city',
      'state',
      'zip',
      'phone',
      'mobile_number',
      'company',
      'website',
      'job_title',
      'user_type',
      'description',
      'image',
      'avatar',
      'note'
    ];
  }
  protected $column_order = [
    'first_name',
    'last_name',
    'address',
    'alternative_address',
    'city',
    'state',
    'zip',
    'phone',
    'mobile_number',
    'company',
    'website',
    'job_title',
    'user_type',
    'description',
    'image',
    'avatar',
    'note'

  ];
  protected $column_search = [
    'first_name',
    'last_name',
    'phone',
    'mobile_number',
    'address',
    'company'
  ];
  protected $order = ['id' => 'DESC'];

  private function getDatatablesQuery()
  {
    $i = 0;
    foreach ($this->column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->groupStart();
          $this->like($item, $_POST['search']['value']);
        } else {
          $this->orLike($item, $_POST['search']['value']);
        }
        if (count($this->column_search) - 1 == $i)
          $this->groupEnd();
      }
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->orderBy(key($order), $order[key($order)]);
    }
    if (isset($_POST['user'])) {
      if ($_POST['user'] == 'user') {
        $this->join('auth_groups_users agu', 'agu.user_id = users.id')
          ->where('agu.group', 'user');
      }
      ;

    }

  }

  public function getDatatables()
  {
    $this->getDatatablesQuery();
    if ($_POST['length'] != -1)
      return $this->findAll((int) $_POST['length'], (int) $_POST['start']);
  }

  public function countFiltered()
  {
    $this->getDatatablesQuery();
    return $this->countAllResults();
  }

  public function countAll()
  {
    return $this->countAllResults();
  }

  public function lastActiveUser($limit = 6)
  {
    $users = $this
      ->where('last_active !=', null)
      ->OrderBy('last_active', 'desc')
      ->limit($limit)
      ->findAll();
    return $users;
  }

}
