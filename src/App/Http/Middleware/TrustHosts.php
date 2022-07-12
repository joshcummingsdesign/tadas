<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

/**
 * Trust hosts middleware.
 *
 * @unreleased
 */
class TrustHosts extends Middleware {
  /**
   * Get the host patterns that should be trusted.
   *
   * @unreleased
   *
   * @return array<int, string|null>
   */
  public function hosts() {
    return [
      $this->allSubdomainsOfApplicationUrl(),
    ];
  }
}
