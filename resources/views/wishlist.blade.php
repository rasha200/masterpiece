@extends('layouts.user_side_master')

@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="bread-crumb flex-w  p-r-15 p-t-30 p-lr-0-lg">
        <span class="stext-109 cl4">
            @if (Auth::check())
            {{ Auth::user()->Fname }} {{ Auth::user()->Lname }}
        @else
            
            Guest
        @endif
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </span>

        <span class="stext-109 cl4">
          Your wishlist
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </span>
    </div>
</div>
<section class="sec-product bg0 p-t-40 p-b-50" style="margin-right: 100px; margin-left: 100px;" >
    <div class="container">
        <h3 class="mb-4 text-center">Your Wishlist</h3>
        
        <!-- Wishlist Cards -->
        <div class="row">
            @forelse ($wishlistItems as $item)
                <div class="col-12 mb-4"> <!-- One item per row -->
                    <div class="wishlist-card p-4 border rounded shadow">
                        <div class="row align-items-center">
                            <!-- Product Image -->
                            <div class="col-md-2">
                                <img src="{{ asset($item->product->product_images->isNotEmpty() ? $item->product->product_images[0]->image : 'images/no-image.png') }}" alt="Product Image" class="img-fluid" style=" width: 80px; height: 80px;">
                            </div>
                            
                            <!-- Product Details -->
                            <div class="col-md-8">
                                <a href="{{ route('product_details', $item->product->id) }}" class="mtext-85 cl2 js-name-detail p-b-14">{{ $item->product->name }}</a>
                                <p class="text-muted">{{ $item->product->small_description }}</p>
                            </div>

                            <div class="col-md-1 " style="margin-top: 20px;">
                                <p class="mtext-85 cl2 js-name-detail p-b-14">${{ $item->product->price }}</p>

                            </div>



                                                    
                            <!-- Delete Icon (Positioned to the right) -->
                            <div class="col-md-1 " style="margin-top: 2px;">
                                <form action="{{ route('wishLists.store') }}" method="POST">
                                    @csrf
                                    
                                    <input type="hidden" name="product_id" value="{{  $item->product->id }}">
                                    <button type="submit" class="delete-wishlist-item dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" title="remove from wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center w-100">Your wishlist is empty.</p>
              
            @endforelse
        </div>
    </div>
</section>

@endsection
