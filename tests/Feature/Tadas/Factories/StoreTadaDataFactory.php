<?php

namespace Tests\Feature\Tadas\Factories;

use Domain\Tadas\DataTransferObjects\StoreTadaData;

/**
 * StoreTadaData factory.
 *
 * @since 1.0.0
 */
class StoreTadaDataFactory {
  public ?string $name;
  public int $tada_list_id;

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): StoreTadaData {
    return new StoreTadaData(...(array_merge([
      'name' => $this->name ?? 'Untitled List',
      'tada_list_id' => $this->tada_list_id,
    ], $overrides)));
  }

  public function withName(string $name): static {
    $clone = clone $this;
    $clone->name = $name;
    return $clone;
  }

  public function withTadaListId(string $id): static {
    $clone = clone $this;
    $clone->tada_list_id = $id;
    return $clone;
  }
}
