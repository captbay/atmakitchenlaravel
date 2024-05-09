<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// API without login
Route::group(['prefix' => 'auth'], function () {
    // login
    Route::post('login', [AuthController::class, 'login']);
    // register
    Route::post('register', [AuthController::class, 'register']);
    // verif and resend email
    Route::get('email/verify/{id}', [AuthController::class, 'verifyEmail'])->name('verification.verify'); // Make sure to keep this as your route name
    Route::post('email/resend', [AuthController::class, 'resendEmailVerification'])->name('verification.resend');
    // forgot password
    Route::post('forgotPassword', [AuthController::class, 'sendEmailForgotPassword'])->middleware('guest')->name('password.email');
    // reset password
    Route::post('resetPassword', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
});

// logout
Route::group(['prefix' => 'auth', 'middleware' => ['auth:sanctum', 'verified']], function () {
    //logout
    Route::get('logout', [AuthController::class, 'logout']);
    // change password
    Route::put('changePassword', [AuthController::class, 'changePassword']);
});

// ini hapus
Route::get('/karyawan/alltantok', [KaryawanController::class, 'index']);

// karyawan
Route::group(['prefix' => 'karyawan', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [KaryawanController::class, 'index']);
    // store
    Route::post('store', [KaryawanController::class, 'store']);
    // show
    Route::get('show/{id}', [KaryawanController::class, 'show']);
    // update
    Route::put('update/{id}', [KaryawanController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [KaryawanController::class, 'destroy']);
});
