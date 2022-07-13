<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
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
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, int $id, StoreTadaListData $tadaListData): void {
    $tadaList = $user->tadaLists()->find($id);

    if (!$tadaList) {
      throw new UnprocessableEntityException('Invalid TadaList id.');
    }

    $data = collect((array) $tadaListData)->whereNotNull()->toArray();

    $tadaList->update($data);
  }
}
