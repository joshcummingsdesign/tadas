<?php

namespace Database\Factories;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory {
  /**
   * The name of the factory's corresponding model.
   *
   * @unreleased
   */
  protected $model = User::class;

  /**
   * Define the model's default state.
   *
   * @unreleased
   */
  public function definition(): array {
    return [
      'name' => fake()->name(),
      'email' => fake()->safeEmail(),
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   *
   * @unreleased
   */
  public function unverified(): static {
    return $this->state(function (array $attributes) {
      return [
        'email_verified_at' => null,
      ];
    });
  }
}
