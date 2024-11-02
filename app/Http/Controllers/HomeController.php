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
        $serviceImages = ServiceImage::all(); 
        $products = Product::all();
        $pets = Pet::all();
        $testimonials = Testimonial::all();


        return view('landing_page' , [
            'services'=> $services ,
            'serviceImages'=> $serviceImages ,
            'products'=> $products , 
            'pets'=> $pets,
            'testimonials'=> $testimonials
        ]);
    }

    public function show(string $id)
    {
        dd($id);
                                                                                                                                        
        return view('landing_page' , ['product'=>$product]);
    }
}
