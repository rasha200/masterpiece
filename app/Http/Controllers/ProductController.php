<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('product_images')->get();

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
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        ]);

        $product = Product::create([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'quantity'=>$request->input('quantity'),
            'category_id'=>$request->input('category_id'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/productImages/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/productImages/' . $filename,
                    'product_id'=> $product->id, 
                ];
            }
    
            
            ProductImage::insert($images);
        }

       

        return to_route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productImages = $product->product_images; 
        return view('dashboard.products.show' , ['product'=> $product,'productImages'=>$productImages]);
    }




    public function show_user_side( $id)
    {
        $product = Product::findOrFail($id); 
        $productImages = $product->product_images; 
        $productfeedbacks = $product->product_feedbacks; 
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->inRandomOrder() // Randomize order
        ->take(8) // Limit the number of related products displayed
        ->get();

        return view('product_details' , [
            'product'=> $product,
            'productfeedbacks'=> $productfeedbacks,
            'relatedProducts' => $relatedProducts,
            'productImages'=>$productImages,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories= category::all();
        $productImages = $product->product_images;
        return view ('dashboard.products.edit',[
            'product'=>$product ,
            'categories'=>$categories,
            'productImages'=>$productImages,
        ]);
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
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        ]);

    

        $product->update([
            'name'=>$request->input('name'),
            'small_description'=>$request->input('small_description'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'quantity'=>$request->input('quantity'),
            'category_id'=>$request->input('category_id'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/productImages/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/productImages/' . $filename,
                    'product_id'=> $product->id, 
                ];
            }
    
            
            ProductImage::insert($images);
        }

       

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
