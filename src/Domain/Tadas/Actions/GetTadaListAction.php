<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;
use Domain\User\Models\User;

/**
 * Get tada list action.
 *
 * @since 1.0.0
 */
class GetTadaListAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
   */
  public function __invoke(User $user, int $id): ?TadaList {
    return $user->tadaLists()->find($id);
  }
}
