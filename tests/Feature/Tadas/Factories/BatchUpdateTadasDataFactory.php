<?php

namespace Tests\Feature\Tadas\Factories;

use Domain\Tadas\DataTransferObjects\BatchUpdateTadasData;

/**
 * BatchUpdateTadaData factory.
 *
 * @unreleased
 */
class BatchUpdateTadasDataFactory {
  public int $id;
  public ?string $name;
  public ?bool $is_completed;
  public ?int $index;

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): BatchUpdateTadasData {
    return new BatchUpdateTadasData(...(array_merge([
      'id' => $this->id,
      'name' => $this->name ?? null,
      'is_completed' => $this->is_completed ?? null,
      'index' => $this->index ?? null,
    ], $overrides)));
  }

  public function withId(int $id): static {
    $clone = clone $this;
    $clone->id = $id;
    return $clone;
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

  public function withIndex(int $index): static {
    $clone = clone $this;
    $clone->index = $index;
    return $clone;
  }
}
