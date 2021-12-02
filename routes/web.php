<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
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

Route::get('/', function () {
    return view('welcome');
});

//Storefront routes
Route::get('/frontpage', function () {
    return view('storefront.index');
});

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




