@extends('layouts.user_side_master')

@section('content')

<!-- breadcrumb -->
<div class="container" style="margin-top: 50px;">
    <div class="bread-crumb flex-w  p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
           Store
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            {{ $product->category->name }}
             <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
         </a>

        <span class="stext-109 cl4">
            {{ $product->name }}
        </span>
    </div>
</div>
    

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">


                            @foreach ($productImages as $productImage)
                            <div class="item-slick3" data-thumb="{{ asset($productImage->image) }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset($productImage->image) }}" alt="Pet images" style="height: 500px; object-fit: cover; width: 100%;">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($productImage->image) }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                    @endforeach


                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $product->name }}
                    </h4>

                    <span class="mtext-106 cl2">
                        ${{ $product->price }}
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        {{ $product->small_description }}
                    </p>
                    
                    <!--  -->
                    <div class="p-t-33">

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Add to cart
                                </button>
                            </div>
                        </div>	
                    </div>

                    <!--  -->

                    @if (Auth::check())
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <form action="{{ route('wishLists.store') }}" method="POST" id="wishlist-form-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist" id="add-to-wishlist-{{ $product->id }}">
                                    <i class="zmdi zmdi-favorite-outline" id="heart-icon-{{ $product->id }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{ count($productfeedbacks) }})</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#add_review" role="tab">Add Review</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">

            <!-------------------- Description ---------------------->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{ $product->description }}

                            </p>
                        </div>
                    </div>

            <!--------------------- Reviews ------------------------->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            @foreach ($productfeedbacks as $productfeedback)
                            <div class="flex-w flex-t p-b-68">
                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                    <img src="{{asset('images/user 2.webp')}}" alt="AVATAR">
                                </div>
        
                                <div class="size-207">
                                    <div class="flex-w flex-sb-m p-b-17">
                                        <span class="mtext-107 cl2 p-r-20">
                                            {{$productfeedback->feedback}}
                                        </span>

                                       
        
                                        <span class="fs-18 cl11">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="zmdi {{ $i <= $productfeedback->rating ? 'zmdi-star' : 'zmdi-star-outline' }}"></i>
                                            @endfor
                                        </span>
        
                                    </div>
        
                                    <p class="stext-102 cl6">
                                        {{ optional($productfeedback->user)->Fname ?? 'Unknown User' }} {{ optional($productfeedback->user)->Lname ?? '' }}
                                    </p>
        
                                    <p class="stext-102 cl6">
                                        {{$productfeedback->created_at->format('Y-m-d')}}
                                    </p>


                                    @if(Auth::id() === $productfeedback->user_id)
                    <!-- Edit Icon -->
                    <a href="javascript:void(0);" onclick="toggleEditForm({{ $productfeedback->id }})" class="edit-icon">
                        <button style="border:solid 1px #14535F; background-color:#14535F;" title="Edit">
                            <i class="item-rating pointer zmdi zmdi-edit" style="padding: 3px; color:#FFF;"></i>
                        </button>
                    </a>

                    <!-- Edit Form (initially hidden) -->
                    <div id="edit-form-{{ $productfeedback->id }}" style="display: none; margin-top: 10px;">
                        <form action="{{ route('productFeedbacks.update', $productfeedback->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                         
                            
                            <div class="flex-w flex-m p-t-50 p-b-23">
                                <span class="stext-102 cl3 m-r-16">
                                    Your Rating *
                                </span>
        
                                <span class="wrap-rating fs-18 cl11 pointer">
                                    <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(1)"></i>
                                    <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(2)"></i>
                                    <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(3)"></i>
                                    <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(4)"></i>
                                    <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(5)"></i>
                                    <input class="dis-none" type="hidden" name="rating" id="rating" value="" required>
                                </span>
                            </div>
                            <script>
                                function setRating(rating) {
                                    document.getElementById('rating').value = rating;
                                    // Update star visuals based on selected rating
                                    const stars = document.querySelectorAll('.item-rating');
                                    stars.forEach((star, index) => {
                                        if (index < rating) {
                                            star.classList.add('zmdi-star'); // Filled star class
                                            star.classList.remove('zmdi-star-outline'); // Outline star class
                                        } else {
                                            star.classList.add('zmdi-star-outline');
                                            star.classList.remove('zmdi-star');
                                        }
                                    });
                                }
                            </script>
                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="feedback" placeholder="Your feedback" value="{{ $productfeedback->feedback }}" required>
                            </div>
                            <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
                            <input type="hidden" value="{{ $product->id }}" name="product_id">

                            <button type="submit" class="btn btn-primary mt-2" style="background-color: #14535F">Save</button>
                            <button type="button" class="btn btn-secondary mt-2" onclick="toggleEditForm({{ $productfeedback->id }})">Cancel</button>
                        </form>
                    </div>
                    @endif

                                </div>
                            </div>
                            @endforeach


                            
                        </div>
                    </div>

                    <script>
                        function toggleEditForm(feedbackId) {
                            const editForm = document.getElementById(`edit-form-${feedbackId}`);
                            if (editForm.style.display === 'none') {
                                editForm.style.display = 'block';
                            } else {
                                editForm.style.display = 'none';
                            }
                        }
                    </script>


            <!------------------ Success & error modal ----------------->
            @if (Session::get('success'))

            <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
                <div class="swal-modal">
                    <div class="swal-icon swal-icon--success">
                        <span class="swal-icon--success__line swal-icon--success__line--long"></span>
                        <span class="swal-icon--success__line swal-icon--success__line--tip"></span>
                        <div class="swal-icon--success__ring"></div>
                        <div class="swal-icon--success__hide-corners"></div>
                    </div>
            
                    <div class="swal-title" style="">{{ Session::get('success') }}</div>
            
                    <div class="swal-footer">
                        <div class="swal-button-container">
                            <a href="{{ route('product_details', ['id' => $product->id]) }}" class="swal-button swal-button--confirm">OK</a>
                            <div class="swal-button__loader">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @elseif (Session::get('error'))
             <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
                <div class="swal-modal">
                    <div class="swal-icon swal-icon--error">
                        <div class="swal-icon--error__x-mark">
                            <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                            <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                        </div>
                    </div>
                    
            
                    <div class="swal-title" style="">{{ Session::get('error') }}</div>
            
                    <div class="swal-footer">
                        <div class="swal-button-container">
                            <a href="{{ route('login') }}" class="swal-button swal-button--confirm">Login</a>
                            <div class="swal-button__loader">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif   


                 <!----------- Add review ------------->
                 <div class="tab-pane fade" id="add_review" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                            <div class="p-b-30 m-lr-15-sm">
                               
                                <form class="w-full" action="{{ route('productFeedbacks.store') }}" method="POST">
                                    @csrf
                                    <h5 class="mtext-108 cl2 p-b-7">
                                        Add a review
                                    </h5>
    
                                    <p class="stext-102 cl6">
                                        Your email address will not be published. Required fields are marked *
                                    </p>
    
                                    <div class="flex-w flex-m p-t-50 p-b-23">
                                        <span class="stext-102 cl3 m-r-16">
                                            Your Rating *
                                        </span>
    
                                        <span class="wrap-rating fs-18 cl11 pointer">
                                            <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(1)"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(2)"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(3)"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(4)"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(5)"></i>
                                            <input class="dis-none" type="hidden" name="rating" id="rating" value="" required>
                                        </span>
                                    </div>
    
                                    <script>
                                        function setRating(rating) {
                                            document.getElementById('rating').value = rating;
                                            // Update star visuals based on selected rating
                                            const stars = document.querySelectorAll('.item-rating');
                                            stars.forEach((star, index) => {
                                                if (index < rating) {
                                                    star.classList.add('zmdi-star'); // Filled star class
                                                    star.classList.remove('zmdi-star-outline'); // Outline star class
                                                } else {
                                                    star.classList.add('zmdi-star-outline');
                                                    star.classList.remove('zmdi-star');
                                                }
                                            });
                                        }
                                    </script>
    
                            <div class="row p-b-25">
                                  <div class="col-12 p-b-5">
                                     <label class="stext-102 cl3" for="review">Your Review *</label>
                                     <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="feedback" name="feedback" required>{{ old('feedback') }}</textarea>
                                  </div>
    
                                  <div class="col-12 p-b-5">
                                     <label class="stext-102 cl3" for="name">Name *</label>
                                     <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name"
                                     value="{{ auth()->check() ? auth()->user()->Fname . ' ' . auth()->user()->Lname : '' }}" required>
                                  </div>
    
                                     <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
                                     <input type="hidden" value="{{ $product->id }}" name="product_id">
    
                                 <div class="col-12 p-b-5">
                                      <label class="stext-102 cl3" for="email">Email *</label>
                                      <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email"
                                      value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                                 </div>
                            </div>
    
                                <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                    Submit
                                </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            SKU:  {{ $product->name }}
        </span>

        <span class="stext-107 cl6 p-lr-25">
            Categories: {{ $product->category->name }}
        </span>
    </div>
</section>


<!------------------------ Related Products ----------------->

<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Related Products
            </h3>
        </div>

        <!-- Tab01 -->
        <div class="tab01">
            <!-- Tab panes -->
            <div class="tab-content p-t-50">
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($relatedProducts as $product)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                    <!-- Product Block -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            @if($product->product_images->isNotEmpty())
                                            <img src="{{ asset($product->product_images[0]->image) }}" alt="IMG-PRODUCT">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                            <a href="{{ route('product_details', $product->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" >
                                             View
                                            </a>
                                        </div>
            
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="{{ route('product_details', $product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $product->name }}
                                                </a>
                                                <span class="stext-105 cl3">
                                                    ${{ $product->price }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection