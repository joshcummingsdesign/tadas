<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
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
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, int $id): void {
    $tadaList = $user->tadaLists()->find($id);

    if (!$tadaList) {
      throw new UnprocessableEntityException('Invalid TadaList id.');
    }

    $tadaList->delete();
  }
}
