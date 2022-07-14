<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;
use Domain\User\Models\User;

/**
 * Get current tada list action.
 *
 * @since 1.0.0
 */
class GetCurrentTadaListAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
   */
  public function __invoke(User $user): ?TadaList {
    $tadaListId =  $user->currentTadaList->tada_list_id ?? null;

    if (!$tadaListId) {
      return null;
    }

    return $user->tadaLists()->find($tadaListId);
  }
}
