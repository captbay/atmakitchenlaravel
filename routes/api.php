<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BonusGajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PembelianBahanBakuController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\PromoPoinController;
use App\Models\BonusGaji;
use App\Models\Produk;
use App\Models\ProdukTitipan;
use App\Http\Controllers\PengeluaranLainnyaController;
use App\Http\Controllers\PresensiController;
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

// promo poin
Route::group(['prefix' => 'promo-poin', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [PromoPoinController::class, 'index']);
    // store
    Route::post('store', [PromoPoinController::class, 'store']);
    // show
    Route::get('show/{id}', [PromoPoinController::class, 'show']);
    // update
    Route::put('update/{id}', [PromoPoinController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [PromoPoinController::class, 'destroy']);
});

// produk
Route::group(['prefix' => 'produk', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [ProdukController::class, 'index']);
    // store
    Route::post('store', [ProdukController::class, 'store']);
    // show
    Route::get('show/{id}', [ProdukController::class, 'show']);
    // update
    Route::post('update/{id}', [ProdukController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [ProdukController::class, 'destroy']);
});

// produk titipan
Route::group(['prefix' => 'produk-titipan', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [ProdukTitipanController::class, 'index']);
    // store
    Route::post('store', [ProdukTitipanController::class, 'store']);
    // show
    Route::get('show/{id}', [ProdukTitipanController::class, 'show']);
    // update
    Route::post('update/{id}', [ProdukTitipanController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [ProdukTitipanController::class, 'destroy']);
});

// bahan baku
Route::group(['prefix' => 'bahan-baku', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [BahanBakuController::class, 'index']);
    // store
    Route::post('store', [BahanBakuController::class, 'store']);
    // show
    Route::get('show/{id}', [BahanBakuController::class, 'show']);
    // update
    Route::post('update/{id}', [BahanBakuController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [BahanBakuController::class, 'destroy']);
});

// pembelian bahan baku
Route::group(['prefix' => 'pembelian-bahan-baku', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [PembelianBahanBakuController::class, 'index']);
    // store
    Route::post('store', [PembelianBahanBakuController::class, 'store']);
    // show
    Route::get('show/{id}', [PembelianBahanBakuController::class, 'show']);
    // update
    Route::post('update/{id}', [PembelianBahanBakuController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [PembelianBahanBakuController::class, 'destroy']);
});

// jabatan
Route::group(['prefix' => 'jabatan', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [JabatanController::class, 'index']);
    // store
    Route::post('store', [JabatanController::class, 'store']);
    // show
    Route::get('show/{id}', [JabatanController::class, 'show']);
    // update
    Route::post('update/{id}', [JabatanController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [JabatanController::class, 'destroy']);
});

// penitip
Route::group(['prefix' => 'penitip', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [PenitipController::class, 'index']);
    // store
    Route::post('store', [PenitipController::class, 'store']);
    // show
    Route::get('show/{id}', [PenitipController::class, 'show']);
    // update
    Route::post('update/{id}', [PenitipController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [PenitipController::class, 'destroy']);
});

// karyawan
Route::group(['prefix' => 'karyawan', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [KaryawanController::class, 'index']);
    // store
    Route::post('store', [KaryawanController::class, 'store']);
    // show
    Route::get('show/{id}', [KaryawanController::class, 'show']);
    // update
    Route::post('update/{id}', [KaryawanController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [KaryawanController::class, 'destroy']);
});

// bonus gaji
Route::group(['prefix' => 'bonus-gaji', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [BonusGajiController::class, 'index']);
    // store
    Route::post('store', [BonusGajiController::class, 'store']);
    // show
    Route::get('show/{id}', [BonusGajiController::class, 'show']);
    // update
    Route::post('update/{id}', [BonusGajiController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [BonusGajiController::class, 'destroy']);
});

// Pengeluaran Lainnya
Route::group(['prefix' => 'pengeluaran-lainnya', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [PengeluaranLainnyaController::class, 'index']);
    // store
    Route::post('store', [PengeluaranLainnyaController::class, 'store']);
    // show
    Route::get('show/{id}', [PengeluaranLainnyaController::class, 'show']);
    // update
    Route::put('update/{id}', [PengeluaranLainnyaController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [PengeluaranLainnyaController::class, 'destroy']);
});

// Presensi Karyawan (ini kayaknya ndak ada karena kita website)
Route::group(['prefix' => 'presensi', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // // index
    // Route::get('index', [PresensiController::class, 'index']);
    // // update
    // Route::put('update/{id}', [PresensiController::class, 'update']);
});

// Registrasi User
Route::group(
    [
        'prefix' => 'user', 'middleware' => [
            'auth:sanctum', 'verified'
        ]
    ],
    function () {
        // update
        Route::get('update', [AuthController::class, 'updateCustomer']);
        // profile
        Route::get('profile', [AuthController::class, 'profile']);
        // transaksi
        Route::get('historyPesanan/{id}', [AuthController::class, 'historyPesanan']);
    }
);

// Mencari Data Customer
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('indexCustomer', [AuthController::class, 'indexCustomer']);
    // kalo cari pesanan si customer bisa pake api/user/historyPesanan/{id} diatas nah si id pake si id user
});

// alamat
Route::group(['prefix' => 'alamat', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [AlamatController::class, 'index']);
    // store
    Route::post('store', [AlamatController::class, 'store']);
    // show
    Route::get('show/{id}', [AlamatController::class, 'show']);
    // update
    Route::put('update/{id}', [AlamatController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [AlamatController::class, 'destroy']);
});

// Pengeluaran Lainnya
Route::group(['prefix' => 'pengeluaran-lainnya', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // index
    Route::get('index', [PengeluaranLainnyaController::class, 'index']);
    // store
    Route::post('store', [PengeluaranLainnyaController::class, 'store']);
    // show
    Route::get('show/{id}', [PengeluaranLainnyaController::class, 'show']);
    // update
    Route::put('update/{id}', [PengeluaranLainnyaController::class, 'update']);
    // destroy
    Route::delete('destroy/{id}', [PengeluaranLainnyaController::class, 'destroy']);
});

// Presensi Karyawan (ini kayaknya ndak ada karena kita website)
Route::group(['prefix' => 'presensi', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // // index
    // Route::get('index', [PresensiController::class, 'index']);
    // // update
    // Route::put('update/{id}', [PresensiController::class, 'update']);
});