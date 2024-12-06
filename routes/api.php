<?php

use App\Models\KajianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/role', [AuthController::class, 'getRole']);
    Route::get('/totaluser', [AuthController::class, 'totalUser']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/password', [AuthController::class, 'updatePassword']);

    // Post
    Route::get('/kajianlast', [KajianController::class, 'kajianLast']); // all posts
    Route::get('/kajiantoday', [KajianController::class, 'kajianToday']); // all posts
    Route::get('/kajian', [KajianController::class, 'index']); // all posts
    Route::post('/kajian', [KajianController::class, 'store']); // create post
    Route::get('/kajian/{id}', [KajianController::class, 'show']); // get single post
    Route::put('/kajian/{id}', [KajianController::class, 'update']); // update post
    Route::delete('/kajian/{id}', [KajianController::class, 'destroy']); // delete post

    // Tiket
    Route::get('/tiketlast', [TiketController::class, 'tiketLast']);
    Route::get('/tiket', [TiketController::class, 'index']); // all posts
    Route::post('/tiket', [TiketController::class, 'store']); // create post
    Route::get('/tiket/{id}', [TiketController::class, 'show']); // get single post
    Route::put('/tiket/{id}', [TiketController::class, 'update']); // update post
    Route::delete('/tiket/{id}', [TiketController::class, 'destroy']); // delete post
    Route::post('/tiket/up_bayar', [TiketController::class, 'uploadBuktiPembayaran']);

    // Tiket
    Route::get('/catatan', [CatatanController::class, 'index']); // all posts
    Route::post('/catatan', [CatatanController::class, 'store']); // create post
    Route::get('/catatan/{id}', [CatatanController::class, 'show']); // get single post
    Route::put('/catatan/{id}', [CatatanController::class, 'update']); // update post
    Route::delete('/catatan/{id}', [CatatanController::class, 'destroy']); // delete post

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index']); // all Pembayaran
    Route::post('/pembayaran', [PembayaranController::class, 'store']); // all Pembayaran
    Route::post('/accpembayaran/{id}', [PembayaranController::class, 'acc']); // all Pembayaran
    Route::post('/tolakpembayaran/{id}', [PembayaranController::class, 'tolak']); // all Pembayaran

    // Kehadiran
    Route::post('/addmale', [KehadiranController::class, 'addMale']); // addMale
    Route::post('/addfemale', [KehadiranController::class, 'addFemale']); // addMale
    Route::get('/totalkehadiran/{id}', [KehadiranController::class, 'totalKehadiran']); // totalKehadiran
    Route::get('/totalmale/{id}', [KehadiranController::class, 'totalMale']); // totalKehadiran
    Route::get('/totalfemale/{id}', [KehadiranController::class, 'totalFemale']); // totalKehadiran
    Route::get('/total/{id}', [KehadiranController::class, 'total']); // totalKehadiran
});
