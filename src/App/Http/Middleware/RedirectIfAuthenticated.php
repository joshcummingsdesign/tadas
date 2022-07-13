<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\ServiceProviders\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Redirect if authenticated middleware.
 *
 * @unreleased
 */
class RedirectIfAuthenticated {
  /**
   * Handle an incoming request.
   *
   * @unreleased
   *
   * @param string[]|null ...$guards
   *
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$guards) {
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
      if (Auth::guard($guard)->check()) {
        return redirect(RouteServiceProvider::HOME);
      }
    }

    return $next($request);
  }
}
