<?php

namespace App\Models\Factories;

use App\Entities\User;
use App\Models\UserModel;
use Faker\Generator;

class UserFactory extends UserModel {
  /**
   * Factory method to create a fake user for testing.
   */
  public function fake(Generator &$faker): User
  {
    return new User([
      'username' => $this->generateUniqueUsername($faker->userName()),
      'first_name' => $faker->firstName(),
      'last_name' => $faker->lastName(),
      'email' => $faker->email(),
      'password' => $faker->password(),
      'active' => true,
      'phone' => $faker->phoneNumber(),
      'address' => $faker->address(),
      'alternative_address' => $faker->secondaryAddress(),
      'city' => $faker->city(),
      'state' => $faker->stateAbbr(),
      'zip' => $faker->postcode(),
      'mobile_number' => $faker->phoneNumber(),
      'company' => $faker->company(),
      'website' => $faker->url(),
      'job_title' => $faker->jobTitle(),
      'user_type' => $faker->randomElement(['client', 'lead', 'staff']),
      'description' => $faker->paragraph(),
      'image' => $faker->imageUrl(400, 400, 'people'),
      'note' => $faker->text(200),
    ]);
  }

  private function generateUniqueUsername(string $username): string
  {
    $username = url_title($username, '-', true);

    if ($this->where('username', $username)->first()) {
      helper('text');
      $username .= '-' . random_string('alnum', 4);
    }

    return $username;
  }

}
