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
                                        <a href="{{ route('product_details') }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Quick View
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{$product->name}}
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
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto" style="height: 200px; object-fit: cover; width: 100%;">
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