<?php

namespace App\Controllers;

use App\Models\ArtistModel;
use App\Models\ArtworkModel;
use App\Models\ImageModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class ApiController extends BaseController {
  use ResponseTrait;

  protected $helpers = ['form'];
  protected $artistModel;
  protected $artworkModel;
  protected $imageModel;
  protected $userModel;

  public function __construct()
  {
    // Initialize models
    $this->artistModel  = new ArtistModel();
    $this->artworkModel = new ArtworkModel();
    $this->imageModel   = new ImageModel();
    $this->userModel    = new UserModel();

    // Disable CSRF protection for API endpoints
    $this->request = \Config\Services::request();
  }

  /**
   * Test endpoint to verify API is working
   */
  public function test()
  {
    return $this->respond([
      'success' => true,
      'message' => 'API is working!',
      'timestamp' => date('Y-m-d H:i:s')
    ]);
  }

  /**
   * Get all artworks with artist and gallery information
   */
  public function getArtworks()
  {
    try {
      // Get artworks with artist and gallery details
      $artworks = $this->artworkModel
        ->select('artworks.*, artists.artist_name, artists.first_name, artists.last_name, galleries.name as gallery_name')
        ->join('artists', 'artists.id = artworks.artist_id', 'left')
        ->join('galleries', 'galleries.id = artworks.gallery_id', 'left')
        ->where('artworks.is_published', 1)
        ->where('artworks.status', 'approved')
        ->orderBy('artworks.created_at', 'DESC')
        ->findAll();

      return $this->respond([
        'success' => true,
        'data' => $artworks,
        'count' => count($artworks)
      ]);
    } catch (\Exception $e) {
      log_message('error', 'Error fetching artworks: ' . $e->getMessage());
      return $this->fail([
        'success' => false,
        'message' => 'Failed to fetch artworks'
      ], 500);
    }
  }

  /**
   * Submit artwork form handler - now saves to database
   */
  public function submitArtwork()
  {
    $request = service('request');

    // Check if request is POST
    if (strtolower($request->getMethod()) !== 'post') {
      return $this->fail([
        'success' => false,
        'message' => 'Invalid request method: ' . $request->getMethod()
      ], 405);
    }

    // Validation rules
    $validationRules = [
      'artist_name' => 'required|min_length[2]|max_length[100]',
      'artist_email' => 'required|valid_email|max_length[255]',
      'artist_phone' => 'permit_empty|max_length[20]',
      'artist_location' => 'permit_empty|max_length[255]',
      'artist_bio' => 'permit_empty|max_length[1000]',
      'artwork_title' => 'required|min_length[2]|max_length[255]',
      'artwork_medium' => 'required|max_length[100]',
      'artwork_year' => 'permit_empty|integer|greater_than[1800]|less_than_equal_to[' . date('Y') . ']',
      'artwork_width' => 'permit_empty|decimal',
      'artwork_height' => 'permit_empty|decimal',
      'artwork_description' => 'required|min_length[10]|max_length[2000]',
      'artwork_for_sale' => 'permit_empty|in_list[1]',
      'artwork_price' => 'permit_empty|decimal',
      'artwork_image' => 'uploaded[artwork_image]|is_image[artwork_image]|max_size[artwork_image,10240]|ext_in[artwork_image,jpg,jpeg,png]'
    ];

    $validationMessages = [
      'artist_name' => [
        'required' => 'Artist name is required',
        'min_length' => 'Artist name must be at least 2 characters',
        'max_length' => 'Artist name cannot exceed 100 characters'
      ],
      'artist_email' => [
        'required' => 'Email address is required',
        'valid_email' => 'Please enter a valid email address',
        'max_length' => 'Email cannot exceed 255 characters'
      ],
      'artwork_title' => [
        'required' => 'Artwork title is required',
        'min_length' => 'Artwork title must be at least 2 characters',
        'max_length' => 'Artwork title cannot exceed 255 characters'
      ],
      'artwork_medium' => [
        'required' => 'Artwork medium is required',
        'max_length' => 'Medium cannot exceed 100 characters'
      ],
      'artwork_description' => [
        'required' => 'Artwork description is required',
        'min_length' => 'Description must be at least 10 characters',
        'max_length' => 'Description cannot exceed 2000 characters'
      ],
      'artwork_image' => [
        'uploaded' => 'Please upload an image of your artwork',
        'is_image' => 'The uploaded file must be an image',
        'max_size' => 'Image size cannot exceed 10MB',
        'ext_in' => 'Only JPG, JPEG, and PNG images are allowed'
      ]
    ];

    // Validate input
    if (!$this->validate($validationRules, $validationMessages)) {
      return $this->fail([
        'success' => false,
        'message' => 'Validation failed',
        'errors' => $this->validator->getErrors()
      ], 400);
    }

    // Start database transaction
    $db = \Config\Database::connect();
    $db->transStart();

    try {
      // Parse artist name into first and last name
      $artistName = trim($request->getPost('artist_name'));
      $nameParts  = explode(' ', $artistName, 2);
      $firstName  = $nameParts[0];
      $lastName   = isset($nameParts[1]) ? $nameParts[1] : '';

      // Check if artist already exists by email
      $existingArtist = $this->artistModel->where('email', $request->getPost('artist_email'))->first();

      if ($existingArtist) {
        $artistId = $existingArtist['id'];
        $userId   = $existingArtist['user_id'];
      } else {
        // Create new user record
        $userData = [
          'email' => $request->getPost('artist_email'),
          'username' => $this->generateUsername($request->getPost('artist_email')),
          'password' => password_hash(uniqid(), PASSWORD_DEFAULT), // Temporary password
          'active' => 0, // Inactive until approved
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ];

        $userId = $this->userModel->insert($userData);
        if (!$userId) {
          throw new \Exception('Failed to create user record');
        }

        // Create artist record
        $artistData = [
          'user_id' => $userId,
          'first_name' => $firstName,
          'last_name' => $lastName,
          'email' => $request->getPost('artist_email'),
          'phone' => $request->getPost('artist_phone'),
          'location' => $request->getPost('artist_location'),
          'biography' => $request->getPost('artist_bio'),
          'status' => 'pending',
          'is_active' => 1,
          'is_featured' => 0
        ];

        $artistId = $this->artistModel->insert($artistData);
        if (!$artistId) {
          throw new \Exception('Failed to create artist record');
        }
      }

      // Handle image upload
      $imageFile     = $request->getFile('artwork_image');
      $imagePath     = null;
      $thumbnailPath = null;
      $imageData     = null;

      if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
        // Generate unique filename
        $originalName = $imageFile->getClientName();
        $newName      = $imageFile->getRandomName();

        // Create upload directories
        $uploadPath   = FCPATH . 'uploads/artworks/';
        $thumbnailDir = $uploadPath . 'thumbnails/';

        if (!is_dir($uploadPath)) {
          mkdir($uploadPath, 0755, true);
        }
        if (!is_dir($thumbnailDir)) {
          mkdir($thumbnailDir, 0755, true);
        }

        // Move original file
        $imageFile->move($uploadPath, $newName);
        $imagePath = 'uploads/artworks/' . $newName;

        // Create thumbnail (you may want to add image manipulation library)
        $thumbnailName = 'thumb_' . $newName;
        $thumbnailPath = 'uploads/artworks/thumbnails/' . $thumbnailName;

        // For now, copy original as thumbnail (implement proper resizing later)
        copy($uploadPath . $newName, $thumbnailDir . $thumbnailName);

        // Get image dimensions
        $imageInfo   = getimagesize($uploadPath . $newName);
        $imageWidth  = $imageInfo ? $imageInfo[0] : null;
        $imageHeight = $imageInfo ? $imageInfo[1] : null;

        // Prepare image data for database
        $imageData = [
          'artist_id' => $artistId,
          'name' => $newName,
          'original_name' => $originalName,
          'file_path' => $imagePath,
          'file_type' => $imageFile->getClientExtension(),
          'mime_type' => $imageFile->getClientMimeType(),
          'size' => $imageFile->getSize(),
          'width' => $imageWidth,
          'height' => $imageHeight,
          'thumbnail_path' => $thumbnailPath,
          'image_type' => 'artwork',
          'is_primary' => 1,
          'is_used' => 1,
          'ip_address' => $request->getIPAddress()
        ];
      }

      // Create artwork record
      $artworkData = [
        'artist_id' => $artistId,
        'title' => $request->getPost('artwork_title'),
        'slug' => $this->generateSlug($request->getPost('artwork_title')),
        'description' => $request->getPost('artwork_description'),
        'medium' => $request->getPost('artwork_medium'),
        'category' => $this->mapMediumToCategory($request->getPost('artwork_medium')),
        'dimensions_height' => $request->getPost('artwork_height'),
        'dimensions_width' => $request->getPost('artwork_width'),
        'dimensions_unit' => 'inches',
        'year_created' => $request->getPost('artwork_year'),
        'price' => $request->getPost('artwork_price'),
        'currency' => 'USD',
        'is_for_sale' => $request->getPost('artwork_for_sale') ? 1 : 0,
        'is_sold' => 0,
        'status' => 'pending',
        'is_featured' => 0,
        'is_published' => 0
      ];

      $artworkId = $this->artworkModel->insert($artworkData);
      if (!$artworkId) {
        throw new \Exception('Failed to create artwork record');
      }

      // Create image record if image was uploaded
      if ($imageData) {
        $imageData['artwork_id'] = $artworkId;
        $imageId                 = $this->imageModel->insert($imageData);

        if ($imageId) {
          // Update artwork with featured image ID
          $this->artworkModel->update($artworkId, ['featured_image_id' => $imageId]);
        }
      }

      // Commit transaction
      $db->transComplete();

      if ($db->transStatus() === false) {
        throw new \Exception('Database transaction failed');
      }

      // Send notification email
      $this->sendNotificationEmail([
        'artist_name' => $artistName,
        'artist_email' => $request->getPost('artist_email'),
        'artwork_title' => $request->getPost('artwork_title'),
        'artwork_medium' => $request->getPost('artwork_medium'),
        'submission_date' => date('Y-m-d H:i:s'),
        'artist_id' => $artistId,
        'artwork_id' => $artworkId
      ]);

      return $this->respond([
        'success' => true,
        'message' => 'Artwork submitted successfully! We will review your submission and contact you soon.',
        'data' => [
          'submission_id' => 'sub_' . $artworkId,
          'artist_id' => $artistId,
          'artwork_id' => $artworkId,
          'artist_name' => $artistName,
          'artwork_title' => $request->getPost('artwork_title')
        ]
      ]);

    } catch (\Exception $e) {
      // Rollback transaction
      $db->transRollback();

      log_message('error', 'Artwork submission error: ' . $e->getMessage());
      return $this->fail([
        'success' => false,
        'message' => 'An error occurred while processing your submission. Please try again.',
        'debug' => ENVIRONMENT === 'development' ? $e->getMessage() : null
      ], 500);
    }
  }

  /**
   * Generate username from email
   */
  private function generateUsername(string $email): string
  {
    $username = strtolower(substr($email, 0, strpos($email, '@')));
    $username = preg_replace('/[^a-z0-9_]/', '', $username);

    // Check if username exists and append number if needed
    $originalUsername = $username;
    $counter          = 1;

    while ($this->userModel->where('username', $username)->first()) {
      $username = $originalUsername . $counter;
      $counter++;
    }

    return $username;
  }

  /**
   * Generate URL-friendly slug
   */
  private function generateSlug(string $title): string
  {
    $slug = url_title($title, '-', true);

    // Check if slug exists and append number if needed
    $originalSlug = $slug;
    $counter      = 1;

    while ($this->artworkModel->where('slug', $slug)->first()) {
      $slug = $originalSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }

  /**
   * Map medium to artwork category
   */
  private function mapMediumToCategory(string $medium): string
  {
    $medium = strtolower($medium);

    $categoryMap = [
      'oil' => 'painting',
      'acrylic' => 'painting',
      'watercolor' => 'painting',
      'pastel' => 'painting',
      'charcoal' => 'drawing',
      'pencil' => 'drawing',
      'ink' => 'drawing',
      'bronze' => 'sculpture',
      'clay' => 'ceramics',
      'ceramic' => 'ceramics',
      'pottery' => 'ceramics',
      'photo' => 'photography',
      'digital' => 'digital',
      'print' => 'printmaking',
      'fabric' => 'textile',
      'fiber' => 'textile',
      'jewelry' => 'jewelry'
    ];

    foreach ($categoryMap as $keyword => $category) {
      if (strpos($medium, $keyword) !== false) {
        return $category;
      }
    }

    return 'other';
  }

  /**
   * Newsletter subscription handler
   */
  public function subscribeNewsletter()
  {
    $request = service('request');

    // Check if request is POST
    if (strtolower($request->getMethod()) !== 'post') {
      return $this->fail([
        'success' => false,
        'message' => 'Invalid request method: ' . $request->getMethod()
      ], 405);
    }

    // Validation rules
    $validationRules = [
      'newsletter_name' => 'required|min_length[2]|max_length[100]',
      'newsletter_email' => 'required|valid_email|max_length[255]',
      'frequency' => 'permit_empty|in_list[weekly,biweekly,monthly,events]',
      'interests' => 'permit_empty'
    ];

    $validationMessages = [
      'newsletter_name' => [
        'required' => 'Name is required',
        'min_length' => 'Name must be at least 2 characters',
        'max_length' => 'Name cannot exceed 100 characters'
      ],
      'newsletter_email' => [
        'required' => 'Email address is required',
        'valid_email' => 'Please enter a valid email address',
        'max_length' => 'Email cannot exceed 255 characters'
      ]
    ];

    // Validate input
    if (!$this->validate($validationRules, $validationMessages)) {
      return $this->fail([
        'success' => false,
        'message' => 'Validation failed',
        'errors' => $this->validator->getErrors()
      ], 400);
    }

    try {
      // Check if newsletter_subscribers table exists
      $db = \Config\Database::connect();

      if (!$db->tableExists('newsletter_subscribers')) {
        return $this->respond([
          'success' => true,
          'message' => 'Thank you for your interest! Newsletter feature is coming soon.'
        ]);
      }

      // Check if email is already subscribed
      $existing = $db->table('newsletter_subscribers')
        ->where('email', $request->getPost('newsletter_email'))
        ->get()
        ->getRow();

      if ($existing) {
        return $this->respond([
          'success' => true,
          'message' => 'You are already subscribed to our newsletter!'
        ]);
      }

      // Process interests
      $interests = $request->getPost('interests') ?? [];
      if (is_array($interests)) {
        $interests = implode(',', $interests);
      }

      // Prepare subscription data
      $subscriptionData = [
        'name' => $request->getPost('newsletter_name'),
        'email' => $request->getPost('newsletter_email'),
        'frequency' => $request->getPost('frequency') ?? 'weekly',
        'interests' => $interests,
        'status' => 'active',
        'subscribed_at' => date('Y-m-d H:i:s'),
        'ip_address' => $request->getIPAddress(),
        'user_agent' => $request->getUserAgent()->getAgentString(),
        'source' => 'website_footer'
      ];

      // Insert subscription
      $result = $db->table('newsletter_subscribers')->insert($subscriptionData);

      if (!$result) {
        throw new \Exception('Failed to save subscription');
      }

      // Send welcome email
      $this->sendWelcomeEmail([
        'name' => $request->getPost('newsletter_name'),
        'email' => $request->getPost('newsletter_email'),
        'frequency' => $request->getPost('frequency') ?? 'weekly'
      ]);

      // Send admin notification
      $this->sendSubscriptionNotification([
        'name' => $request->getPost('newsletter_name'),
        'email' => $request->getPost('newsletter_email'),
        'frequency' => $request->getPost('frequency') ?? 'weekly',
        'interests' => $interests
      ]);

      return $this->respond([
        'success' => true,
        'message' => 'Successfully subscribed! Welcome to our art community.',
        'data' => [
          'email' => $request->getPost('newsletter_email'),
          'frequency' => $request->getPost('frequency') ?? 'weekly'
        ]
      ]);

    } catch (\Exception $e) {
      log_message('error', 'Newsletter subscription error: ' . $e->getMessage());
      return $this->fail([
        'success' => false,
        'message' => 'An error occurred while processing your subscription. Please try again.',
        'debug' => ENVIRONMENT === 'development' ? $e->getMessage() : null
      ], 500);
    }
  }

  /**
   * Send welcome email to new newsletter subscriber
   */
  private function sendWelcomeEmail($data)
  {
    $email = \Config\Services::email();

    try {
      $email->setFrom('hello@islandart.com', 'Island Art Hawaiʻi');
      $email->setTo($data['email']);
      $email->setSubject('Welcome to Island Art Hawaiʻi Newsletter!');

      $message = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
          <div style='background: linear-gradient(135deg, #3b82f6, #14b8a6); padding: 40px 20px; text-align: center; border-radius: 12px 12px 0 0;'>
            <h1 style='color: white; margin: 0; font-size: 28px;'>Aloha, {$data['name']}! 🌺</h1>
            <p style='color: #bfdbfe; margin: 10px 0 0 0; font-size: 18px;'>Welcome to our art ʻohana!</p>
          </div>

          <div style='background: white; padding: 40px 20px; border-radius: 0 0 12px 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
            <p style='color: #374151; font-size: 16px; line-height: 1.6; margin-bottom: 20px;'>
              Thank you for joining our community of art lovers and creators across Hawaiʻi! You'll now receive our <strong>" . ucfirst($data['frequency']) . "</strong> updates featuring:
            </p>

            <ul style='color: #374151; font-size: 16px; line-height: 1.8; margin-bottom: 30px;'>
              <li>🎨 Featured local artists and their stories</li>
              <li>🖼️ Gallery exhibitions and art shows</li>
              <li>🌴 Cultural events across the islands</li>
              <li>📰 Latest art news and community highlights</li>
              <li>🎭 Exclusive behind-the-scenes content</li>
            </ul>

            <div style='background: #f3f4f6; padding: 20px; border-radius: 8px; margin-bottom: 30px;'>
              <p style='color: #6b7280; font-size: 14px; margin: 0; text-align: center;'>
                <strong>Next Newsletter:</strong> Keep an eye out for your first edition coming soon!
              </p>
            </div>

            <div style='text-align: center;'>
              <p style='color: #374151; font-size: 16px; margin-bottom: 20px;'>
                Mahalo for supporting Hawaiʻi's vibrant art community!
              </p>
              <p style='color: #6b7280; font-size: 14px; margin: 0;'>
                The Island Art Hawaiʻi Team<br>
                <a href='mailto:hello@islandart.com' style='color: #3b82f6;'>hello@islandart.com</a>
              </p>
            </div>

            <hr style='border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;'>

            <p style='color: #9ca3af; font-size: 12px; text-align: center; margin: 0;'>
              You can update your preferences or unsubscribe at any time by replying to this email.
            </p>
          </div>
        </div>
      ";

      $email->setMessage($message);
      $email->send();

    } catch (\Exception $e) {
      // Log email error but don't fail the subscription
      log_message('warning', 'Failed to send welcome email: ' . $e->getMessage());
    }
  }

  /**
   * Send admin notification about new newsletter subscription
   */
  private function sendSubscriptionNotification($data)
  {
    $email = \Config\Services::email();

    try {
      $email->setFrom('noreply@islandart.com', 'Island Art Newsletter');
      $email->setTo('admin@islandart.com'); // Admin email
      $email->setSubject('New Newsletter Subscription - ' . $data['name']);

      $message = "
        <h2>New Newsletter Subscription</h2>
        <p><strong>Name:</strong> {$data['name']}</p>
        <p><strong>Email:</strong> {$data['email']}</p>
        <p><strong>Frequency:</strong> {$data['frequency']}</p>
        <p><strong>Interests:</strong> {$data['interests']}</p>
        <p><strong>Subscription Date:</strong> " . date('Y-m-d H:i:s') . "</p>
        <br>
        <p>This subscriber was added to the newsletter list.</p>
      ";

      $email->setMessage($message);
      $email->send();

    } catch (\Exception $e) {
      // Log email error but don't fail the subscription
      log_message('warning', 'Failed to send subscription notification email: ' . $e->getMessage());
    }
  }

  /**
   * Send notification email about new submission
   */
  private function sendNotificationEmail($data)
  {
    $email = \Config\Services::email();

    try {
      $email->setFrom('noreply@islandart.com', 'Island Art');
      $email->setTo('admin@islandart.com'); // Admin email
      $email->setSubject('New Artwork Submission - ' . $data['artwork_title']);

      $message = "
        <h2>New Artwork Submission</h2>
        <p><strong>Artist:</strong> {$data['artist_name']}</p>
        <p><strong>Email:</strong> {$data['artist_email']}</p>
        <p><strong>Artwork Title:</strong> {$data['artwork_title']}</p>
        <p><strong>Medium:</strong> {$data['artwork_medium']}</p>
        <p><strong>Submission Date:</strong> {$data['submission_date']}</p>
        <p><strong>Artist ID:</strong> {$data['artist_id']}</p>
        <p><strong>Artwork ID:</strong> {$data['artwork_id']}</p>
        <br>
        <p>Please review this submission in the admin dashboard.</p>
      ";

      $email->setMessage($message);
      $email->send();

    } catch (\Exception $e) {
      // Log email error but don't fail the submission
      log_message('warning', 'Failed to send notification email: ' . $e->getMessage());
    }
  }
}
