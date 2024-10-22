<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

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


Route::get('/dashboard', function () {
    return view('layouts.dashboard_master');
})->middleware(['auth' , 'role']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('layouts.user_side_master');
});

Route::resource('users', UserController::class)->middleware(['auth' , 'role']);

Route::resource('pets', PetController::class)->middleware(['auth' , 'role']);

Route::resource('services', ServiceController::class)->middleware(['auth' , 'role']);
Route::resource('categories', CategoryController::class)->middleware(['auth' , 'role']);
Route::resource('products', ProductController::class)->middleware(['auth' , 'role']);
Route::delete('/service_images/{service_image}', [ServiceImageController::class, 'destroy'])->name('service_images.destroy')->middleware(['auth' , 'role']);

