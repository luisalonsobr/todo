<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Livewire\Admin\AdminLogin;
use App\Livewire\Admin\AdminLoginProcess;
use App\Livewire\Admin\AdminRegister;
use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;


Route::domain(adminUrl())->name('admin.')->group(function () {
    Route::get('/', function () { return redirect('/login'); });
    Route::get('/login', AdminLogin::class)->name('login');
    Route::get('/register', AdminRegister::class)->name('register');

});


Route::name('admin.')->namespace('admin.')->middleware('admin')->group(function(){
    Route::namespace('Auth')->middleware('auth:admin')->group(function(){


        // Route::get('/dashboard', Dashboard::class)->name('dashboard');


        Route::get('/logout',function(){
            Auth::guard('admin')->logout();
            Auth::guard('web')->logout();
            return Redirect::to('login');
        })->name('getlogout');

    });
});





