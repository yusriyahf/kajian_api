<?php

use App\Http\Controllers\AuthControllerWeb;
use App\Http\Controllers\KajianControllerWeb;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranControllerWeb;
use App\Http\Controllers\TiketControllerWeb;
use App\Http\Controllers\UserControllerWeb;
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

Route::get('/', [PembayaranControllerWeb::class, 'dashboard']);


Route::get('/login', [AuthControllerWeb::class, 'index'])->name('login');
Route::post('/login', [AuthControllerWeb::class, 'authenticate']);
Route::post('/logout', [AuthControllerWeb::class, 'logout']);

// ROUTE USER
Route::get('/user', [UserControllerWeb::class, 'index']);
Route::get('/user/create', [UserControllerWeb::class, 'create']);
Route::post('/user/create', [UserControllerWeb::class, 'store']);
Route::get('/user/{id}/edit', [UserControllerWeb::class, 'edit']);
Route::put('/user/{id}', [UserControllerWeb::class, 'update']);
Route::delete('/user/{id}', [UserControllerWeb::class, 'destroy']);


// ROUTE KAJIAN
Route::get('/kajian', [KajianControllerWeb::class, 'index']);
Route::get('/kajian/create', [KajianControllerWeb::class, 'create']);
Route::post('/kajian/create', [KajianControllerWeb::class, 'store']);
Route::get('/kajian/{id}/edit', [KajianControllerWeb::class, 'edit']);
Route::put('/kajian/{id}', [KajianControllerWeb::class, 'update']);
Route::delete('/kajian/{id}', [KajianControllerWeb::class, 'destroy']);

Route::get('/pembayaran', [PembayaranControllerWeb::class, 'index']);
Route::get('/pembayaran/{id}/edit', [PembayaranControllerWeb::class, 'edit']);

Route::get('/tiket', [TiketControllerWeb::class, 'index']);
Route::get('/tiket/{id}/edit', [TiketControllerWeb::class, 'edit']);
