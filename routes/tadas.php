<?php

declare(strict_types=1);

use Domain\Tadas\Controllers\TadaListsController;
use Domain\Tadas\Controllers\TadasController;

Route::middleware('auth')->group(function () {
  Route::get('/tadas', [TadaListsController::class, 'index'])
    ->name('tadaLists.index');

  Route::post('/tadas', [TadaListsController::class, 'store'])
    ->name('tadaLists.store');

  Route::get('/tadas/{id}', [TadaListsController::class, 'show'])
    ->name('tadaLists.show');

  Route::patch('/tadas/{id}', [TadaListsController::class, 'update'])
    ->name('tadaLists.update');

  Route::delete('/tadas/{id}', [TadaListsController::class, 'destroy'])
    ->name('tadaLists.destroy');

  Route::post('/tada/{id}', [TadasController::class, 'store'])
    ->name('tadas.store');

  Route::patch('/tada/{id}', [TadasController::class, 'update'])
    ->name('tadas.update');

  Route::delete('/tada/{id}', [TadasController::class, 'destroy'])
    ->name('tadas.destroy');
});
