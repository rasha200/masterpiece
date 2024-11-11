<?php

namespace App\Http\Controllers;

use App\Models\ProductVariation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $productVariations = ProductVariation::where('product_id', $product_id)->get(); 
        $product = Product::findOrFail($product_id);

        return view('dashboard.product_variations.index' , [
            'productVariations'=> $productVariations,
            'product_name' => $product->name,
            'product_id' => $product,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($product_id)
    { 
        $product = Product::findOrFail($product_id);
        return view('dashboard.product_variations.create', [
            'product_name' => $product->name,
             'product'=> $product
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $validation = $request->validate([
        'size' => 'nullable|string',
        'color' => 'nullable|string', 
        'flavour' => 'nullable|string',
        'age_group' => 'nullable|string',
        'disinfected' => 'nullable|string',
        'price' => 'required',
        'quantity' => 'required|integer',
    ]);

    
    $color = $request->input('color');

    
    if (empty($color) || $color === '#000000') {
        $color = null;
    }

    
    ProductVariation::create([
        'size' => $request->input('size'),
        'color' => $color, 
        'flavour' => $request->input('flavour'),
        'age_group' => $request->input('age_group'),
        'disinfected' => $request->input('disinfected'),
        'price' => $request->input('price'),
        'quantity' => $request->input('quantity'),
        'product_id' => $request->input('product_id'),
    ]);

    return to_route('productVariations.index', ['product_id' => $request->input('product_id')])
        ->with('success', 'Product variant created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(ProductVariation $productVariation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product_id, ProductVariation $productVariation)
    {

        $product = Product::findOrFail($product_id);
        return view('dashboard.product_variations.edit', [
            'productVariation'=> $productVariation,
            'product_name' => $product->name,
            'product' => $product,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariation $productVariation)
    {
       
    $validation = $request->validate([
        'size' => 'nullable|string',
        'color' => 'nullable|string', 
        'flavour' => 'nullable|string',
        'age_group' => 'nullable|string',
        'disinfected' => 'nullable|string',
        'price' => 'required',
        'quantity' => 'required|integer',
    ]);

    
    $color = $request->input('color');

   
    if (empty($color) || $color === '#000000') {
        $color = null;
    }

   
    $productVariation->update([
        'size' => $request->input('size'),
        'color' => $color, 
        'flavour' => $request->input('flavour'),
        'age_group' => $request->input('age_group'),
        'disinfected' => $request->input('disinfected'),
        'price' => $request->input('price'),
        'quantity' => $request->input('quantity'),
        'product_id' => $request->input('product_id'),
    ]);

    return to_route('productVariations.index', ['product_id' => $request->input('product_id')])
        ->with('success', 'Product variant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product, ProductVariation $productVariation)
    {
        $productVariation->delete();

        $product_id = $productVariation->product_id; 

        return to_route('productVariations.index', ['product_id' => $product_id])->with('success', 'Product variant deleted');
    }
}
