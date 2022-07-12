<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Http\Controllers\Controller;
use Domain\Tadas\Actions\CreateTadaListAction;
use Domain\Tadas\Actions\DeleteTadaListAction;
use Domain\Tadas\Actions\GetCurrentTadaListAction;
use Domain\Tadas\Actions\GetTadaListAction;
use Domain\Tadas\Actions\GetTadaListsAction;
use Domain\Tadas\Actions\GetTadasAction;
use Domain\Tadas\Actions\SetCurrentTadaListAction;
use Domain\Tadas\Requests\StoreTadaListRequest;
use Domain\User\Actions\GetUserAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TadaListsController extends Controller {
  private GetUserAction $getUserAction;
  private GetCurrentTadaListAction $getCurrentTadaListAction;
  private GetTadaListsAction $getTadaListsAction;
  private GetTadaListAction $getTadaListAction;
  private GetTadasAction $getTadasAction;
  private CreateTadaListAction $createTadaListAction;
  private SetCurrentTadaListAction $setCurrentTadaListAction;
  private DeleteTadaListAction $deleteTadaListAction;

  public function __construct(
    GetUserAction $getUserAction,
    GetCurrentTadaListAction $getCurrentTadaListAction,
    GetTadaListsAction $getTadaListsAction,
    GetTadaListAction $getTadaListAction,
    GetTadasAction $getTadasAction,
    CreateTadaListAction $createTadaListAction,
    SetCurrentTadaListAction $setCurrentTadaListAction,
    DeleteTadaListAction $deleteTadaListAction,
  ) {
    $this->getUserAction = $getUserAction;
    $this->getCurrentTadaListAction = $getCurrentTadaListAction;
    $this->getTadaListsAction = $getTadaListsAction;
    $this->getTadaListAction = $getTadaListAction;
    $this->getTadasAction = $getTadasAction;
    $this->createTadaListAction = $createTadaListAction;
    $this->setCurrentTadaListAction = $setCurrentTadaListAction;
    $this->deleteTadaListAction = $deleteTadaListAction;
  }

  /**
   * Display all tada lists.
   */
  public function index(Request $request): Response|RedirectResponse {
    $user = ($this->getUserAction)();

    $currentTadaList = ($this->getCurrentTadaListAction)($user);

    if ($currentTadaList) {
      return Redirect::route('tadaLists.show', ['id' => $currentTadaList->id]);
    }

    $tadaLists = ($this->getTadaListsAction)($user);

    return Inertia::render('Tadas/TadaLists', [
      'tadaLists' => $tadaLists,
    ]);
  }

  /**
   * Store a tada list.
   */
  public function store(StoreTadaListRequest $request): RedirectResponse {
    $validated = $request->validated();

    $userId = $request->user()->id;

    $tadaList = ($this->createTadaListAction)($userId, $validated['name']);
    ($this->setCurrentTadaListAction)($userId, $tadaList->id);

    return Redirect::route('tadaLists.show', ['id' => $tadaList->id]);
  }

  /**
   * Display the specified tada list.
   */
  public function show(int $id): Response|RedirectResponse {
    $user = ($this->getUserAction)();
    $tadaList = ($this->getTadaListAction)($user, $id);

    if (!$tadaList) {
      return Redirect::route('tadaLists.index');
    }

    ($this->setCurrentTadaListAction)($user->id, $tadaList->id);

    $tadaLists = ($this->getTadaListsAction)($user);
    $tadas = ($this->getTadasAction)($tadaList);

    return Inertia::render('Tadas/TadaList', [
      'listId' => $id,
      'tadaLists' => $tadaLists,
      'tadaList' => $tadaList,
      'tadas' => $tadas,
    ]);
  }

  /**
   * Delete the specified tada list.
   */
  public function destroy(int $id): RedirectResponse {
    $user = ($this->getUserAction)();
    ($this->deleteTadaListAction)($user, $id);

    return Redirect::back();
  }
}
