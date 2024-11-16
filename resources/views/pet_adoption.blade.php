@extends('layouts.user_side_master')

@section('content')

<!-- page title -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center" style="color:#333;;">
        Adopt a Pet Today
    </h2>
</section>		


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
    

       <div class="row">

           @foreach($pets as $pet)
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
                    @if($pet->is_adopted == "Available" ||$pet->is_adopted == "Pending")
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
   <!-- Custom Pagination -->
<div class="flex-c-m flex-w w-full p-t-38">
    {{-- Loop through the pages --}}
    @foreach ($pets->getUrlRange(1, $pets->lastPage()) as $page => $url)
        @if ($page == $pets->currentPage())
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
   </div>
</div>

@endsection