<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;
use Domain\User\Models\User;

/**
 * Get tada list action.
 *
 * @unreleased
 */
class GetTadaListAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user, int $id): ?TadaList {
    return $user->tadaLists()->find($id);
  }
}
