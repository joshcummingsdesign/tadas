<?php

declare(strict_types=1);

namespace Domain\Tadas\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TadasController extends Controller {
  /**
   * Display all tada lists.
   */
  public function index(): Response {
    return Inertia::render('Tadas/TadaLists');
  }

  /**
   * Store a tada list.
   */
  public function store(): RedirectResponse {
    return Redirect::back();
  }
}
