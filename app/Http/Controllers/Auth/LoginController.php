<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {

        if (session()->has('from_testimonial')) {
            // Remove the session variable after use
            session()->forget('from_testimonial');
            
            // Redirect to the contact page
            return route('contact');
        }

        if (session()->has('from_serviceFeedback')) {
            // Get the service ID from the session
            $serviceId = session('service_id');
    
            // Remove the session variable after use
            session()->forget('from_serviceFeedback');
            session()->forget('service_id'); // Remove service ID after use
    
            // Redirect to the service_details page with the service ID
            return route('service_details', ['id' => $serviceId]);
        }

        if (session()->has('from_productFeedback')) {
            // Get the product ID from the session
            $productId = session('product_id');
    
            // Remove the session variable after use
            session()->forget('from_productFeedback');
            session()->forget('product_id'); // Remove product ID after use
    
            // Redirect to the product_details page with the product ID
            return route('product_details', ['id' => $productId]);
        }

        if (session()->has('from_adoption')) {
            // Get the pet ID from the session
            $pet_id = session('pet_id');
    
            // Remove the session variable after use
            session()->forget('from_adoption');
            session()->forget('pet_id'); // Remove pet ID after use
    
            // Redirect to the toAdoupts page with the pet ID
            return route('toAdoupts.create', ['pet_id' => $pet_id]);
        }

        if (session()->has('from_appointment')) {
            // Get the service ID from the session
            $serviceId = session('service_id');
    
            // Remove the session variable after use
            session()->forget('from_appointment');
            session()->forget('service_id'); // Remove service ID after use
    
            // Redirect to the service_details page with the service ID
            return route('service_details', ['id' => $serviceId]);
        }


    
    if (Auth::user()->role == 'receptionist' || Auth::user()->role == 'veterinarian' || Auth::user()->role == 'manager') {
    return '/dashboard';
    } else {
    return '/';
    }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
