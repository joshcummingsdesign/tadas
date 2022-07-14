<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

/**
 * Inertia request handler middleware.
 *
 * @since 1.0.0
 *
 * @var string
 */
class HandleInertiaRequests extends Middleware {
  /**
   * The root template that is loaded on the first page visit.
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $rootView = 'app';

  /**
   * Determine the current asset version.
   *
   * @since 1.0.0
   */
  public function version(Request $request): ?string {
    return parent::version($request);
  }

  /**
   * Define the props that are shared by default.
   *
   * @since 1.0.0
   */
  public function share(Request $request): array {
    return array_merge(parent::share($request), [
      'auth' => [
        'user' => $request->user(),
      ],
      'ziggy' => function () use ($request) {
        return array_merge((new Ziggy)->toArray(), [
          'location' => $request->url(),
        ]);
      },
    ]);
  }
}
