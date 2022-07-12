<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;

/**
 * Create tada list action.
 *
 * @unreleased
 */
class CreateTadaListAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(int $userId, string $name): TadaList {
    // @todo make DTO
    return TadaList::create([
      'user_id' => $userId,
      'name' => $name,
    ]);
  }
}
