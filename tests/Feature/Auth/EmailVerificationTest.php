<?php

namespace Tests\Feature\Auth;

use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class EmailVerificationTest extends TestCase {
  use RefreshDatabase;

  public function testShouldRenderEmailVerificationScreen(): void {
    $user = UserFactory::new()->unverified()->create();

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertStatus(200);
  }

  public function testShouldVerifyEmail(): void {
    $user = UserFactory::new()->unverified()->create();

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
      'verification.verify',
      now()->addMinutes(60),
      ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = $this->actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    $this->assertTrue($user->fresh()->hasVerifiedEmail());
    $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
  }

  public function testShouldPreventInvalidEmailVerificationHash(): void {
    $user = UserFactory::new()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
      'verification.verify',
      now()->addMinutes(60),
      ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($verificationUrl);

    $this->assertFalse($user->fresh()->hasVerifiedEmail());
  }
}
