<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;
use Domain\User\Models\User;

class GetTadaListAction {
  /**
   * Invoke the action.
   */
  public function __invoke(User $user, int $id): ?TadaList {
    return $user->tadaLists()->find($id);
  }
}
