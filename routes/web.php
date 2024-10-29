<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ContactController;

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
Route::resource('/contacts', ContactController::class)->middleware(['auth', 'role']);



Route::get('/', [HomeController::class, 'index']);
Route::get('/home/{id}', [HomeController::class, 'show'])->name('landing_single_product');

Route::get('/about_us', function () {
    return view('about_us');
})->name("about_us");

Route::get('/service',[ServiceController::class, 'index_user_side'])->name("services");

Route::get('/service_details', function () {
    return view('service_details');
})->name("service_details");

Route::get('/store',[StoreController::class, 'index'])->name("store");
Route::get('/store/{id}',[StoreController::class, 'show'])->name("single_product");




Route::get('/contact', function () {
    return view('contact');
})->name("contact");

Route::get('/cart', function () {
    return view('cart');
})->name("cart");

Route::get('/pet_adoption',[PetController::class, 'index_user_side'])->name("pet_adoption");

Route::get('/product_details', function () {
    return view('product_details');
})->name("product_details");


Route::get('/pet_details', function () {
    return view('pet_details');
})->name("pet_details");

Route::get('/service_details/{id}', [ServiceController::class, 'show_user_side'])->name('service_details');

Route::get('/pet_details/{id}', [PetController::class, 'show_user_side'])->name('pet_details');


