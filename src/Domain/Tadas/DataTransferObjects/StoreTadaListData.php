<?php

declare(strict_types=1);

namespace Domain\Tadas\DataTransferObjects;

/**
 * Store tada list data.
 *
 * @since 1.0.0
 */
class StoreTadaListData {
  public function __construct(
    public string $name,
  ) {
  }
}
