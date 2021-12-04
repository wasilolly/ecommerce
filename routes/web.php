<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StoreFrontController;
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
Route::get('/product/{slug}/show', [StoreFrontController::class, 'show'])->name('singleproduct.show');
Route::get('/category/{slug}/show', [StoreFrontController::class, 'category'])->name('singlecategory.show');

//cart ajax call
Route::get('/product/cart/add',[CartController::class, 'add']);
Route::get('/cart',[CartController::class, 'cart']);
Route::post('/carts/remove',[CartController::class, 'remove'])->name('cart.remove');



//admin  routes
Route::resources([
    'product' => ProductController::class,
    'category' => CategoryController::class,
]);

Route::get('/admin/dashboard', [SettingsController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard/settings',[SettingsController::class, 'settings'])->name('admin.settings');
Route::patch('/admin/dashboard/settings',[SettingsController::class, 'updateSettings'])->name('admin.updateSettings');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




