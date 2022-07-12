<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Verify CSRF token middleware.
 *
 * @unreleased
 */
class VerifyCsrfToken extends Middleware {
  /**
   * The URIs that should be excluded from CSRF verification.
   *
   * @unreleased
   *
   * @var array<int, string>
   */
  protected $except = [];
}
