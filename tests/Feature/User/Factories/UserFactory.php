<?php

namespace Tests\Feature\User\Factories;

use Domain\User\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * User factory.
 *
 * @since 1.0.0
 */
class UserFactory {
  public Carbon|string|null $email_verified_at = '2022-07-14 05:59:16';

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): User {
    $user = User::create(array_merge([
      'name' => fake()->name(),
      'email' => fake()->safeEmail(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ], $overrides));

    $user->email_verified_at = is_string($this->email_verified_at) ? now() : $this->email_verified_at;
    $user->remember_token = Str::random(10);

    $user->save();

    return $user->refresh();
  }

  public function unverified(): static {
    $clone = clone $this;
    $clone->email_verified_at = null;
    return $clone;
  }
}
