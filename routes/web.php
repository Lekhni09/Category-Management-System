<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::get('/categories/{category}/delete', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.delete');
Route::get('/categories/{category}/status', [\App\Http\Controllers\CategoryController::class, 'status'])->name('categories.status');
Route::get('/categories/{category}/full-path', [\App\Http\Controllers\CategoryController::class, 'fullPath'])->name('categories.full-path');
Route::get('/categories/{category}/children', [\App\Http\Controllers\CategoryController::class, 'children'])->name('categories.children');
Route::get('/categories/{category}/parent', [\App\Http\Controllers\CategoryController::class, 'parent'])->name('categories.parent');
Route::get('/categories/{category}/siblings', [\App\Http\Controllers\CategoryController::class, 'siblings'])->name('categories.siblings');


Route::resource('users', \App\Http\Controllers\UserController::class);
