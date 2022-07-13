<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
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
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, int $id, UpdateTadaData $tadaData): void {
    $tada = $user->tadas()->find($id);

    if (!$tada) {
      throw new UnprocessableEntityException('Invalid Tada id.');
    }

    $data = collect((array) $tadaData)->whereNotNull()->toArray();

    $tada->update($data);
  }
}
