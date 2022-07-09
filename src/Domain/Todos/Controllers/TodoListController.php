<?php

declare(strict_types=1);

namespace Domain\Todos\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class TodoListController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index(): Response {
    return Inertia::render('Todos/TodoLists');
  }
}
