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
                    <div class="block2-pic hov-img0">
                        <a href="{{ route('service_details', $service->id) }}">
                            @if($service->service_images->isNotEmpty())
                            
                            <img src="{{ asset($service->service_images[0]->image) }}" alt="{{$service->name}}" 
                            style="height: 300px; object-fit: cover; width: 100%;">
                            @else
                            <span>No image available</span>
            @endif
                        </a>
                        <a href="{{ route('service_details', $service->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 " >
                            Book Appointment
                        </a>
                    </div>

                    <div class="p-t-32">
                        

                        <h4 class="p-b-15">
                            <a href="{{ route('service_details', $service->id) }}" class="ltext-108 cl2 hov-cl1 trans-04">
                                {{$service->name}}
                            </a>
                        </h4>

                        <p class="stext-108 cl6">
                            {{$service->small_description}}
                        </p>

                       
                    </div>
                    <br>

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