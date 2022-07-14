<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Prevent requests during maintenance middleware.
 *
 * @since 1.0.0
 */
class PreventRequestsDuringMaintenance extends Middleware {
  /**
   * The URIs that should be reachable while maintenance mode is enabled.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $except = [];
}
