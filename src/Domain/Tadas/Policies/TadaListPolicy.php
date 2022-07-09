<?php

namespace Domain\Tadas\Policies;

use Domain\Tadas\Models\TadaList;
use Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TadaListPolicy {
  use HandlesAuthorization;
  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, TadaList $tadaList): bool {
    return $user->id === $tadaList->user_id;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, TadaList $tadaList): bool {
    return $user->id === $tadaList->user_id;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, TadaList $tadaList): bool {
    return $user->id === $tadaList->user_id;
  }
}
