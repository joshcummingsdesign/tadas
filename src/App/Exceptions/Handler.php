<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Psr\Log\LogLevel;
use Throwable;

/**
 * The exception handler.
 *
 * @since 1.0.0
 */
class Handler extends ExceptionHandler {
  /**
   * A list of exception types with their corresponding custom log levels.
   *
   * @since 1.0.0
   *
   * @var array<class-string<Throwable>, LogLevel::*>
   */
  protected $levels = [];

  /**
   * A list of the exception types that are not reported.
   *
   * @since 1.0.0
   *
   * @var array<int, class-string<\Throwable>>
   */
  protected $dontReport = [];

  /**
   * A list of the inputs that are never flashed to the session on validation exceptions.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $dontFlash = [
    'current_password',
    'password',
    'password_confirmation',
  ];

  /**
   * Register the exception handling callbacks for the application.
   *
   * @since 1.0.0
   */
  public function register(): void {
    $this->reportable(function (Throwable $e) {
    });
  }
}
