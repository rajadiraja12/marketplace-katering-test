<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\MerchantController as CustomerMerchantController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Merchant\DashboardController as MerchantDashboardController;
use App\Http\Controllers\Merchant\MenuController as MerchantMenuController;
use App\Http\Controllers\Merchant\OrderController as MerchantOrderController;
use App\Http\Controllers\Merchant\ProfileController as MerchantProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AuthController::class,'login']);
    Route::get('/register', [AuthController::class,'showRegister'])->name('register');
    Route::post('/register', [AuthController::class,'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard',[MerchantDashboardController::class,'index'])->name('dashboard');

    Route::get('/profile',[MerchantProfileController::class,'edit'])->name('profile.edit');
    Route::put('/profile',[MerchantProfileController::class,'update'])->name('profile.update');

    Route::resource('menus', MerchantMenuController::class);

    Route::get('/orders',[MerchantOrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{order}',[MerchantOrderController::class,'show'])->name('orders.show');
    Route::put('/orders/{order}',[MerchantOrderController::class,'updateStatus'])->name('orders.status');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard',[CustomerDashboardController::class,'index'])->name('dashboard');

    Route::get('/merchants',[CustomerMerchantController::class,'index'])->name('merchants.index');
    Route::get('/merchants/{merchant}',[CustomerMerchantController::class, 'show'])->name('merchants.show');

    Route::get('/orders',[CustomerOrderController::class,'index'])->name('orders.index');
    Route::get('/orders/create/{menu}',[CustomerOrderController::class,'create'])->name('orders.create');
    Route::post('/orders',[CustomerOrderController::class,'store'])->name('orders.store');
    Route::get('/orders/{order}',[CustomerOrderController::class,'show'])->name('orders.show');
});

Route::middleware('auth')->get('/invoice/{order}',[CustomerOrderController::class, 'invoice'])->name('invoice.download');