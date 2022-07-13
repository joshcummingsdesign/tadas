<?php

declare(strict_types=1);

namespace Domain\Tadas\DataTransferObjects;

/**
 * Store tada list data.
 *
 * @unreleased
 */
class StoreTadaListData {
  public function __construct(
    public string $name,
  ) {
  }
}
