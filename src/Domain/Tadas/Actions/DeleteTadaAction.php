<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
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
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, int $id): void {
    $tada = $user->tadas()->find($id);

    if (!$tada) {
      throw new UnprocessableEntityException('Invalid Tada id.');
    }

    $tada->delete();
  }
}
