<?php

declare(strict_types=1);

use Domain\Tadas\Controllers\TadaListsController;

Route::middleware('auth')->group(function () {
  Route::get('/tadas', [TadaListsController::class, 'index'])
    ->name('tadaLists.index');
  
  Route::get('/tadas/{id}', [TadaListsController::class, 'show'])
    ->name('tadaLists.show');
});
