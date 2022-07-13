<?php

declare(strict_types=1);

namespace Domain\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Email verification prompt controller.
 *
 * @unreleased
 */
class EmailVerificationPromptController extends Controller {
  /**
   * Display the email verification prompt.
   *
   * @unreleased
   */
  public function __invoke(Request $request): RedirectResponse|Response {
    return $request->user()->hasVerifiedEmail()
    ? redirect()->intended(RouteServiceProvider::HOME)
    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
  }
}
