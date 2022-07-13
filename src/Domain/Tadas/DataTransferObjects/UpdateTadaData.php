<?php

declare(strict_types=1);

namespace Domain\Tadas\DataTransferObjects;

/**
 * Update tada data.
 *
 * @unreleased
 */
class UpdateTadaData {
  public function __construct(
    public ?string $name = null,
    public ?bool $is_completed = null,
  ) {
  }
}
