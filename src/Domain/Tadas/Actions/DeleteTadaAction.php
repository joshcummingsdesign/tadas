<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\User\Models\User;

/**
 * Delete tada action.
 *
 * @since 1.0.0
 */
class DeleteTadaAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
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
