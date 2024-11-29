@extends('layouts.user_side_master')

@section('content')

<!-- page title -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center" style="color:#14535F;">
        Everything Your Pet Deserves
    </h2>
</section>	


<!-- Categories -->
<section class="bg0 p-t-23 p-b-130" >
    <div class="container">
        <div class="row" >
            <div class="col-md-4 col-lg-3 p-b-80" >
                <div class="side-menu">
                    <div class="bor17 of-hidden pos-relative">
                        <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">
        
                        <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>
        
                    <div class="p-t-55">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Sort by
                        </h4>
        
                        <ul>
                            <li class="bor18">
                                <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                    Default
                                </a>
                            </li>
        
                            <li class="bor18">
                                <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                    Popularity
                                </a>
                            </li>
        
                            <li class="bor18">
                                <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                    Average rating
                                </a>
                            </li>
        
                            <li class="bor18">
                                <a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                    Newness
                                </a>
                            </li>
        
                           
                        </ul>
                    </div>
        
                   
        
                    <div class="p-t-55">
                        <h4 class="mtext-112 cl2 p-b-20">
                           Price
                        </h4>
        
                        <ul>
                            <li class="p-b-7">
                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                    <span>
                                        $0.00 - $5.00
                                    </span>
        
                                    <span>
                                        (9)
                                    </span>
                                </a>
                            </li>
        
                            <li class="p-b-7">
                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                    <span>
                                        $5.00 - $10.00
                                    </span>
        
                                    <span>
                                        (39)
                                    </span>
                                </a>
                            </li>
        
                            <li class="p-b-7">
                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                    <span>
                                        $10.00 - $15.00
                                    </span>
        
                                    <span>
                                        (29)
                                    </span>
                                </a>
                            </li>
        
                            <li class="p-b-7">
                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                    <span>
                                        $15.00 - $20.00
                                    </span>
        
                                    <span>
                                        (35)
                                    </span>
                                </a>
                            </li>
        
                            <li class="p-b-7">
                                <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                    <span>
                                        $20.00+
                                    </span>
        
                                    <span>
                                        (22)
                                    </span>
                                </a>
                            </li>
        
                        </ul>
                    </div>
        
                    <div class="p-t-50">
                        <h4 class="mtext-112 cl2 p-b-27">
                           Age group
                        </h4>
        
                        <div class="flex-w m-r--5">
                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Kitten
                            </a>
        
                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                              Adult
                            </a>
        
                          
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-md-8 col-lg-9" style="padding-left:60px;">
        <div class="flex-w flex-sb-m p-b-52" >
            <div class="flex-w flex-l-m filter-tope-group m-tb-10" >
                <!-- Button for All Products -->
                <a href="{{ route('store') }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request()->has('category_id') ? '' : 'how-active1' }}">
                    All Products
                </a>

                <!-- Dynamic Category Buttons -->
                @foreach($categories as $category)
                
                <form action="{{ route('store') }}" method="GET" style="display:inline-block">
                    <input type="hidden" value="{{ $category->id }}" name="category_id">
                    <button type="submit" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request('category_id') == $category->id ? 'how-active1' : '' }}">
                        {{ $category->name }}
                    </button>
                </form>
               
                @endforeach
              
            
            </div>

            <div class="flex-w flex-c-m m-tb-10">
       
            </div>
            
         

        </div>

<!---------------------------- Product ----------------------------------------------------->
        <div class="row isotope-grid" style="padding: 0px !important;">
            
            @if($products->isEmpty())
            <div class="col-12 text-center">
                <h4>No products available in this category.</h4>
            </div>
        @else
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                <!-- Product Block -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        @if($product->product_images->isNotEmpty())
                                                <img src="{{ asset($product->product_images[0]->image) }}" alt="IMG-PRODUCT">
                                            @else
                                                <span>No Image</span>
                                            @endif
                        
                        <a href="{{ route('product_details', $product->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 " >
                           View
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l">
                            <a href="{{ route('product_details', $product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $product->name }}
                            </a>
                            <span style="color:#f9ba48;"> 
                                @for ($i = 1; $i <= 5; $i++)
                                <i class="zmdi {{ $i <= $product->averageRating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="display: inline-block; vertical-align: middle;"></i>
                               @endfor
                            </span>
                            <span class="stext-105 cl3">
                                ${{ $product->price }}
                            </span>
                        </div>
                       

                    </div>
                </div>
            </div>


         
            @endforeach
            @endif
        </div>
    </div>

    
</div>
    <!-- Custom Pagination -->
<div class="flex-c-m flex-w w-full p-t-38">
    {{-- Loop through the pages --}}
    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        @if ($page == $products->currentPage())
            <a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                {{ $page }}
            </a>
        @else
            <a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                {{ $page }}
            </a>
        @endif
    @endforeach
</div>

    </div>
</section>

@if(isset($products) && $products->isNotEmpty())
<script>
    // Open modal when Quick View button is clicked
    document.querySelectorAll('.js-show-modal1').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            document.getElementById(modalId).style.display = 'block';
            document.querySelector('.overlay-modal1').style.display = 'block';
        });
    });

    // Close modal when overlay or close button is clicked
    document.querySelectorAll('.js-modal1').forEach(modal => {
        modal.addEventListener('click', function(event) {
            if (event.target.classList.contains('js-hide-modal1')) {
                modal.style.display = 'none';
                document.querySelector('.overlay-modal1').style.display = 'none';
            }
        });
    });
</script>
@endif



@endsection