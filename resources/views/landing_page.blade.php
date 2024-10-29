@extends('layouts.user_side_master')

@section('content')

{{--include Hero start--}}
@include("include/user_side/hero")
{{--include Hero end--}}

{{--include About start--}}
@include("include/user_side/about")
{{--include About end--}}


{{--Services section start--}}
<section class="sec-blog bg0 p-t-0">
    <div class="container">
        <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Our Services
            </h3>
        </div>

        <div class="row">

            @foreach($services->slice(0, 3) as $service)
            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="blog-detail.html">
                            @if($service->service_images->isNotEmpty())
                            
                            <img src="{{ asset($service->service_images[0]->image) }}" alt="{{$service->name}}" 
                            style="height: 300px; object-fit: cover; width: 100%;">
                            @else
                            <span>No image available</span>
            @endif
                        </a>
                    </div>

                    <div class="p-t-32">
                        

                        <h4 class="p-b-15">
                            <a href="{{ route('service_details', $service->id) }}" class="ltext-108 cl2 hov-cl1 trans-04">
                                {{$service->name}}
                            </a>
                        </h4>

                       
                    </div>

                    <a href="{{ route('service_details', $service->id) }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                        Continue Reading

                        <i class="fa fa-long-arrow-right m-l-9"></i>
                    </a>
                </div>
            </div>
            @endforeach
           
    </div>

    <div class="flex-c-m flex-w w-full p-t-45">
        <a href="{{ route('services') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
            Explore Our Services
        </a>
    </div>
    
</section>
{{--Services section end--}}


{{--Products section start--}}
<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Best Seller
            </h3>
        </div>

        <!-- Tab01 -->
        <div class="tab01">
           

            <!-- Tab panes -->
            <div class="tab-content p-t-50">
                <!-- - -->
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($products as $product)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15" style="height: 418; object-fit: cover; width: 100%;">
                                <!-- Block2 -->

                               
                                <div class="block2">
                                    <div class="block2-pic hov-img0" >
                                        @if($product->image)
                                        <img src="{{ asset('uploads/product/' . $product->image) }}" alt="IMG-PRODUCT"
                                       >
                                        @else
                                        <span>No Image</span>
                                    @endif
                                    <form action="{{route('landing_single_product', $product->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Quick View
                                        </button>
                                    </form>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{$product->name}}
                                            </a>
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{$product->id}}
                                            </a>
                                            <span class="stext-105 cl3">
                                                ${{$product->price}}
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

    <div class="flex-c-m flex-w w-full p-t-45">
        <a href="{{ route('store') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
            Visit Our Store
        </a>
    </div>
</section>

<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>

    <div class="container">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                <img src="images/icons/icon-close.png" alt="CLOSE">
            </button>

            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ asset('uploads/product/' . $product->image) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        @if($product->image)
                                        <img src="{{ asset('uploads/product/' . $product->image) }}" alt="IMG-PRODUCT">
                                        @else
                                        <span style="color: #666; font-style: italic;">No image</span>
                                    @endif
                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="{{ asset('uploads/product/' . $product->image) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        @if($product->image)
                                        <img src="{{ asset('uploads/product/' . $product->image) }}" alt="IMG-PRODUCT">
                                        @else
                                        <span style="color: #666; font-style: italic;">No image</span>
                                    @endif
                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="{{ asset('uploads/product/' . $product->image) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        @if($product->image)
                                        <img src="{{ asset('uploads/product/' . $product->image) }}" alt="IMG-PRODUCT">
                                        @else
                                        <span style="color: #666; font-style: italic;">No image</span>
                                    @endif
                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
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
                            {{ $product->price }}
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            {{ $product->description }}
                            
                        </p>
                            <p class="stext-102 cl3 p-t-23">
                            {{ $product->id }}
                            
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
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Products section end--}}


{{--Pets section start--}}
<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
         <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Give a Pet a Home
            </h3>
        </div>

        <div class="row">

            @foreach($pets->slice(0, 6) as $pet)
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto" >
                <!-- Block1 -->
                <div class="block1 wrap-pic-w"  >
                    @if($pet->image)
                    <img src="{{ asset('uploads/pet/' . $pet->image) }}" alt="{{$pet->name}}" >
                    @else
                    <span>No Image</span>
                @endif
                    <a href="{{ route('pet_details', $pet->id) }}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                {{$pet->name}}
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                {{$pet->type}}
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Adopt me
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="flex-c-m flex-w w-full p-t-45">
        <a href="{{ route('pet_adoption') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
            Adopt Today
        </a>
    </div>

</section>
{{--Pets section end--}}

{{--include Testimonials start--}}
@include("include/user_side/testimonials")
{{--include Testimonials end--}}

@endsection