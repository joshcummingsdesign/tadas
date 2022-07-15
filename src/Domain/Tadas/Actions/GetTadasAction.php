<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use Domain\Tadas\Models\TadaList;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get tadas action.
 *
 * @since 1.0.0
 */
class GetTadasAction {
  /**
   * Invoke the action.
   *
   * @since 1.0.0
   */
  public function __invoke(TadaList $tadaList): Collection {
    return $tadaList->tadas()->orderBy('index')->get();
  }
}
