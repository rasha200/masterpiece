@extends('layouts.user_side_master')



@section('content')
	
<!-- page title -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center" style="color:#14535F;">
      Our Services
    </h2>
</section>	

<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            @foreach($services as $service)
            <div class="col-md-8 col-lg-12 p-b-100">
                <div class="p-r-45 p-r-0-lg">
                    <!-- item blog -->
                    <div class="p-b-23">
                        <a href="{{ route('service_details', $service->id) }}" class="hov-img0 how-pos5-parent" >

                           <div class="row">
                            @foreach($service->service_images->slice(0, 3) as $image)
                            <div class="col-md-4 mb-3"> 
                                <img src="{{ asset($image->image) }}" class="img-fluid rounded" alt="Service Image"
                                     style="height: 200px; object-fit: cover; width: 100%;">
                            </div>
                       
                   <!-- Show price only if it's not null -->
                 
                        @endforeach
                    </div>
                        </a>

                        <div class="p-t-32">
                            <h4 class="p-b-15">
                                <a href="{{ route('service_details', $service->id) }} #book" class="ltext-108 cl2 hov-cl1 trans-04">
                                    {{$service->name}}
                                </a>
                            </h4>

                            <p class="stext-117 cl6">
                              {{ $service->description }}                            
                            </p>

                            <div class="flex-w flex-sb-m p-t-18">
                                <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                                    <span>
                                        <span class="cl4">By</span> Service Team 
                                        <span class="cl12 m-l-4 m-r-6">|</span>
                                    </span>

                                    <span>
                                       ( {{ count($service->service_feedbacks)}} Reviews )
                                        <span class="cl12 m-l-4 m-r-6">|</span>
                                    </span>

                                    <span style="color:#f9ba48;"> 
                                        @for ($i = 1; $i <= 5; $i++)
                                        <i class="zmdi {{ $i <= $service->averageRating ? 'zmdi-star' : 'zmdi-star-outline' }}"></i>
                                       @endfor
                                    </span>
                                </span>

                              
                            </div>

                            
                        </div>
                        
                    </div>
                    <a href="{{ route('service_details', $service->id) }} #book" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1  trans-04"
                    style="width:30px;">
                    Book Appointment
                     </a>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>	


@endsection