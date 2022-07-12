<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Http\Controllers\Controller;
use Domain\Tadas\Actions\CreateTadaAction;
use Domain\Tadas\Actions\DeleteTadaAction;
use Domain\Tadas\Requests\StoreTadaRequest;
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

  /**
   * Create a new controller instance.
   *
   * @unreleased
   */
  public function __construct(
    GetUserAction $getUserAction,
    CreateTadaAction $createTadaAction,
    DeleteTadaAction $deleteTadaAction
  ) {
    $this->getUserAction = $getUserAction;
    $this->createTadaAction = $createTadaAction;
    $this->deleteTadaAction = $deleteTadaAction;
  }

  /**
   * Store a tada.
   *
   * @unreleased
   */
  public function store(StoreTadaRequest $request, int $id): RedirectResponse {
    $validated = $request->validated();

    $user = ($this->getUserAction)();

    ($this->createTadaAction)($user, $id, $validated['name']);

    return Redirect::back();
  }

  /**
   * Delete the specified tada.
   *
   * @unreleased
   */
  public function destroy(int $id): RedirectResponse {
    $user = ($this->getUserAction)();

    ($this->deleteTadaAction)($user, $id);

    return Redirect::back();
  }
}
