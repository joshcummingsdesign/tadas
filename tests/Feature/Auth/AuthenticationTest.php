<?php

namespace Tests\Feature\Auth;

use App\ServiceProviders\RouteServiceProvider;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase {
  use RefreshDatabase;

  public function testLoginScreenCanBeRendered(): void {
    $response = $this->get('/login');

    $response->assertStatus(200);
  }

  public function testUsersCanAuthenticateUsingTheLoginScreen(): void {
    $user = UserFactory::new()->create();

    $response = $this->post('/login', [
      'email' => $user->email,
      'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
  }

  public function testUsersCanNotAuthenticateWithInvalidPassword(): void {
    $user = UserFactory::new()->create();

    $this->post('/login', [
      'email' => $user->email,
      'password' => 'wrong-password',
    ]);

    $this->assertGuest();
  }
}
