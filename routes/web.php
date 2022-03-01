<?php

use App\Http\Controllers\Auth\InforController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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


Auth::routes();
Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect']);
Route::get('/callback/{provider}', [SocialController::class, 'callback']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [HomeController::class, 'show']);
Route::get('/product-detail/{slug}', [ProductController::class, 'index']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/infor/{id}', [InforController::class, 'edit'])->middleware('checkuser');
    Route::post('/post-infor/{id}', [InforController::class, 'update'])->middleware('checkuser');
    Route::post('/cart-add', [CartController::class, 'add']);
    Route::get('/cart-show', [CartController::class, 'index']);
    Route::get('/cart-update', [CartController::class, 'update']);
    Route::get('/cart-delete', [CartController::class, 'delete_item']);
    Route::get('/cart-destroy', [CartController::class, 'destroy']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/post-checkout', [CheckoutController::class, 'checkout']);
    Route::get('/done', function(){
        return view('client.checkout.done');
    });
});
