<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\Tada;
use Domain\User\Models\User;

/**
 * Create tada action.
 *
 * @unreleased
 */
class CreateTadaAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(User $user, int $tadaListId, string $name): Tada {
    if (!$user->tadaLists()->find($tadaListId)) {
      abort(500);
    }

    return Tada::create([
      'user_id' => $user->id,
      'tada_list_id' => $tadaListId,
      'name' => $name,
    ]);
  }
}
