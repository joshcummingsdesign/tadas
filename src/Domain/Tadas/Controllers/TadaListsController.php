<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Http\Controllers\Controller;
use Domain\User\Repositories\User as UserRespository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TadaListsController extends Controller {
  /**
   * The User Repository instance.
   */
  private UserRespository $userRepository;

  /**
   * Instantiate the controller.
   */
  public function __construct(UserRespository $userRepository) {
    $this->userRepository = $userRepository;
  }

  /**
   * Display all tada lists.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(): Response|RedirectResponse {
    $currentTadaList = $this->userRepository->getCurrentTadaList();

    if ($currentTadaList) {
      return Redirect::route('tadaLists.show', ['id' => $currentTadaList]);
    }

    return Inertia::render('Tadas/TadaLists');
  }

  /**
   * Display the specified tada list.
   */
  public function show(int $id): Response {
    return Inertia::render('Tadas/TadaList');
  }
}
