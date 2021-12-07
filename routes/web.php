<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StoreFrontController;
use App\Models\Category;
use Illuminate\Routing\RouteGroup;
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

Route::get('/welcome', function () {
    return view('welcome');
});

//Storefront routes
Route::get('/', [StoreFrontController::class, 'index']);
Route::get('/category/product/all', [StoreFrontController::class, 'products'])->name('productindex');
Route::get('/product/{slug}/show', [StoreFrontController::class, 'show'])->name('singleproduct.show');
Route::get('/category/{slug}/show', [StoreFrontController::class, 'category'])->name('singlecategory.show');


//cart ajax call
Route::get('/product/cart/add', [CartController::class, 'add']);
//Route::get('/product/cart/update',[CartController::class, 'update']);
Route::get('/cart', [CartController::class, 'cart']);
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::post('/cart/order', [OrderController::class, 'save'])->name('order');
Route::get('cart/order/{id}', [OrderController::class, 'show'])->name('order.show');





//admin  routes

Route::middleware(['admin'])->group(function () {

    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/product', ProductController::class);

    Route::patch('/admin/category/{id}/untag', [CategoryController::class, 'untag'])->name('admin.categoryuntag');
    Route::get('/admin/settings', [SettingsController::class, 'settings'])->name('admin.settings');
    Route::patch('/admin/settings', [SettingsController::class, 'updateSettings'])->name('admin.updateSettings');
    Route::get('/admin/users', [SettingsController::class, 'users'])->name('admin.users');
    Route::delete('/admin/user/{id}', [SettingsController::class, 'userDestroy'])->name('admin.userdelete');
    Route::post('/admin/users/admin/{id}', [SettingsController::class, 'admin'])->name('admin.adminuser');
    Route::get('/admin/orders', [SettingsController::class, 'orders'])->name('admin.orders');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
