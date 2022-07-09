<?php

declare(strict_types=1);

use Domain\Todos\Controllers\TodoListController;

Route::middleware('auth')->group(function () {
  Route::resource('tadas', TodoListController::class)->only([
    'index'
  ]);
});
