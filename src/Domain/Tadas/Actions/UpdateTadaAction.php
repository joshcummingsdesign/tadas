<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

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
  public function __invoke(User $user, int $id, array $attributes): void {
    $tada = $user->tadas()->find($id);

    if (!$tada) {
      abort(404);
    }

    // @todo make DTO
    $tada->update($attributes);
  }
}
