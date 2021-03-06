<?php

namespace Tests\Feature\Auth;

use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase {
  use RefreshDatabase;

  public function testShouldRenderRegistrationScreen(): void {
    $response = $this->get('/register');

    $response->assertStatus(200);
  }

  public function testShouldRegisterNewUsers(): void {
    $response = $this->post('/register', [
      'name' => 'Test User',
      'email' => 'test@example.com',
      'password' => 'password',
      'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
  }
}
