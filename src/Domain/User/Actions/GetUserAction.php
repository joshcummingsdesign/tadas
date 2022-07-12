<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Get user action.
 *
 * @unreleased
 */
class GetUserAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(): User {
    $userId = Auth::id();
    return User::find($userId);
  }
}
