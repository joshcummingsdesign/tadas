<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\User\Models\User;

/**
 * Delete tada list action.
 *
 * @since 1.0.0
 */
class DeleteTadaListAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, int $id): void {
    $tadaList = $user->tadaLists()->find($id);

    if (!$tadaList) {
      throw new UnprocessableEntityException('Invalid TadaList id.');
    }

    $currentTadaList = app(GetCurrentTadaListAction::class)($user);

    if ($currentTadaList && $currentTadaList->id === $tadaList->id) {
      $tadaList->delete();

      $latest = $user->tadaLists()->first();


      if ($latest) {
        app(SetCurrentTadaListAction::class)($user->id, $latest->id);
      }

      return;
    }

    $tadaList->delete();
  }
}
