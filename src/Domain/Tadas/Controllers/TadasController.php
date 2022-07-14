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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Tadas controller.
 *
 * @unreleased
 */
class TadasController extends Controller {
  /**
   * Store a tada.
   *
   * @unreleased
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
   * Update the specified tada list.
   *
   * @unreleased
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
   * @unreleased
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
