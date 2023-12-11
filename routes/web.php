<?php

use App\Http\Controllers\TaskListController;
use App\Livewire\TaskListEdit;
use App\Livewire\TaskListsIndex;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Redirect::to('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/listas/criar', [TaskListController::class, 'create'])->name('task-lists.creat');
    Route::get('/listas', TaskListsIndex::class)->name('task-lists.index');
    Route::get('/listas/edit/{id}', TaskListEdit::class)->name('task-lists.edit');
});
