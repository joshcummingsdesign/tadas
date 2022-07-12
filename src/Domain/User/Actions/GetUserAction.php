<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Models\User;
use Illuminate\Support\Facades\Auth;

class GetUserAction {
  /**
   * Invoke the action.
   */
  public function __invoke(): User {
    $userId = Auth::id();
    return User::find($userId);
  }
}
