<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase {
  use RefreshDatabase;

  public function testShouldRenderConfirmPasswordScreen(): void {
    $user = UserFactory::new()->create();

    $response = $this->actingAs($user)->get('/confirm-password');

    $response->assertStatus(200);
  }

  public function testShouldConfirmPassword(): void {
    $user = UserFactory::new()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
      'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
  }

  public function testShouldNotConfirmInvalidPassword(): void {
    $user = UserFactory::new()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
      'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
  }
}
