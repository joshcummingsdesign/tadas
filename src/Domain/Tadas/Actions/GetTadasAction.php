<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get tadas action.
 *
 * @unreleased
 */
class GetTadasAction {
  /**
   * Invoke the action.
   *
   * @unreleased
   */
  public function __invoke(TadaList $tadaList): Collection {
    return $tadaList->tadas()->get();
  }
}
