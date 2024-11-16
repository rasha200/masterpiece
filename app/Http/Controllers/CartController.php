<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Models\ProductVariation;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get cart items from the cookie, default to an empty array if not set
        $cartItems = json_decode(Cookie::get('cart', json_encode([])), true); // json_decode: Converts the JSON string into a PHP array
    
        // Initialize an array to store cart details
        $cartDetails = [];
    
        foreach ($cartItems as $cartItem) {
            if (isset($cartItem['variation_id'])) {
                // Fetch product variation details
                $variation = ProductVariation::with('product')->find($cartItem['variation_id']);
                if ($variation) {
                    $cartDetails[] = [
                        'id' => $variation->product->id,
                        'name' => $variation->product->name,
                        'variation' => $this->getVariationDescription($variation), // Get variation details
                        'price' => $variation->price,
                        'quantity' => $cartItem['quantity'],
                        'total' => $variation->price * $cartItem['quantity'],
                    ];
                }
            } else {
                // Fetch product details
                $product = Product::find($cartItem['product_id']);
                if ($product) {
                    $cartDetails[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $cartItem['quantity'],
                        'total' => $product->price * $cartItem['quantity'],
                    ];
                }
            }
        }

       
    
        return view('cart', compact('cartDetails'));
    }
    
    /**
     * Generate a description for the product variation.
     */
    private function getVariationDescription(ProductVariation $variation)
    {
        $description = '';
    
        if ($variation->size) {
            $description .= 'Size: ' . $variation->size . ', ';
        }
        if ($variation->color) {
            $description .= 'Color: ' . $variation->color . ', ';
        }
        if ($variation->flavour) {
            $description .= 'Flavour: ' . $variation->flavour . ', ';
        }
        if ($variation->age_group) {
            $description .= 'Age Group: ' . $variation->age_group . ', ';
        }
        if ($variation->disinfected) {
            $description .= 'Disinfected: ' . $variation->disinfected;
        }
    
        // Remove trailing comma and space
        return rtrim($description, ', ');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Fetch the product from the database with its variations
    $product = Product::with('product_variation')->findOrFail($request->product_id);

    // Conditional validation for variation_id
    $validationRules = [
        'product_id' => 'required|integer',
        'name' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
    ];

    // If the product has variations, make variation_id required
    if ($product->product_variation->count() > 0) {
        $validationRules['variation_id'] = 'required|integer';
    }

    // Validate the request
    $request->validate($validationRules);

    // If the product has variations, ensure variation_id is provided and valid
    if ($product->product_variation->count() > 0) {
        // Ensure variation_id is selected and valid
        if (!$request->variation_id) {
            return redirect()->back()->with('error', 'Please choose a variation before adding the product to the cart.');
        }

        // Validate that the selected variation exists
        $variation = $product->product_variation->find($request->variation_id);
        if (!$variation) {
            return redirect()->back()->with('error', 'Invalid variation selected.');
        }
    }

    // Retrieve the cart from cookies or initialize an empty cart
    $cart = json_decode(Cookie::get('cart', json_encode([])), true);

    // Create a unique identifier for the product and variation (if any)
    $cartItemKey = $request->product_id . '-' . ($request->variation_id ?? 'no-variation');

    // Prepare the cart item
    $cartItem = [
        'product_id' => $request->product_id,
        'variation_id' => $request->variation_id ?? null,  // Only add variation_id if it's selected
        'name' => $request->name,
        'price' => $request->price,  // Use the selected price
        'quantity' => $request->quantity,
    ];

    // Check if the item already exists in the cart
    if (isset($cart[$cartItemKey])) {
        $cart[$cartItemKey]['quantity'] += $cartItem['quantity'];
    } else {
        $cart[$cartItemKey] = $cartItem;
    }

    // Save the updated cart to a cookie for 1 week
    return redirect()->back()->with('success', 'Product added to cart successfully!')
        ->cookie('cart', json_encode($cart), 60 * 24 * 7); // Cookie for 1 week
}

    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
