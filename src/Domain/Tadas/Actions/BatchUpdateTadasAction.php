<?php

declare(strict_types=1);

namespace Domain\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\DataTransferObjects\BatchUpdateTadasData;
use Domain\User\Models\User;

/**
 * Batch update tadas action.
 *
 * @since 1.3.0
 */
class BatchUpdateTadasAction {
  /**
   * Invoke the action.
   *
   * @since 1.3.0
   *
   * @param BatchUpdateTadasData[] $tadasData
   *
   * @throws UnprocessableEntityException
   */
  public function __invoke(User $user, array $tadasData): void {
    $tadaIds = array_map(static fn ($tada) => $tada->id, $tadasData);
    $tadas = $user->tadas()->findMany($tadaIds);

    if (!$tadas || count($tadas) !== count($tadasData)) {
      throw new UnprocessableEntityException('Invalid Tada id.');
    }

    foreach ($tadasData as $tadaData) {
      $data = collect((array) $tadaData)
        ->filter(fn ($value, $key) => $key !== 'id')
        ->whereNotNull()
        ->toArray();

      $tadas->find($tadaData->id)->update($data);
    }
  }
}
