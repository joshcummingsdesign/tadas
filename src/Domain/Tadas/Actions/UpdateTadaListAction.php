<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;

/**
 * Update tada list action.
 *
 * @unreleased
 */
class UpdateTadaListAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user, int $id, array $attributes): void {
    $tadaList = $user->tadaLists()->find($id);

    if (!$tadaList) {
      abort(404);
    }

    // @todo make DTO
    $tadaList->update($attributes);
  }
}
