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
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|string',
            
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/product/');
            $file->move($path, $filename);
        }

        Product::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$filename,
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
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|string',
            
        ]);

        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/product/');
            $file->move($path, $filename);
        } else {
            $filename = $product->image; 
        }

        $product->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$filename,
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
