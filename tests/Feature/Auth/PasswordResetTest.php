<?php

namespace Tests\Feature\Auth;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class PasswordResetTest extends TestCase {
  use RefreshDatabase;

  public function testShouldRenderForgotPasswordScreen(): void {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
  }

  public function testShouldSendResetPasswordLink(): void {
    Notification::fake();

    $user = UserFactory::new()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class);
  }

  public function testShouldRenderResetPasswordScreen(): void {
    Notification::fake();

    $user = UserFactory::new()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
      $response = $this->get('/reset-password/' . $notification->token);

      $response->assertStatus(200);

      return true;
    });
  }

  public function testShouldResetPasswordWithValidToken(): void {
    Notification::fake();

    $user = UserFactory::new()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
      $response = $this->post('/reset-password', [
        'token' => $notification->token,
        'email' => $user->email,
        'password' => 'password',
        'password_confirmation' => 'password',
      ]);

      $response->assertSessionHasNoErrors();

      return true;
    });
  }
}
