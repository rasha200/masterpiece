<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('dashboard.products.index' , ['products'=> $products]);
    }

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= category::all();
        return view ('dashboard.products.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|string',
        ]);

        Product::create([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'quantity'=>$request->input('quantity'),
            'category_id'=>$request->input('category_id'),
            
        ]);

       

        return to_route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show' , ['product'=> $product]);
    }




    public function show_user_side( $id)
    {
        $product = Product::findOrFail($id); 
        // $serviceImages = $service->service_images; 
        $productfeedbacks = $product->product_feedbacks; 
        return view('product_details' , ['product'=> $product,'productfeedbacks'=> $productfeedbacks]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories= category::all();
        return view ('dashboard.products.edit',['product'=>$product ,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|string',
            
        ]);

    

        $product->update([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'quantity'=>$request->input('quantity'),
            'category_id'=>$request->input('category_id'),
        ]);

       

        return to_route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete(); 
        
        return to_route('products.index')->with('success', 'Product deleted');
    }
}
