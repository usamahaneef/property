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

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'login'])->name('user.login');
Route::get('register', [AuthController::class, 'register'])->name('user.register');
// user controller in web
Route::get('profile', [UserController::class, 'profile']);
// Route::get('/become-partner',[\App\Http\Controllers\Web\HomeController::class,'becomePartner'])->name('web.partner');
// Route::get('/privacy-policy',[\App\Http\Controllers\Web\HomeController::class,'privacyPolicy'])->name('web.privacy-policy');
// Route::get('/account-deletion',[\App\Http\Controllers\Web\HomeController::class,'accountDeletion'])->name('web.account.deletion');
// Route::get('/send',[\App\Http\Controllers\Web\HomeController::class,'sendNotification']);