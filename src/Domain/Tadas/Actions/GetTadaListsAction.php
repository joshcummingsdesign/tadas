<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get tada lists action.
 *
 * @unreleased
 */
class GetTadaListsAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user): Collection {
    return $user->tadaLists()->get();
  }
}
