<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\DataTransferObjects\StoreTadaData;
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
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, StoreTadaData $tadaData): Tada {
    if (!$user->tadaLists()->find($tadaData->tada_list_id)) {
      throw new UnprocessableEntityException('Invalid TadaList id.');
    }

    return Tada::create(array_merge([
      'user_id' => $user->id,
    ], (array) $tadaData));
  }
}
