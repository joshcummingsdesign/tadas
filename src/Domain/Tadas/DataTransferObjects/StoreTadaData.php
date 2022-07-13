<?php

declare(strict_types=1);

namespace Domain\Tadas\DataTransferObjects;

/**
 * Store tada data.
 *
 * @unreleased
 */
class StoreTadaData {
  public function __construct(
    public string $name,
    public int $tada_list_id,
  ) {
  }
}
