<?php

namespace Tests\Feature\Auth;

use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class AuthenticationTest extends TestCase {
  use RefreshDatabase;

  public function testShouldRenderLoginScreen(): void {
    $response = $this->get('/login');

    $response->assertStatus(200);
  }

  public function testShouldLogin(): void {
    $user = UserFactory::new()->create();

    $response = $this->post('/login', [
      'email' => $user->email,
      'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
  }

  public function shouldPreventInvalidPassword(): void {
    $user = UserFactory::new()->create();

    $this->post('/login', [
      'email' => $user->email,
      'password' => 'wrong-password',
    ]);

    $this->assertGuest();
  }
}
