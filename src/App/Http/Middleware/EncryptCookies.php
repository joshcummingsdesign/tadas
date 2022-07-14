<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Encrypt cookies middleware.
 *
 * @since 1.0.0
 */
class EncryptCookies extends Middleware {
  /**
   * The names of the cookies that should not be encrypted.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $except = [];
}
