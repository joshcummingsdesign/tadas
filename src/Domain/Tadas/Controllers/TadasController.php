<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Exceptions\UnprocessableEntityException;
use App\Http\Controllers\Controller;
use Domain\Tadas\Actions\CreateTadaAction;
use Domain\Tadas\Actions\DeleteTadaAction;
use Domain\Tadas\Actions\UpdateTadaAction;
use Domain\Tadas\DataTransferObjects\StoreTadaData;
use Domain\Tadas\DataTransferObjects\UpdateTadaData;
use Domain\Tadas\Requests\StoreTadaRequest;
use Domain\Tadas\Requests\UpdateTadaRequest;
use Domain\User\Actions\GetUserAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

/**
 * Tadas controller.
 *
 * @unreleased
 */
class TadasController extends Controller {
  private GetUserAction $getUserAction;
  private CreateTadaAction $createTadaAction;
  private DeleteTadaAction $deleteTadaAction;
  private UpdateTadaAction $updateTadaAction;

  /**
   * Create a new controller instance.
   *
   * @unreleased
   */
  public function __construct(
    GetUserAction $getUserAction,
    CreateTadaAction $createTadaAction,
    DeleteTadaAction $deleteTadaAction,
    UpdateTadaAction $updateTadaAction
  ) {
    $this->getUserAction = $getUserAction;
    $this->createTadaAction = $createTadaAction;
    $this->deleteTadaAction = $deleteTadaAction;
    $this->updateTadaAction = $updateTadaAction;
  }

  /**
   * Store a tada.
   *
   * @unreleased
   */
  public function store(StoreTadaRequest $request): RedirectResponse {
    $tadaData = new StoreTadaData(...$request->validated());

    $user = ($this->getUserAction)();

    try {
      ($this->createTadaAction)($user, $tadaData);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }

  /**
   * Update the specified tada list.
   *
   * @unreleased
   */
  public function update(UpdateTadaRequest $request, int $id): RedirectResponse {
    $tadaData = new UpdateTadaData(...$request->validated());

    $user = ($this->getUserAction)();

    try {
      ($this->updateTadaAction)($user, $id, $tadaData);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }

  /**
   * Delete the specified tada.
   *
   * @unreleased
   */
  public function destroy(int $id): RedirectResponse {
    $user = ($this->getUserAction)();

    try {
      ($this->deleteTadaAction)($user, $id);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }
}
