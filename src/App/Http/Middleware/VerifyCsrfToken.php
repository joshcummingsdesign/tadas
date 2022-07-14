<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Verify CSRF token middleware.
 *
 * @since 1.0.0
 */
class VerifyCsrfToken extends Middleware {
  /**
   * The URIs that should be excluded from CSRF verification.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $except = [];
}
