<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get tada lists action.
 *
 * @since 1.0.0
 */
class GetTadaListsAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
   */
  public function __invoke(User $user): Collection {
    return $user->tadaLists()->get();
  }
}
