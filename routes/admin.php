<?php

use App\Livewire\Admin\AdminLogin;
use App\Livewire\Admin\AdminLoginProcess;
use App\Livewire\Admin\AdminRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
Route::domain(adminUrl())->name('admin.')->group(function () {
    Route::get('/', function () { return redirect('/login'); });
    Route::get('/login', AdminLogin::class)->name('login');
    Route::get('/register', AdminRegister::class)->name('register');
    // Route::get('/login', AdminLoginProcess::class)->name('login.post');

});
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



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
