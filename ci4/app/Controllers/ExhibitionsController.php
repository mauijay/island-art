<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ExhibitionsController extends BaseController {
  public function index()
  {
    $data = [
      'title' => 'Exhibitions - Island Art',
      'keyword' => 'art exhibitions, local art, art events, gallery shows, art showcases',
      'description' => 'Explore the latest art exhibitions featured on Island Art. Discover local art events, gallery shows, and showcases of creative talent.',
      'meta_description' => 'Discover the latest art exhibitions on Island Art. Explore local art events, gallery shows, and showcases of creative talent.',
    ];
    return view('exhibitions', $data);
  }

  public function show($id): ResponseInterface
  {
    // Logic to fetch and display a specific exhibition by its ID
    return $this->response->setBody("Displaying exhibition with ID: $id");
  }
  public function create()
  {
    // Logic to show a form for creating a new exhibition
    return $this->response->setBody("Exhibition creation form");
  }
  public function store()
  {
    // Logic to handle the submission of the exhibition creation form
    return $this->response->setBody("Storing new exhibition");
  }
  public function edit($id)
  {
    // Logic to show a form for editing an existing exhibition
    return $this->response->setBody("Editing exhibition with ID: $id");
  }
  public function update($id)
  {
    // Logic to handle the submission of the exhibition edit form
    return $this->response->setBody("Updating exhibition with ID: $id");
  }
  public function delete($id)
  {
    // Logic to delete a specific exhibition by its ID
    return $this->response->setBody("Deleting exhibition with ID: $id");
  }
}
