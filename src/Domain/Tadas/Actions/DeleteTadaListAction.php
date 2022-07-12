<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;

/**
 * Delete tada list action.
 *
 * @unreleased
 */
class DeleteTadaListAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user, int $id): void {
    $tadaList = $user->tadaLists()->find($id);

    if (!$tadaList) {
      abort(404);
    }

    $tadaList->delete();
  }
}
