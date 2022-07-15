<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Exceptions\UnprocessableEntityException;
use App\Http\Controllers\Controller;
use Domain\Tadas\Actions\BatchUpdateTadasAction;
use Domain\Tadas\Actions\CreateTadaAction;
use Domain\Tadas\Actions\DeleteTadaAction;
use Domain\Tadas\Actions\UpdateTadaAction;
use Domain\Tadas\DataTransferObjects\BatchUpdateTadasData;
use Domain\Tadas\DataTransferObjects\StoreTadaData;
use Domain\Tadas\DataTransferObjects\UpdateTadaData;
use Domain\Tadas\Requests\BatchUpdateTadaRequest;
use Domain\Tadas\Requests\StoreTadaRequest;
use Domain\Tadas\Requests\UpdateTadaRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Tadas controller.
 *
 * @since 1.0.0
 */
class TadasController extends Controller {
  /**
   * Store a tada.
   *
   * @since 1.0.0
   */
  public function store(StoreTadaRequest $request): RedirectResponse {
    $tadaData = new StoreTadaData(...$request->validated());

    $user = $request->user();

    try {
      app(CreateTadaAction::class)($user, $tadaData);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }

  /**
   * Batch update tadas.
   *
   * @since 1.3.0
   */
  public function batchUpdate(BatchUpdateTadaRequest $request) {
    $tadasData = array_reduce($request->validated()['tadas'], static function ($acc, $val) {
      $acc[] = new BatchUpdateTadasData(...$val);
      return $acc;
    }, []);

    $user = $request->user();

    try {
      app(BatchUpdateTadasAction::class)($user, $tadasData);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }

  /**
   * Update the specified tada list.
   *
   * @since 1.0.0
   */
  public function update(UpdateTadaRequest $request, int $id): RedirectResponse {
    $tadaData = new UpdateTadaData(...$request->validated());

    $user = $request->user();

    try {
      app(UpdateTadaAction::class)($user, $id, $tadaData);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }

  /**
   * Delete the specified tada.
   *
   * @since 1.0.0
   */
  public function destroy(Request $request, int $id): RedirectResponse {
    $user = $request->user();

    try {
      app(DeleteTadaAction::class)($user, $id);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }
}
