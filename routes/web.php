<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('users')->middleware('checklogin')->group( function() {
    Route::get('', [UserController::class, 'index'])->name('user.list');
    Route::get('create', [UserController::class, 'create'])->middleware('can:isAdmin')->name('user.create');
    Route::post('store', [UserController::class, 'store'])->middleware('can:isAdmin')->name('user.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->middleware('can:isAdmin')->name('user.edit');
    Route::put('update', [UserController::class, 'update'])->middleware('can:isAdmin')->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'delete'])->middleware('can:isAdmin')->name('user.delete');
});
