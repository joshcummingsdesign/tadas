<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\DataTransferObjects\UpdateTadaData;
use Domain\User\Models\User;

/**
 * Update tada action.
 *
 * @unreleased
 */
class UpdateTadaAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user, int $id, UpdateTadaData $tadaData): void {
    $tada = $user->tadas()->find($id);

    if (!$tada) {
      abort(500);
    }

    $tada->update(array_filter((array) $tadaData));
  }
}
