<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Prevent requests during maintenance middleware.
 *
 * @unreleased
 */
class PreventRequestsDuringMaintenance extends Middleware {
  /**
   * The URIs that should be reachable while maintenance mode is enabled.
   *
   * @unreleased
   *
   * @var array<int, string>
   */
  protected $except = [];
}
