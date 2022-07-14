<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\DataTransferObjects\StoreTadaListData;
use Domain\Tadas\Models\TadaList;

/**
 * Create tada list action.
 *
 * @since 1.0.0
 */
class CreateTadaListAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
   */
  public function __invoke(int $userId, StoreTadaListData $tadaListData): TadaList {
    return TadaList::create(array_merge([
      'user_id' => $userId,
    ], (array) $tadaListData));
  }
}
