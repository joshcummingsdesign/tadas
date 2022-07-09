<?php

namespace Domain\Tadas\Policies;

use Domain\Tadas\Models\Tada;
use Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TadaPolicy {
  use HandlesAuthorization;
  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Tada $tada): bool {
    return $user->id === $tada->user_id;
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, Tada $tada): bool {
    return $user->id === $tada->user_id;
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Tada $tada): bool {
    return $user->id === $tada->user_id;
  }
}
