<?php

declare(strict_types=1);

namespace Domain\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Verify email controller.
 *
 * @since 1.0.0
 */
class VerifyEmailController extends Controller {
  /**
   * Mark the authenticated user's email address as verified.
   *
   * @since 1.0.0
   */
  public function __invoke(EmailVerificationRequest $request): RedirectResponse {
    if ($request->user()->hasVerifiedEmail()) {
      return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }

    if ($request->user()->markEmailAsVerified()) {
      event(new Verified($request->user()));
    }

    return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
  }
}
