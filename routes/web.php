<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/search', [App\Http\Controllers\HomeController::class, 'index'])->name('search');

Auth::routes();

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('doLogin');

Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');

Route::post('/product/{id}', [App\Http\Controllers\HomeController::class, 'productAdd'])->name('productAdd');

Route::get('/productAdd/{id}/{from}', [App\Http\Controllers\HomeController::class, 'productAdd'])->name('productAddFromHome');

Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');

Route::put('/cart', [App\Http\Controllers\HomeController::class, 'cartUpdate'])->name('cartUpdate');

Route::get('/cartDelete/{id}', [App\Http\Controllers\HomeController::class, 'cartProductDelete'])->name('cartProductDelete');

Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');

Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkoutCreate'])->name('checkoutCreate');

Route::get('/paymentConfirmation', [App\Http\Controllers\ProfileController::class, 'paymentConfirmation'])->name('paymentConfirmation');

Route::get('/payment/{order}', [App\Http\Controllers\ProfileController::class, 'payment'])->name('payment');

Route::post('/paymentCreate/{order}', [App\Http\Controllers\ProfileController::class, 'paymentCreate'])->name('paymentCreate');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('homeAdmin');