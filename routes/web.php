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
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ServiceFeedbackController;

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


Auth::routes();


// <!--==========================================  (HOME)  =====================================================-->
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);
Route::get('/home/{id}', [HomeController::class, 'show'])->name('landing_single_product'); //for the product modal in the landing page




// <!--==========================================  (Dashboard)  =====================================================-->
Route::get('/dashboard', function () {
    return view('layouts.dashboard_master');
})->middleware(['auth' , 'role']);



// <!--==========================================  (Users)  =====================================================-->
Route::resource('users', UserController::class)->middleware(['auth' , 'role']);



// <!--==========================================  (Categories)  =====================================================-->
Route::resource('categories', CategoryController::class)->middleware(['auth' , 'role']);



// <!--==========================================  (Products)  =====================================================-->
Route::resource('products', ProductController::class)->middleware(['auth' , 'role']);
Route::get('/product_details', function () {
    return view('product_details');
})->name("product_details");



// <!--==========================================  (Store)  =====================================================-->
Route::get('/store',[StoreController::class, 'index'])->name("store");
Route::get('/store/{id}',[StoreController::class, 'show'])->name("single_product");



// <!--==========================================  (Services)  =====================================================-->
Route::resource('services', ServiceController::class)->middleware(['auth' , 'role']);
Route::delete('/service_images/{service_image}', [ServiceImageController::class, 'destroy'])->name('service_images.destroy')->middleware(['auth' , 'role']);
Route::get('/service',[ServiceController::class, 'index_user_side'])->name("services");
Route::get('/service_details/{id}', [ServiceController::class, 'show_user_side'])->name('service_details');



// <!--==========================================  (Service feedback)  =====================================================-->
// Protected routes
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/serviceFeedbacks', [ServiceFeedbackController::class, 'index'])->name('serviceFeedbacks.index'); // List all serviceFeedbacks (dashboard)
    Route::get('/serviceFeedbacks/{serviceFeedback}', [ServiceFeedbackController::class, 'show'])->name('serviceFeedbacks.show'); // Show
    Route::delete('/serviceFeedbacks/{serviceFeedback}', [ServiceFeedbackController::class, 'destroy'])->name('serviceFeedbacks.destroy'); // Delete
});
// Public routes
Route::post('/serviceFeedbacks', [ServiceFeedbackController::class, 'store'])->name('serviceFeedbacks.store'); // Create
Route::get('/serviceFeedbacks/create', [ServiceFeedbackController::class, 'create'])->name('serviceFeedbacks.create'); // Create form (user side)





// <!--==========================================  (Pets)  =====================================================-->
Route::resource('pets', PetController::class)->middleware(['auth' , 'role']);
Route::get('/pet_adoption',[PetController::class, 'index_user_side'])->name("pet_adoption");//view all the pets in the user side
Route::get('/pet_details/{id}', [PetController::class, 'show_user_side'])->name('pet_details');



// <!--==========================================  (Contacts)  =====================================================-->
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index'); // List all contacts (dashboard)
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show'); // Show
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy'); // Delete
});
// Public routes
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create'); // Create form (user side)
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store'); // Create


Route::get('/contact', function () {
    return view('contact');
})->name("contact");





// <!--==========================================  (Testimonials)  =====================================================-->
// Protected routes
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index'); // List all testimonials (dashboard)
    Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show'); // Show
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy'); // Delete
});

// Public routes
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store'); // Create
Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create'); // Create form (user side)



// <!--==========================================  (About us page)  =====================================================-->
Route::get('/about_us', function () {
    return view('about_us');
})->name("about_us");



// <!--==========================================  (Cart)  =====================================================-->
Route::get('/cart', function () {
    return view('cart');
})->name("cart");








