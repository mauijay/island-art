<?php declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GalleriesController extends BaseController {
  public function index()
  {
    $data = [
      'title' => 'Galleries - Island Art',
      'keyword' => 'art galleries, exhibitions, local art, creative spaces, art events',
      'description' => 'Discover the vibrant art galleries featured on Island Art. Explore exhibitions, events, and the creative spaces that showcase local talent.',
      'meta_description' => 'Explore the vibrant art galleries featured on Island Art. Discover exhibitions, events, and creative spaces showcasing local talent.',
    ];
    return view('galleries', $data);
  }

  public function show($id): ResponseInterface
  {
    // Logic to fetch and display a specific gallery by its ID
    return $this->response->setBody("Displaying gallery with ID: $id");
  }

  public function create()
  {
    // Logic to show a form for creating a new gallery
    return $this->response->setBody("Gallery creation form");
  }

  public function store()
  {
    // Logic to handle the submission of the gallery creation form
    return $this->response->setBody("Storing new gallery");
  }

  public function edit($id)
  {
    // Logic to show a form for editing an existing gallery
    return $this->response->setBody("Editing gallery with ID: $id");
  }

  public function update($id)
  {
    // Logic to handle the submission of the gallery edit form
    return $this->response->setBody("Updating gallery with ID: $id");
  }

  public function delete($id)
  {
    // Logic to delete a specific gallery by its ID
    return $this->response->setBody("Deleting gallery with ID: $id");
  }
}
