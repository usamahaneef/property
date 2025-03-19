<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
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

// Route::get('/', function () {
//     return redirect()->route('admin.login');
// });

Route::view('/login', 'web.auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('user.register');
Route::post('/register', [AuthController::class, 'register'])->name('user.registor.store');

Route::middleware('auth:member')->group(function () {
    // Route::fallback(function () {
        //     return redirect()->back();
        // });
        Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
    });
    
    Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
    Route::get('profile', [UserController::class, 'profile']);
    Route::get('chat', [UserController::class, 'chat'])->name('user.chat');