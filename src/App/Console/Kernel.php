<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * The console kernel.
 *
 * @unreleased
 */
class Kernel extends ConsoleKernel {
  /**
   * Define the application's command schedule.
   *
   * @unreleased
   */
  protected function schedule(Schedule $schedule): void {
    // $schedule->command('inspire')->hourly();
  }

  /**
   * Register the commands for the application.
   *
   * @unreleased
   */
  protected function commands(): void {
    $this->load(__DIR__.'/Commands');

    require base_path('routes/console.php');
  }
}
