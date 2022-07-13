<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Unprocessable entity exception.
 *
 * @unreleased
 */
class UnprocessableEntityException extends Exception {
  /**
   * The user-facing message.
   *
   * @unreleased
   */
  protected ?string $publicMessage;

  /**
   * Create a new exception instance.
   *
   * @unreleased
   */
  public function __construct(
    string $message = "",
    $publicMessage = null,
    int $code = 422,
    ?Throwable $previous = null
  ) {
    parent::__construct($message, $code, $previous);
    $this->publicMessage = $publicMessage;
  }

  /**
   * Get the user-facing message.
   */
  public function getPublicMessage(): string {
    return $this->publicMessage ?? 'There was an issue processing your request.';
  }
}
