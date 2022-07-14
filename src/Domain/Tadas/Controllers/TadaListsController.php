<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Exceptions\UnprocessableEntityException;
use App\Http\Controllers\Controller;
use Domain\Tadas\Actions\CreateTadaListAction;
use Domain\Tadas\Actions\DeleteTadaListAction;
use Domain\Tadas\Actions\GetCurrentTadaListAction;
use Domain\Tadas\Actions\GetTadaListAction;
use Domain\Tadas\Actions\GetTadaListsAction;
use Domain\Tadas\Actions\GetTadasAction;
use Domain\Tadas\Actions\SetCurrentTadaListAction;
use Domain\Tadas\Actions\UpdateTadaListAction;
use Domain\Tadas\DataTransferObjects\StoreTadaListData;
use Domain\Tadas\Requests\StoreTadaListRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Tada lists controller.
 *
 * @since 1.0.0
 */
class TadaListsController extends Controller {
  /**
   * Display all tada lists.
   *
   * @since 1.0.0
   */
  public function index(Request $request): Response|RedirectResponse {
    $user = $request->user();
    $currentTadaList = app(GetCurrentTadaListAction::class)($user);

    if ($currentTadaList) {
      return Redirect::route('tadaLists.show', ['id' => $currentTadaList->id]);
    }

    $tadaLists = app(GetTadaListsAction::class)($user);

    return Inertia::render('Tadas/TadaLists', [
      'tadaLists' => $tadaLists,
    ]);
  }

  /**
   * Store a tada list.
   *
   * @since 1.0.0
   */
  public function store(StoreTadaListRequest $request): RedirectResponse {
    $tadaListData = new StoreTadaListData(...$request->validated());

    $userId = $request->user()->id;

    $tadaList = app(CreateTadaListAction::class)($userId, $tadaListData);
    app(SetCurrentTadaListAction::class)($userId, $tadaList->id);

    return Redirect::route('tadaLists.show', ['id' => $tadaList->id]);
  }

  /**
   * Display the specified tada list.
   *
   * @since 1.0.0
   */
  public function show(Request $request, int $id): Response|RedirectResponse {
    $user = $request->user();
    $tadaList = app(GetTadaListAction::class)($user, $id);

    if (!$tadaList) {
      return Redirect::route('tadaLists.index');
    }

    $tadaLists = app(GetTadaListsAction::class)($user);
    $tadas = app(GetTadasAction::class)($tadaList);

    app(SetCurrentTadaListAction::class)($user->id, $tadaList->id);

    return Inertia::render('Tadas/TadaList', [
      'listId' => $tadaList->id,
      'tadaLists' => $tadaLists,
      'tadaList' => $tadaList,
      'tadas' => $tadas,
    ]);
  }

  /**
   * Update the specified tada list.
   *
   * @since 1.0.0
   */
  public function update(StoreTadaListRequest $request, int $id): RedirectResponse {
    $tadaListData = new StoreTadaListData(...$request->validated());

    $user = $request->user();

    try {
      app(UpdateTadaListAction::class)($user, $id, $tadaListData);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }

  /**
   * Delete the specified tada list.
   *
   * @since 1.0.0
   */
  public function destroy(Request $request, int $id): RedirectResponse {
    $user = $request->user();

    try {
      app(DeleteTadaListAction::class)($user, $id);
    } catch (UnprocessableEntityException $e) {
      return Redirect::back()->withErrors($e->getPublicMessage());
    }

    return Redirect::back();
  }
}
