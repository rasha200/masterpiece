<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class WishlistComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();  // Get the authenticated user
        if ($user) {
            $wishlistCount = $user->wishList()->count();  // Get the count of wishlist items
        } else {
            $wishlistCount = 0;
        }

        // Pass the data to the view
        $view->with('wishlistCount', $wishlistCount);
    }
}
