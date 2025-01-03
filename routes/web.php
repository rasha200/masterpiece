<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetImageController;
use App\Http\Controllers\ToAdouptController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceImageController;
use App\Http\Controllers\AvailabilityTimeController;
use App\Http\Controllers\ServiceFeedbackController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\ProductFeedbackController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChartController;




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




// <!--==========================================  (HOME)  ========================================================================================================================-->
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);
Route::get('/home/{id}', [HomeController::class, 'show'])->name('landing_single_product'); //for the product modal in the landing page




// <!--==========================================  (Dashboard)  ============================================================================================================================-->
Route::get('/dashboard', function () {
    return view('layouts.dashboard_master');
})->name('dashboard')->middleware(['auth' , 'role']);




// <!--==========================================  (Chart)  ============================================================================================================================-->

Route::get('/chart', [ChartController::class, 'chart'])->name('chart')->middleware(['auth' , 'role']);


// <!--==========================================  (Search)  ========================================================================================================================-->
Route::get('/search', [SearchController::class, 'search'])->name('search');







// <!--==========================================  (Users)  ===============================================================================================================-->
Route::resource('users', UserController::class)->middleware(['auth' , 'role']);
Route::get('/user/trash', [UserController::class, 'trash'])->name('users.trash')->middleware(['auth' , 'role']);
Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore')->middleware(['auth' , 'role']);




// <!--==========================================  (Profile)  ===============================================================================================================-->
Route::get('/profile', [UserController::class, 'show_profile'])->name('profile.show');
Route::get('/profile_dashboard', [UserController::class, 'show_profile_dash'])->name('profile_dash.show')->middleware(['auth' , 'role']);
Route::put('/profile', [UserController::class, 'update_profile'])->name('profile.update');



// <!--==========================================  (Categories)  =================================================================================================================-->
Route::resource('categories', CategoryController::class)->middleware(['auth' , 'role' ,'store']);



// <!--==========================================  (Products)  ===================================================================================================================-->
Route::resource('products', ProductController::class)->middleware(['auth' , 'role', 'store']);
Route::delete('/product_images/{product_image}', [productImageController::class, 'destroy'])->name('product_images.destroy')->middleware(['auth' , 'role']);
Route::get('/product_details/{id}',[ProductController::class, 'show_user_side'])->name("product_details");



// <!--==========================================  (Product Variation)  ===================================================================================================================-->
// Protected routes
Route::middleware(['auth', 'role','store'])->group(function () {
    Route::get('/productVariations/{product_id}', [ProductVariationController::class, 'index'])->name('productVariations.index'); 
    Route::get('/productVariations/{product_id}/create', [ProductVariationController::class, 'create'])->name('productVariations.create'); 
    Route::post('/productVariations', [ProductVariationController::class, 'store'])->name('productVariations.store'); 
    Route::get('/productVariations/{product_id}/{productVariation}/edit', [ProductVariationController::class, 'edit'])->name('productVariations.edit'); 
    Route::put('/productVariations/{productVariation}', [ProductVariationController::class, 'update'])->name('productVariations.update'); 
    Route::delete('/productVariations/{product_id}/{productVariation}', [ProductVariationController::class, 'destroy'])->name('productVariations.destroy'); 
});

Route::get('/productVariations/{product_id}/{productVariation}', [ProductVariationController::class, 'show'])->name('productVariations.show'); 




// <!--==========================================  (orders)  ==================================================================================================================-->
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/orderProducts', [OrderProductController::class, 'index'])->name('orderProducts.index'); // List all orderProducts (dashboard)
    Route::get('/orderProducts/{orderProduct}', [OrderProductController::class, 'show'])->name('orderProducts.show'); // Show
});
// Public routes
Route::get('/orderProducts/create/{pet_id}', [OrderProductController::class, 'create'])->name('orderProducts.create'); // Create form (user side)
Route::post('/orderProducts', [OrderProductController::class, 'store'])->name('orderProducts.store'); // Create



// <!--==========================================  (Product feedback)  ============================================================================================================-->
// Protected routes
Route::middleware(['auth', 'role','store'])->group(function () {
    Route::get('/productFeedbacks/{product_id}', [ProductFeedbackController::class, 'index'])->name('productFeedbacks.index'); // List all productFeedbacks (dashboard)
    Route::get('/productFeedbacks/{product_id}/{productFeedback}', [ProductFeedbackController::class, 'show'])->name('productFeedbacks.show'); // Show
});
// Public routes
Route::post('/productFeedbacks', [ProductFeedbackController::class, 'store'])->name('productFeedbacks.store'); // Create
Route::get('/productFeedbacks/create', [ProductFeedbackController::class, 'create'])->name('productFeedbacks.create'); // Create form (user side)
Route::get('/productFeedbacks/{productFeedback}/edit', [ProductFeedbackController::class, 'edit'])->name('productFeedbacks.edit'); // Edit form
Route::put('/productFeedbacks/{productFeedback}', [ProductFeedbackController::class, 'update'])->name('productFeedbacks.update'); // Update feedback
Route::delete('/productFeedbacks/{productFeedback}', [ProductFeedbackController::class, 'destroy'])->name('productFeedbacks.destroy'); // Delete



// <!--=================================================  (Store)  =====================================================================================================================================-->
Route::get('/store',[StoreController::class, 'index'])->name("store");
Route::get('/store/{id}',[StoreController::class, 'show'])->name("single_product");



