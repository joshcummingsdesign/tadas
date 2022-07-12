<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;

class CreateTadaListAction {
  /**
   * Invoke the action.
   */
  public function __invoke(int $userId, string $name): TadaList {
    return TadaList::create([
      'user_id' => $userId,
      'name' => $name,
    ]);
  }
}
