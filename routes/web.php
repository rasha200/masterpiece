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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('users', UserController::class)->middleware(['auth' , 'role']);

Route::resource('pets', PetController::class)->middleware(['auth' , 'role']);

Route::resource('services', ServiceController::class)->middleware(['auth' , 'role']);
Route::resource('categories', CategoryController::class)->middleware(['auth' , 'role']);
Route::resource('products', ProductController::class)->middleware(['auth' , 'role']);
Route::delete('/service_images/{service_image}', [ServiceImageController::class, 'destroy'])->name('service_images.destroy')->middleware(['auth' , 'role']);



Route::get('/', function () {
    return view('landing_page');
});

Route::get('/about_us', function () {
    return view('about_us');
});

Route::get('/service', function () {
    return view('services');
});

Route::get('/service_details', function () {
    return view('service_details');
});

Route::get('/store', function () {
    return view('store');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/pet_adoption', function () {
    return view('pet_adoption');
});



Route::get('/services', [ServiceController::class, 'index_user_side']);