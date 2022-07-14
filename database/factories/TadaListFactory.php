<?php

namespace Database\Factories;

use Domain\Tadas\Models\TadaList;

/**
 * TadaList factory.
 *
 * @unreleased
 */
class TadaListFactory {
  public int $user_id;

  public static function new(): self {
    return new self();
  }

  public function create(array $overrides = []): TadaList {
    return TadaList::create(array_merge([
      'user_id' => $this->user_id,
      'name' => 'Untitled List',
    ], $overrides));
  }

  public function withUserId(int $id): static {
    $clone = clone $this;
    $clone->user_id = $id;
    return $clone;
  }
}
