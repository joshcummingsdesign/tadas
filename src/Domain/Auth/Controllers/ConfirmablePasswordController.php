<?php

declare(strict_types=1);

namespace Domain\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\ServiceProviders\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Confirmable password controller.
 *
 * @since 1.0.0
 */
class ConfirmablePasswordController extends Controller {
  /**
   * Show the confirm password view.
   *
   * @since 1.0.0
   */
  public function show(): Response {
    return Inertia::render('Auth/ConfirmPassword');
  }

  /**
   * Confirm the user's password.
   *
   * @since 1.0.0
   *
   * @throws ValidationException
   */
  public function store(Request $request): RedirectResponse {
    if (!Auth::guard('web')->validate([
      'email' => $request->user()->email,
      'password' => $request->password,
    ])) {
      throw ValidationException::withMessages([
        'password' => __('auth.password'),
      ]);
    }

    $request->session()->put('auth.password_confirmed_at', time());

    return redirect()->intended(RouteServiceProvider::HOME);
  }
}
