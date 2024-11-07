<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
         <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Give Pet a Home
            </h3>
        </div>

        <div class="row">

            @foreach($pets->slice(0, 6) as $pet)
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto" >
                <!-- Block1 -->
                <div class="block1 wrap-pic-w"  >

                    @if($pet->pet_images->isNotEmpty())
                
                    <img src="{{ asset($pet->pet_images[0]->image) }}" alt="{{ $pet->name }}" alt="{{$pet->name}}" />
                @else
                    <span>No image available</span>
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

                        @if($pet->is_adopted == "Available")
                       <div class="block1-txt-child2 p-b-4 trans-05">
                           <div class="block1-link stext-101 cl0 trans-09">
                               Adopt me
                           </div>
                       </div>
                    @else
                    <div class="block1-txt-child2 p-b-4 trans-05">
                        <div class="block1-link stext-101 cl0 trans-09">
                            View profile
                        </div>
                    </div>
                    @endif
                    
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="flex-c-m flex-w w-full p-t-15">
        <a href="{{ route('pet_adoption') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
            Adopt Today
        </a>
    </div>

</section>