<?php

use App\Http\Livewire\Collections;
use App\Http\Livewire\Todos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/tadas');

Route::get('/tadas', Collections::class)
    ->middleware(['auth'])->name('tadas');

Route::get('/tadas/{id}', Todos::class)
    ->middleware(['auth'])->name('tada');

require __DIR__.'/auth.php';
