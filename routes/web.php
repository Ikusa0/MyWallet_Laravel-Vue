<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;
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
    return view('wallet');
})->name('wallet.web.get');

Route::get('/login', [AuthController::class, 'login'])->name('login.web.get');
Route::post('/login', [AuthController::class, 'loginAPI'])->name('login.api.post');

Route::get('/register', [AuthController::class, 'register'])->name('register.web.get');
Route::post('/register', [AuthController::class, 'registerAPI'])->name('register.api.post');

Route::get('/logout', [AuthController::class, 'logoutAPI'])->name('logout.api.get');

Route::get('/wallet', [WalletController::class, 'getWallet'])->name('wallet.api.get');
Route::post('/wallet', [WalletController::class, 'addWalletEntry'])->name('wallet.api.post');
Route::delete('/wallet', [WalletController::class, 'deleteWalletEntry'])->name('wallet.api.delete');
