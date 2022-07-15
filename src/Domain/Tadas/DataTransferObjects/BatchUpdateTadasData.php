<?php

declare(strict_types=1);

namespace Domain\Tadas\DataTransferObjects;

/**
 * Batch update tada data.
 *
 * @unreleased
 */
class BatchUpdateTadasData {
  public function __construct(
    public int $id,
    public ?string $name = null,
    public ?bool $is_completed = null,
    public ?int $index = null,
  ) {
  }
}
