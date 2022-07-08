<?php

declare(strict_types=1);

namespace Domain\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller {
  /**
   * Send a new email verification notification.
   */
  public function store(Request $request): RedirectResponse {
    if ($request->user()->hasVerifiedEmail()) {
      return redirect()->intended(RouteServiceProvider::HOME);
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
  }
}
