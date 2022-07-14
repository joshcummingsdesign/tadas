<?php

declare(strict_types=1);

namespace App\ServiceProviders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * App service provider.
 *
 * @since 1.0.0
 */
class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @since 1.0.0
   */
  public function register(): void {
    Factory::guessFactoryNamesUsing(function ($class) {
      return 'Database\\Factories\\' . class_basename($class) . 'Factory';
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @since 1.0.0
   */
  public function boot(): void {
  }
}
