<?php

declare(strict_types=1);

namespace Domain\User\Repositories;

use Domain\User\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;

class User {
  /**
   * Get user's current tada list.
   */
  public function getCurrentTadaList(): ?int {
    $userId = Auth::id();
    $user = UserModel::find($userId);

    if (!$user) {
      return null;
    }

    return $user->currentTadaList->tada_list_id ?? null;
  }
}
