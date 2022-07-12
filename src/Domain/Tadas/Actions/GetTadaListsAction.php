<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetTadaListsAction {
  /**
   * Invoke the action.
   */
  public function __invoke(User $user): Collection {
    return $user->tadaLists()->get();
  }
}
