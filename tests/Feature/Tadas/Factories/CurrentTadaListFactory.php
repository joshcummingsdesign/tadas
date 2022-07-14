<?php

namespace Tests\Feature\Tadas\Factories;

use Domain\Tadas\Models\CurrentTadaList;

/**
 * CurrentTadaList factory.
 *
 * @since 1.0.0
 */
class CurrentTadaListFactory {
  public int $user_id;
  public int $tada_list_id;

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): CurrentTadaList {
    return CurrentTadaList::create(array_merge([
      'user_id' => $this->user_id,
      'tada_list_id' => $this->tada_list_id,
    ], $overrides));
  }

  public function withUserId(int $id): static {
    $clone = clone $this;
    $clone->user_id = $id;
    return $clone;
  }

  public function withTadaListId(int $id): static {
    $clone = clone $this;
    $clone->tada_list_id = $id;
    return $clone;
  }
}
