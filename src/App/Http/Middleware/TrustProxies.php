<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

/**
 * Trust proxies middleware.
 *
 * @since 1.0.0
 */
class TrustProxies extends Middleware {
  /**
   * The trusted proxies for this application.
   *
   * @since 1.0.0
   *
   * @var array<int, string>|string|null
   */
  protected $proxies;

  /**
   * The headers that should be used to detect proxies.
   *
   * @since 1.0.0
   *
   * @var int
   */
  protected $headers = Request::HEADER_X_FORWARDED_FOR
  | Request::HEADER_X_FORWARDED_HOST
  | Request::HEADER_X_FORWARDED_PORT
  | Request::HEADER_X_FORWARDED_PROTO
  | Request::HEADER_X_FORWARDED_AWS_ELB;
}
