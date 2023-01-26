<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SettingController;

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


Route::get('/index', [IndexController::class, 'index'])->name('admin');
Route::group(['as' => 'dashboard.'], function (){
Route::put('settings/{setting}/update', [SettingController::class, 'update'])->name('settings.update');
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::resource('categories', CategoryController::class)->except('destroy', 'create', 'show');
Route::resource('products', ProductController::class)->except('show');
Route::get('products/ajax', [ProductController::class, 'getall'])->name('products.getall');
Route::get('category/ajax', [CategoryController::class, 'getAll'])->name('categories.get-all');
Route::delete('categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

});
