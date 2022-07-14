<?php

declare(strict_types=1);

namespace Domain\Tadas\DataTransferObjects;

/**
 * Store tada data.
 *
 * @since 1.0.0
 */
class StoreTadaData {
  public function __construct(
    public string $name,
    public int $tada_list_id,
  ) {
  }
}
