@extends('layouts.user_side_master')

@section('content')

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            Men
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Lightweight Jacket
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
                            <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                           
                            <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                <div class="wrap-pic-w pos-relative">
                                    @if($pet->image)
                                    <img src="{{ asset('uploads/pet/' . $pet->image) }}" alt="IMG-PRODUCT">
                                    @else
                                    <span style="color: #666; font-style: italic;">No image</span>
                                @endif
                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

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
                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fas fa-paw" style="color: #14535F;"></i> Name:<span class="stext-102 cl3 p-t-23"> {{ $pet->name }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fas fa-paw" style="color: #14535F;"></i> Type: <span class="stext-102 cl3 p-t-23"> {{ $pet->type }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fas fa-paw" style="color: #14535F;"></i> Age: <span class="stext-102 cl3 p-t-23"> {{ $pet->age }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fas fa-paw" style="color: #14535F;"></i> Gender: <span class="stext-102 cl3 p-t-23"> {{ $pet->gender }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fas fa-paw" style="color: #14535F;"></i> Pet information: <span class="stext-102 cl3 p-t-23"> {{ $pet->information }}</span>
                    </h6>
                    
                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Adopt me
                                </button>
                            </div>
                        </div>	
                    </div>
        </div>
    </div>
</div>
</div>
</section>

@endsection