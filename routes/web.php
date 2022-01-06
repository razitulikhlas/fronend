<?php

use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardDriverController;
use App\Http\Controllers\ListPromoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RequestSaldoController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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


Route::get('login', [LoginController::class, 'index'])->name('login');

// Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
// Route::get('/customer', [CustomerController::class, 'index']);
// Route::get('/store', [StoreController::class, 'index']);

// Route::get('/dashboard', [DashboardController::class, 'index']);


Route::group(['middleware'=>['session']],function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // CUSTOMER
    Route::resource('/customer', CustomerController::class);
    // Route::post('/drivers/{id}/{status}', [DashboardDriverController::class, 'aktivationDriver']);


    // DRIVER //
    Route::resource('/drivers', DashboardDriverController::class);
    Route::get('/driver/{id}', [DashboardDriverController::class, 'show']);
    Route::post('/drivers/{id}/{status}', [DashboardDriverController::class, 'aktivationDriver']);

    // SETTING //
    Route::resource('/setting', SettingController::class);
    // Route::get('/driver/{id}', [DashboardDriverController::class, 'show']);
    // Route::post('/drivers/{id}/{status}', [DashboardDriverController::class, 'aktivationDriver']);

    // PROMO
    Route::resource('/promo', PromoController::class);
    Route::resource('/listPromo', ListPromoController::class);



    Route::resource('/benefit', BenefitController::class);

    // STORE //
    Route::resource('/store', StoreController::class);
    Route::resource('/transaksi', TransactionController::class);
    Route::post('/store/{id}/{status}', [StoreController::class, 'aktivationStore']);
    Route::get('/store/{id}', [StoreController::class, 'getListProductStore']);
    Route::post('/product/{id}/{status}/{idStore}', [StoreController::class, 'activationProduct']);

    // Request Saldo
    Route::resource('/request', RequestSaldoController::class);
    Route::get('/request/{id}/{type}/{category}', [RequestSaldoController::class,'update']);
    Route::get('/pdf/{id}', [TransactionController::class,'generatepdf']);
    Route::put('/request/{id}/{type}/{category}', [RequestSaldoController::class,'update']);
    Route::resource('/testing', TestingController::class);
});





// Route::prefix('login')->group(function () {
//     Route::get('', [LoginController::class, 'index']);
//     Route::post('', [LoginController::class, 'login']);
// });
