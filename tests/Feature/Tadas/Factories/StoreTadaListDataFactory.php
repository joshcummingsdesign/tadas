<?php

namespace Tests\Feature\Tadas\Factories;

use Domain\Tadas\DataTransferObjects\StoreTadaListData;

/**
 * StoreTadaListData factory.
 *
 * @unreleased
 */
class StoreTadaListDataFactory {
  public ?string $name;

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): StoreTadaListData {
    return new StoreTadaListData(...(array_merge([
      'name' => $this->name ?? 'Untitled List',
    ], $overrides)));
  }

  public function withName(string $name): static {
    $clone = clone $this;
    $clone->name = $name;
    return $clone;
  }
}
