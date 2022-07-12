<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Encrypt cookies middleware.
 *
 * @unreleased
 */
class EncryptCookies extends Middleware {
  /**
   * The names of the cookies that should not be encrypted.
   *
   * @unreleased
   *
   * @var array<int, string>
   */
  protected $except = [];
}
