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
           Pet Adoption
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $pet->name }}
        </span>
    </div>
</div>
    

<!-- Pet Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
         

                    @foreach ($petImages as $petImage)
                            <div class="item-slick3" data-thumb="{{ asset($petImage->image) }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset($petImage->image) }}" alt="Pet images" style="height: 500px; object-fit: cover; width: 100%;">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($petImage->image) }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                    @endforeach
                           
                   
                    @if(!empty($pet->pet_vaccinations_image))
         
                            <div class="item-slick3" data-thumb="{{ asset('uploads/pet/' . $pet->pet_vaccinations_image) }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset('uploads/pet/' . $pet->pet_vaccinations_image) }}" alt="Pet vaccinations image" style="height: 500px; object-fit: cover; width: 100%;">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('uploads/pet/' . $pet->pet_vaccinations_image) }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                 @else
                 <div class="item-slick3" data-thumb="{{ asset('images/hero-20.png') }}">
                    <div class="wrap-pic-w pos-relative">
                        <img src="{{ asset('images/hero-20.png') }}" alt="Pet vaccinations image" style="height: 500px">

                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('images/hero-20.png') }}">
                            <i class="fa fa-expand"></i>
                        </a>
                    </div>
                </div>
                 @endif
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fa fa-paw" style="color: #14535F;"></i> Name:<span class="stext-102 cl3 p-t-23"> {{ $pet->name }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fa fa-paw" style="color: #14535F;"></i> Type: <span class="stext-102 cl3 p-t-23"> {{ $pet->type }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fa fa-paw" style="color: #14535F;"></i> Age: <span class="stext-102 cl3 p-t-23"> {{ $pet->age }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fa fa-paw" style="color: #14535F;"></i> Gender: <span class="stext-102 cl3 p-t-23"> {{ $pet->gender }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fa fa-paw" style="color: #14535F;"></i> Pet information: <span class="stext-102 cl3 p-t-23"> {{ $pet->information }}</span>
                    </h6>

                    <h6 class="mtext-50 cl2 js-name-detail p-b-14">
                        <i class="fa fa-paw" style="color: #14535F;"></i> Special needs: <span class="stext-102 cl3 p-t-23"> {{ $pet->Special_needs }}</span>
                    </h6>
                    
                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <a href="{{ route('toAdoupts.create', ['pet_id' => $pet->id]) }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                                    Adopt me
                                </a>
                            </div>
                        </div>	
                    </div>
        </div>
    </div>
</div>
</div>
</section>

@endsection