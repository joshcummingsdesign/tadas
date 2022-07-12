<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\User\Models\User;

class DeleteTadaAction {
  /**
   * Invoke the action.
   */
  public function __invoke(User $user, int $id): void {
    $tada = $user->tadas()->find($id);

    if (!$tada) {
      abort(404);
    }

    $tada->delete();
  }
}
