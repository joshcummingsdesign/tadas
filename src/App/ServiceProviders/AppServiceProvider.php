<?php

declare(strict_types=1);

namespace App\ServiceProviders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * App service provider.
 *
 * @unreleased
 */
class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @unreleased
   */
  public function register(): void {
    Factory::guessFactoryNamesUsing(function ($class) {
      return 'Database\\Factories\\' . class_basename($class) . 'Factory';
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @unreleased
   */
  public function boot(): void {
  }
}
