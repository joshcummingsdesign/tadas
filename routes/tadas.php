<?php

declare(strict_types=1);

use Domain\Tadas\Controllers\TadasController;

Route::middleware('auth')->group(function () {
  Route::resource('tadas', TadasController::class)
    ->only(['index', 'store']);
});
