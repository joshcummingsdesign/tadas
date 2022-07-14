<?php

namespace Tests\Feature\Tadas\Factories;

use Domain\Tadas\DataTransferObjects\UpdateTadaData;

/**
 * UpdateTadaData factory.
 *
 * @unreleased
 */
class UpdateTadaDataFactory {
  public ?string $name;
  public ?bool $is_completed;

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): UpdateTadaData {
    return new UpdateTadaData(...(array_merge([
      'name' => $this->name ?? null,
      'is_completed' => $this->is_completed ?? null,
    ], $overrides)));
  }

  public function withName(string $name): static {
    $clone = clone $this;
    $clone->name = $name;
    return $clone;
  }

  public function withIsCompleted(bool $is_completed): static {
    $clone = clone $this;
    $clone->is_completed = $is_completed;
    return $clone;
  }
}
