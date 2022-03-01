<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCateController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUpdateOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AdminAuthController::class, 'getLogin']);
Route::post('/postLogin', [AdminAuthController::class, 'postLogin']);
Route::group(['middleware' => ['checkauth']], function () {
    Route::get('/logout', [AdminAuthController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/change', [AdminAuthController::class, 'getChange']);
    Route::post('/postChange', [AdminAuthController::class, 'postChange']);
    //admin
    Route::get('/list-admin', [AdminController::class, 'index']);
    Route::get('/admin-add', [AdminController::class, 'add']);
    Route::post('/admin-create', [AdminController::class, 'create']);
    Route::get('/admin-edit/{id}', [AdminController::class, 'edit']);
    Route::post('/admin-update/{id}', [AdminController::class, 'update']);
    Route::get('/admin-delete/{id}', [AdminController::class, 'delete']);
    //user
    Route::get('/list-user', [AdminUserController::class, 'index']);
    Route::get('/user-add', [AdminUserController::class, 'add']);
    Route::post('/user-create', [AdminUserController::class, 'create']);
    Route::get('/user-edit/{id}', [AdminUserController::class, 'edit']);
    Route::post('/user-update/{id}', [AdminUserController::class, 'update']);
    Route::get('/user-delete/{id}', [AdminUserController::class, 'delete']);
    //category
    Route::get('/cate-list', [AdminCateController::class, 'index']);
    Route::post('/cate-create', [AdminCateController::class, 'create']);
    Route::get('/cate-edit/{id}', [AdminCateController::class, 'edit']);
    Route::post('/cate-update', [AdminCateController::class, 'update']);
    Route::get('/cate-delete/{id}', [AdminCateController::class, 'delete']);
    //product
    Route::get('/list-product', [AdminProductController::class, 'index']);
    Route::get('/product-add', [AdminProductController::class, 'add']);
    Route::post('/product-create', [AdminProductController::class, 'create']);
    Route::get('/product-edit/{slug}', [AdminProductController::class, 'edit']);
    Route::post('/product-update/{id}', [AdminProductController::class, 'update']);
    Route::get('/product-delete/{id}', [AdminProductController::class, 'delete']);
    //order
    Route::get('/list-order', [AdminOrderController::class, 'index']);
    Route::get('/order-add', [AdminOrderController::class, 'add']);
    Route::post('/order-cart-add', [AdminOrderController::class, 'order_cart_add']);
    Route::get('/order-cart-show', [AdminOrderController::class, 'order_cart_show']);
    Route::get('/order-cart-update', [AdminOrderController::class, 'order_cart_update']);
    Route::get('/order-cart-delete', [AdminOrderController::class, 'order_cart_delete']);
    Route::post('/order-create', [AdminOrderController::class, 'create']);
    //update_order
    Route::get('/order-edit/{id}', [AdminUpdateOrderController::class, 'edit']);
    Route::get('/order-edit-add/{id}', [AdminUpdateOrderController::class, 'edit_add']);
    Route::post('/order-edit-store', [AdminUpdateOrderController::class, 'edit_store']);
    Route::get('/order-edit-update', [AdminUpdateOrderController::class, 'edit_update']);
    Route::get('/order-edit-delete', [AdminUpdateOrderController::class, 'edit_delete']);
    Route::post('/order-update/{id}', [AdminUpdateOrderController::class, 'update']);
});
