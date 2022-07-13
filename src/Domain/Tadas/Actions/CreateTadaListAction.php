<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\DataTransferObjects\StoreTadaListData;
use Domain\Tadas\Models\TadaList;

/**
 * Create tada list action.
 *
 * @unreleased
 */
class CreateTadaListAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(int $userId, StoreTadaListData $tadaListData): TadaList {
    return TadaList::create([
      'user_id' => $userId,
      'name' => $tadaListData->name,
    ]);
  }
}
