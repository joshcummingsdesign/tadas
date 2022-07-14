<?php

declare(strict_types=1);

namespace Domain\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\ServiceProviders\RouteServiceProvider;
use Domain\Auth\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Authenticated session controller.
 *
 * @since 1.0.0
 */
class AuthenticatedSessionController extends Controller {
  /**
   * Display the login view.
   *
   * @since 1.0.0
   */
  public function create(): Response {
    return Inertia::render('Auth/Login', [
      'canResetPassword' => Route::has('password.request'),
      'status' => session('status'),
    ]);
  }

  /**
   * Handle an incoming authentication request.
   *
   * @since 1.0.0
   */
  public function store(LoginRequest $request): RedirectResponse {
    $request->authenticate();

    $request->session()->regenerate();

    return redirect()->intended(RouteServiceProvider::HOME);
  }

  /**
   * Destroy an authenticated session.
   *
   * @since 1.0.0
   */
  public function destroy(Request $request): RedirectResponse {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
