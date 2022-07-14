<?php

declare(strict_types=1);

namespace App\ServiceProviders;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

/**
 * Broadcast service provider.
 *
 * @since 1.0.0
 */
class BroadcastServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @since 1.0.0
   */
  public function boot(): void {
    Broadcast::routes();

    require base_path('routes/channels.php');
  }
}
