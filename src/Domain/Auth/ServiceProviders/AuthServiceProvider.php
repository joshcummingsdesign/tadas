<?php

declare(strict_types=1);

namespace Domain\Auth\ServiceProviders;

use Domain\Tadas\Models\Tada;
use Domain\Tadas\Models\TadaList;
use Domain\Tadas\Policies\TadaListPolicy;
use Domain\Tadas\Policies\TadaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
     TadaList::class => TadaListPolicy::class,
     Tada::class => TadaPolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void {
    $this->registerPolicies();
  }
}
