<?php

declare(strict_types=1);

namespace Domain\Auth\ServiceProviders;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Auth service provider.
 *
 * @since 1.0.0
 */
class AuthServiceProvider extends ServiceProvider {
  /**
   * The model to policy mappings for the application.
   *
   * @since 1.0.0
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [];

  /**
   * Register any authentication / authorization services.
   *
   * @since 1.0.0
   */
  public function boot(): void {
    $this->registerPolicies();
  }
}
