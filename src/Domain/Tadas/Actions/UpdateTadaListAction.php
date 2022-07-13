<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\DataTransferObjects\StoreTadaListData;
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
  public function __invoke(User $user, int $id, StoreTadaListData $tadaListData): void {
    $tadaList = $user->tadaLists()->find($id);

    if (!$tadaList) {
      abort(404);
    }

    $tadaList->update(array_filter((array) $tadaListData));
  }
}
