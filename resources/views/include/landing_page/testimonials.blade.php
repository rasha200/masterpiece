<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">

            @foreach($testimonials as $testimonial)
            <div class="item-slick1" style="background-image: url(images/hero-17.jpeg);">
                <div class="container h-full d-flex justify-content-center align-items-center">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5 testimonial-content">
            
                        <div class="layer-slick1 animated visible-false text-center" data-appear="fadeInUp" data-delay="800">
                            <h5 class="ltext-201 cl2 p-t-19 p-b-8 respon1" style="font-size: 30px; font-width: 5px">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="zmdi {{ $i <= $testimonial->rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="color: #f9ba48;"></i>
                                @endfor
                              </h5>
                            <h5 class="ltext-201 cl2 p-t-19 p-b-8 respon1" style="font-size: 30px; font-weight: 100;">
                              “{{$testimonial->message}}”
                            </h5>
                            
                            <span class="ltext-61 cl2 respon2 text-center p-b-43 testimonial-author">
                                {{$testimonial->user->Fname}} {{$testimonial->user->Lname}} <br> {{$testimonial->created_at->format('Y-m-d')}}
                            </span>
            
                            <div class="layer-slick1 animated visible-false p-t-59 text-center" data-appear="zoomIn" data-delay="1600">
                                <a href="{{ route('contact') }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 p-t-12 p-b-15 trans-04" style="width: auto; display: inline-block;">
                                   Add your feedback
                                </a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
            
            
            
            @endforeach

        </div>
    </div>
</section>