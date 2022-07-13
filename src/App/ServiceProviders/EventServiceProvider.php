<?php

declare(strict_types=1);

namespace App\ServiceProviders;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Event service provider.
 *
 * @unreleased
 */
class EventServiceProvider extends ServiceProvider {
  /**
   * The event to listener mappings for the application.
   *
   * @unreleased
   *
   * @var array<class-string, array<int, class-string>>
   */
  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
  ];

  /**
   * Register any events for your application.
   *
   * @unreleased
   */
  public function boot(): void {
  }

  /**
   * Determine if events and listeners should be automatically discovered.
   *
   * @unreleased
   */
  public function shouldDiscoverEvents(): bool {
    return false;
  }
}
