<?php

namespace Database\Seeders;

use Domain\User\Models\User;
use Illuminate\Database\Seeder;

/**
 * The user seeder.
 *
 * @unreleased
 */
class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @unreleased
   */
  public function run(): void {
    User::factory(10)->create();

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);
  }
}
