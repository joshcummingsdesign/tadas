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
 * @since 1.0.0
 */
class RedirectIfAuthenticated {
  /**
   * Handle an incoming request.
   *
   * @since 1.0.0
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
