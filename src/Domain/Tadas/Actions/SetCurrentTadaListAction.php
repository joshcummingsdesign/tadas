<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\CurrentTadaList;

/**
 * Set current tada list action.
 *
 * @unreleased
 */
class SetCurrentTadaListAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(int $userId, int $tadaListId): void {
    $found = CurrentTadaList::where('user_id', $userId)->first();

    if ($found) {
      $found->update(['tada_list_id' => $tadaListId]);
      return;
    }

    CurrentTadaList::create([
      'user_id' => $userId,
      'tada_list_id' => $tadaListId,
    ]);
  }
}
