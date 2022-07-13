<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;

/**
 * Delete tada action.
 *
 * @unreleased
 */
class DeleteTadaAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user, int $id): void {
    $tada = $user->tadas()->find($id);

    if (!$tada) {
      abort(500);
    }

    $tada->delete();
  }
}
