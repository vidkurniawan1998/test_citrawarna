<?php

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

use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Halaman Utama Login
Route::prefix('user')->name('user.')->group(function () {
    //http://127.0.0.1:8000/user/login
    Route::get('/login', [UserController::class, 'index'])->name('login');
    Route::post('/prosesloginadmin', [UserController::class, 'process_login'])->name('process_login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::prefix('barangmasuk')->name('barangmasuk.')->group(function () {
    //http://127.0.0.1:8000/barangmasuk/
    Route::get('/list', [BarangMasukController::class, 'index'])->name('list');
    Route::post('/processcreatebarang', [BarangMasukController::class, 'store'])->name('create');
    Route::get('/edit/{id}', [BarangMasukController::class, 'show'])->name('show');
    Route::post('/update/{id}', [BarangMasukController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [BarangMasukController::class, 'destroy'])->name('delete');
});

Route::prefix('barangkeluar')->name('barangkeluar.')->group(function () {
    //http://127.0.0.1:8000/barangkeluar/
    Route::get('/list', [BarangKeluarController::class, 'index'])->name('list');
    Route::post('/processcreatebarang', [BarangKeluarController::class, 'store'])->name('create');
    Route::get('/edit/{id}', [BarangKeluarController::class, 'show'])->name('show');
    Route::post('/update/{id}', [BarangKeluarController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [BarangKeluarController::class, 'destroy'])->name('delete');
});
