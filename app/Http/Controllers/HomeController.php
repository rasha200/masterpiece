<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\Product;
use App\Models\Pet;
use App\Models\Testimonial;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the 'auth' middleware to all methods except 'index' and 'show'
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $services = Service::all(); 
        $products = Product::all();
        $latestProduct = Product::latest()->take(12)->get();
        $pets = Pet::all();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        foreach ($products as $product) {
            // Assuming 'product_feedbacks' is the relationship name for feedbacks on products
            $product->averageRating = $product->product_feedbacks()->avg('rating') ?? 0;
        }
        foreach ($latestProduct as $product) {
            // Assuming 'product_feedbacks' is the relationship name for feedbacks on products
            $product->averageRating = $product->product_feedbacks()->avg('rating') ?? 0;
        }
        return view('landing_page' , [
            'services'=> $services ,
            'products'=> $products , 
            'pets'=> $pets,
            'testimonials'=> $testimonials,
            'latestProduct' => $latestProduct
        ]);
    }

    public function show(string $id)
    {
       
                                                                                                                                        
        return view('landing_page' , ['product'=>$product]);
    }

    public function count_wishlist_layout(string $id)
    {
       $wishlistCount = Auth::check() ? Auth::user()->wishLists()->count() : 0;

                                                                                                                                        
        return view('layouts.user_side_master' , ['wishlistCount'=>$wishlistCount]);
    }

   
    
}
