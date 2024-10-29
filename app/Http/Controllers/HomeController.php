<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\Product;
use App\Models\Pet;
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
        $this->middleware('auth');
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

        return view('landing_page' , ['services'=> $services , 'serviceImages'=> $serviceImages ,'products'=> $products , 'pets'=> $pets]);
    }

    public function show(string $id)
    {
        dd($id);
        $product = Product::findOrFail($id);
        return view('landing_page' , ['product'=>$product]);
    }
}
