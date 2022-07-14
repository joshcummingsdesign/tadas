<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Trim string middleware.
 *
 * @since 1.0.0
 */
class TrimStrings extends Middleware {
  /**
   * The names of the attributes that should not be trimmed.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $except = [
    'current_password',
    'password',
    'password_confirmation',
  ];
}
