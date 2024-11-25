<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductImage;



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
                $variation = ProductVariation::with('product.product_images')->find($cartItem['variation_id']);
                if ($variation) {
                    // Check if product has images
                    $productImage = $variation->product->product_images->first();
                    $imageUrl = $productImage ? asset($productImage->image) : asset('images/default-product.jpg'); // Fallback if no image
    
                    $cartDetails[] = [
                        'id' => $variation->product->id,
                        'name' => $variation->product->name,
                        'variation' => $this->getVariationDescription($variation), // Get variation details
                        'price' => $variation->price,
                        'image' => $imageUrl,
                        'quantity' => $cartItem['quantity'],
                        'total' => $variation->price * $cartItem['quantity'],
                    ];
                }
            } else {
                // Fetch product details
                $product = Product::with('product_images')->find($cartItem['product_id']);
                if ($product) {
                    // Check if product has images
                    $productImage = $product->product_images->first();
                    $imageUrl = $productImage ? asset($productImage->image) : asset('images/default-product.jpg'); // Fallback if no image
    
                    $cartDetails[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $imageUrl,
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

        if ($variation->color) {
            $description .= '<span class="color-circle" style="background-color: ' . $variation->color . ';"></span>';
        }
        if ($variation->size) {
            $description .=  $variation->size . ', ';
        }
       
        if ($variation->flavour) {
            $description .= $variation->flavour . ', ';
        }
        if ($variation->age_group) {
            $description .=  $variation->age_group . ', ';
        }
        if ($variation->disinfected) {
            $description .=  $variation->disinfected;
        }
    
        // Remove trailing comma and space
        return rtrim($description, ', ');
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
            'price' => 'nullable|numeric',
            'quantity' => 'required|integer|min:1',
        ];
    
        // If the product has variations, make variation_id required
        if ($product->product_variation->count() > 0) {
            $validationRules['variation_id'] = 'required|integer';
        }
    
        // Validate the request
        $request->validate($validationRules);
    
        // Retrieve the cart from cookies or initialize an empty cart
        $cart = json_decode(Cookie::get('cart', json_encode([])), true);
    
        // Create a unique identifier for the product and variation (based on both product and variation)
        $cartItemKey = $request->product_id;
    
        // Prepare the cart item data
        $cartItem = [
            'product_id' => $request->product_id,
            'variation_id' => $request->variation_id ?? null, // Only add variation_id if it's selected
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ];
    
        // Check if the item already exists in the cart
        if (isset($cart[$cartItemKey])) {
            // If the same variation is added again, increase the quantity
            $cart[$cartItemKey]['quantity'] += $cartItem['quantity'];
        } else {
            // If the item is new or different variation, add it to the cart
            $cart[$cartItemKey] = $cartItem;
        }
    
        // Save the updated cart to a cookie for 1 week
        return redirect()->back()->with('success', 'Product added to cart successfully!')
            ->cookie('cart', json_encode($cart), 60 * 24 * 7); // Cookie for 1 week
    }


      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the cart data from the cookie
        $cart = json_decode(Cookie::get('cart', json_encode([])), true);

        // Check if the product exists in the cart
        if (isset($cart[$id])) {
            // Update the quantity of the product
            $cart[$id]['quantity'] = $request->quantity;

            // Save the updated cart back to the cookie
            return redirect()->back()->with('success', 'Cart updated successfully!')
                ->cookie('cart', json_encode($cart), 60 * 24 * 7); // Set cookie for 1 week
        } else {
            return redirect()->back()->with('error', 'Product not found in cart.');
        }
    }
    


    public function deleteCartItem($productId)
    {
        $cart = json_decode(Cookie::get('cart', json_encode([])), true);

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Remove item from cart
        }

        return redirect()->back()->with('success', 'Item removed from cart successfully!')
            ->cookie('cart', json_encode($cart), 60 * 24 * 7);
    }
    


    public function clear()
    {
        // Set the cart cookie to an empty array
        Cookie::queue(Cookie::forget('cart'));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
    
    
    

    
  

   
}
