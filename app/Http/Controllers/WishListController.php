<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistItems = WishList::with('product')->where('user_id', auth()->id())->get();
        return view('wishlist', ['wishlistItems'=> $wishlistItems]);
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

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the service feedback form
            session(['from_wishlist' => true, 'product_id' => $request->input('product_id')]);
        
            // Redirect back with the error message and input data
            return redirect()->back()->with('error', 'Please log in to add to the wishlist.')->withInput();
        }
        

    $user = auth()->user();

    // Check if the product is already in the wishlist
    $existingWishlist = Wishlist::where('user_id', $user->id)
                                 ->where('product_id', $request->product_id)
                                 ->first();

    // If the product isn't in the wishlist, add it
    if (!$existingWishlist) {
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);
    } else {
        // If the product is already in the wishlist, remove it
        $existingWishlist->delete();
    }

    return redirect()->back();
     }


   
  

    /**
     * Display the specified resource.
     */
    public function show(WishList $wishList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WishList $wishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WishList $wishList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishList $wishList)
    {
        
    }
}