// <!--=================================================  (WishList)  =====================================================================================================================================-->
Route::resource('wishLists', WishListController::class);




// <!--=================================================  (Cart)  =====================================================================================================================================-->
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'store'])->name('cart.store');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('cart/delete/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');





// <!--==========================================  (Services)  =================================================================================================================-->
Route::resource('services', ServiceController::class)->middleware(['auth' , 'role']);
Route::delete('/service_images/{service_image}', [ServiceImageController::class, 'destroy'])->name('service_images.destroy')->middleware(['auth' , 'role']);
Route::get('/service',[ServiceController::class, 'index_user_side'])->name("services"); //view the services in the user side
Route::get('/service_details/{id}', [ServiceController::class, 'show_user_side'])->name('service_details'); // single page for each service in use side



// <!--==========================================  (Service availability times)  ====================================================================================================================-->

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/availabilityTimes/{service_id}', [AvailabilityTimeController::class, 'index'])->name('availabilityTimes.index'); 
    Route::get('/availabilityTimes/{service_id}/create', [AvailabilityTimeController::class, 'create'])->name('availabilityTimes.create');
    Route::post('/availabilityTimes', [AvailabilityTimeController::class, 'store'])->name('availabilityTimes.store');  
    Route::get('/availabilityTimes/{service_id}/{availabilityTime}', [AvailabilityTimeController::class, 'edit'])->name('availabilityTimes.edit');
    Route::put('/availabilityTimes/{availabilityTime}', [AvailabilityTimeController::class, 'update'])->name('availabilityTimes.update'); 
    Route::delete('/availabilityTimes/{service_id}/{availabilityTime}', [AvailabilityTimeController::class, 'destroy'])->name('availabilityTimes.destroy'); 
});







// <!--==========================================  (Service feedback)  ====================================================================================================================-->
// Protected routes
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/serviceFeedbacks/{service_id}', [ServiceFeedbackController::class, 'index'])->name('serviceFeedbacks.index'); // List all serviceFeedbacks (dashboard)
    Route::get('/serviceFeedbacks/{service_id}/{serviceFeedback}', [ServiceFeedbackController::class, 'show'])->name('serviceFeedbacks.show'); // Show
});
// Public routes
Route::post('/serviceFeedbacks', [ServiceFeedbackController::class, 'store'])->name('serviceFeedbacks.store'); // Create
Route::get('/serviceFeedbacks/create', [ServiceFeedbackController::class, 'create'])->name('serviceFeedbacks.create'); // Create form (user side)
Route::put('/serviceFeedbacks/{serviceFeedback}', [ServiceFeedbackController::class, 'update'])->name('serviceFeedbacks.update'); // Update feedback
Route::delete('/serviceFeedbacks/{serviceFeedback}', [ServiceFeedbackController::class, 'destroy'])->name('serviceFeedbacks.destroy'); // Delete




// <!--==========================================  (Appointment)  ====================================================================================================================-->
Route::middleware(['auth', 'role', 'appointment'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index'); 
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show'); 
});
// Public routes
Route::get('/checkAvailability/{id}', [AppointmentController::class, 'checkAvailability'])->name('checkAvailability'); 
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store'); 
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update'); 
Route::put('/Appointments/{appointment}', [AppointmentController::class, 'update_userside'])->name('appointments_user.update'); 
Route::get('/veterinarian_schedule', [AppointmentController::class, 'veterinarian_schedule'])->name('veterinarian_schedule')->middleware(['auth' , 'veterinarian_schedule']); 



// <!--==========================================  (Pets)  ===================================================================================================================-->
Route::resource('pets', PetController::class)->middleware(['auth' , 'role']);
Route::delete('/pet_images/{pet_image}', [PetImageController::class, 'destroy'])->name('pet_images.destroy')->middleware(['auth' , 'role']);
Route::get('/pet_adoption',[PetController::class, 'index_user_side'])->name("pet_adoption");//view all the pets in the user side
Route::get('/pet_details/{id}', [PetController::class, 'show_user_side'])->name('pet_details');





// <!--==========================================  (toAdoupt)  ==================================================================================================================-->

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/toAdoupts', [toAdouptController::class, 'index'])->name('toAdoupts.index'); // List all toAdoupts (dashboard)
    Route::get('/toAdoupts/{toAdoupt}', [toAdouptController::class, 'show'])->name('toAdoupts.show'); // Show
});
// Public routes
Route::get('/toAdoupts/create/{pet_id}', [toAdouptController::class, 'create'])->name('toAdoupts.create'); // Create form (user side)
Route::post('/toAdoupts', [toAdouptController::class, 'store'])->name('toAdoupts.store'); // Create
Route::put('/toAdoupts/{toAdoupt}', [toAdouptController::class, 'update'])->name('toAdoupts.update'); // Update
Route::put('/toadoupts/{toadoupt}', [toAdouptController::class, 'update_userside'])->name('toAdoupts_user.update'); // Update 






// <!--==========================================  (Contacts)  ==================================================================================================================-->
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





// <!--==========================================  (Testimonials)  ==================================================================================================================-->
// Protected routes
Route::middleware(['auth', 'role','not_veterinarian'])->group(function () {
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index'); // List all testimonials (dashboard)
    Route::get('/testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show'); // Show
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy'); // Delete
});

// Public routes
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store'); // Create
Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create'); // Create form (user side)



// <!--==========================================  (About us page)  ==================================================================================================================-->
Route::get('/about_us', function () {
    return view('about_us');
})->name("about_us");












