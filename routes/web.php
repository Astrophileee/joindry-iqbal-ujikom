<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/admin')->group(function(){
        Route::middleware('level:admin,kasir,owner')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
            Route::resource('/barang', BarangController::class);

        });
        Route::middleware('level:admin')->group(function () {
            Route::resource('/outlet', OutletController::class);
            Route::resource('/paket', PaketController::class);
        });
            Route::middleware('level:admin,kasir')->group(function () {
                Route::resource('/member', MemberController::class);
                Route::resource('/transaksi', TransaksiController::class);
            });
            Route::resource('/user', UserController::class);
    });
});