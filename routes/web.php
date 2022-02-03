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

Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('doLogin');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/product/{product}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::post('/product/{product}', [App\Http\Controllers\HomeController::class, 'productAdd'])->name('productAdd');
Route::get('/productAdd/{id}/{from}', [App\Http\Controllers\HomeController::class, 'productAdd'])->name('productAddFromHome');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('homeAdmin');

Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::post('/cart', [App\Http\Controllers\HomeController::class, 'cartUpdate'])->name('cartUpdate');
Route::get('/cartDelete/{cartProduct}', [App\Http\Controllers\HomeController::class, 'cartProductDelete'])->name('cartProductDelete');
    
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/cart/checkout', [App\Http\Controllers\HomeController::class, 'cartCheckout'])->name('cartCheckout');
    Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkoutCreate'])->name('checkoutCreate');
    Route::post('/paymentCreate/{order}', [App\Http\Controllers\ProfileController::class, 'paymentCreate'])->name('paymentCreate');
    Route::get('/payment/{order}', [App\Http\Controllers\ProfileController::class, 'payment'])->name('payment');
    Route::get('/orders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('orders');
});