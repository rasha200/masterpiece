@extends('layouts.user_side_master')

@section('content')

 <!--==========================================  (ٌService)  =====================================================-->
 <div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
           Services
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $service->name }}
        </span>
    </div>
</div>
<section class="bg0 p-t-52 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!--  -->
                    <div class="row">
                        @foreach ($serviceImages->slice(0, 3) as $serviceImage)
                            <div class="col-md-4 mb-3"> 
                                <img src="{{ asset($serviceImage->image) }}" class="img-fluid rounded" alt="Service Image"
                                     style="height: 200px; object-fit: cover; width: 100%;">
                            </div>
                       
                   
                        <div class="flex-col-c-m size-123 bg9 how-pos5">
                            <span class="ltext-50 cl2 txt-center">
                                Price
                            </span>

                            <span class="stext-109 cl3 txt-center">
                               $ {{ $service->price }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div class="p-t-32">
                        <span class="flex-w flex-m stext-111 cl2 p-b-19">
                            <span>
                                <span class="cl4">By</span> Admin  
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                22 Jan, 2018
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                StreetStyle, Fashion, Couple  
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                8 Comments
                            </span>
                        </span>

                        <h4 class="ltext-109 cl2 p-b-28">
                            {{ $service->name }}
                        </h4>

                        <p class="stext-117 cl6 p-b-26">
                            {{ $service->description }}                       
                         </p>

                       
                    </div>







 <!--==========================================  (ٌReview)  =====================================================-->
 <div class="bor10 m-t-50 p-t-43 p-b-40">
    <!-- Tab01 -->
    <div class="tab01">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item p-b-10">
                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Reviews ({{ count($servicefeedbacks) }})</a>
            </li>

            

            <li class="nav-item p-b-10">
                <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Add Review</a>
            </li>
        </ul>



        <!----------- Reviews ------------->
        <div class="tab-content p-t-43">
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <div class="how-pos2 p-lr-15-md">
                    @foreach ($servicefeedbacks as $servicefeedback)
                    <div class="flex-w flex-t p-b-68">
                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                            <img src="{{asset('images/user 2.webp')}}" alt="AVATAR">
                        </div>

                        <div class="size-207">
                            <div class="flex-w flex-sb-m p-b-17">
                                <span class="mtext-107 cl2 p-r-20">
                                   
                                    {{$servicefeedback->feedback}}
                                </span>

                                <span class="fs-18 cl11">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="zmdi {{ $i <= $servicefeedback->rating ? 'zmdi-star' : 'zmdi-star-outline' }}"></i>
                                    @endfor
                                </span>

                            </div>

                            <p class="stext-102 cl6">
                                {{$servicefeedback->user->Fname}} {{$servicefeedback->user->Lname}}
                            </p>

                            <p class="stext-102 cl6">
                                {{$servicefeedback->created_at->format('Y-m-d')}}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- - -->
         

            <!-------------- Success & error modal ------------->
            @if (Session::get('success'))

                <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
                    <div class="swal-modal">
                        <div class="swal-icon swal-icon--success">
                            <span class="swal-icon--success__line swal-icon--success__line--long"></span>
                            <span class="swal-icon--success__line swal-icon--success__line--tip"></span>
                            <div class="swal-icon--success__ring"></div>
                            <div class="swal-icon--success__hide-corners"></div>
                        </div>
                
                        <div class="swal-title" style="">{{ Session::get('success') }}</div>
                
                        <div class="swal-footer">
                            <div class="swal-button-container">
                                <a href="{{ route('service_details', ['id' => $service->id]) }}" class="swal-button swal-button--confirm">OK</a>
                                <div class="swal-button__loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @elseif (Session::get('error'))
                 <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
                    <div class="swal-modal">
                        <div class="swal-icon swal-icon--error">
                            <div class="swal-icon--error__x-mark">
                                <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                                <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                            </div>
                        </div>
                        
                
                        <div class="swal-title" style="">{{ Session::get('error') }}</div>
                
                        <div class="swal-footer">
                            <div class="swal-button-container">
                                <a href="{{ route('login') }}" class="swal-button swal-button--confirm">Login</a>
                                <div class="swal-button__loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif   



             <!-------------------- Add review -------------->
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="row">
                    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                        <div class="p-b-30 m-lr-15-sm">
                           
                            <form class="w-full" action="{{ route('serviceFeedbacks.store') }}" method="POST">
                                @csrf
                                <h5 class="mtext-108 cl2 p-b-7">
                                    Add a review
                                </h5>

                                <p class="stext-102 cl6">
                                    Your email address will not be published. Required fields are marked *
                                </p>

                                <div class="flex-w flex-m p-t-50 p-b-23">
                                    <span class="stext-102 cl3 m-r-16">
                                        Your Rating *
                                    </span>

                                    <span class="wrap-rating fs-18 cl11 pointer">
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(1)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(2)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(3)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(4)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(5)"></i>
                                        <input class="dis-none" type="hidden" name="rating" id="rating" value="" required>
                                    </span>
                                </div>

                                <script>
                                    function setRating(rating) {
                                        document.getElementById('rating').value = rating;
                                        // Update star visuals based on selected rating
                                        const stars = document.querySelectorAll('.item-rating');
                                        stars.forEach((star, index) => {
                                            if (index < rating) {
                                                star.classList.add('zmdi-star'); // Filled star class
                                                star.classList.remove('zmdi-star-outline'); // Outline star class
                                            } else {
                                                star.classList.add('zmdi-star-outline');
                                                star.classList.remove('zmdi-star');
                                            }
                                        });
                                    }
                                </script>

                        <div class="row p-b-25">
                              <div class="col-12 p-b-5">
                                 <label class="stext-102 cl3" for="review">Your Review *</label>
                                 <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="feedback" name="feedback" required>{{ old('feedback') }}</textarea>
                              </div>

                              <div class="col-12 p-b-5">
                                 <label class="stext-102 cl3" for="name">Name *</label>
                                 <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name"
                                 value="{{ auth()->check() ? auth()->user()->Fname . ' ' . auth()->user()->Lname : '' }}" required>
                              </div>

                                 <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
                                 <input type="hidden" value="{{ $service->id }}" name="service_id">

                             <div class="col-12 p-b-5">
                                  <label class="stext-102 cl3" for="email">Email *</label>
                                  <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email"
                                  value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                             </div>
                        </div>

                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Submit
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!--==========================================  (ٌReview)  =====================================================-->


                    
                  

                    <!--  -->
                    <div class="p-t-40">
                        <h5 class="mtext-113 cl2 p-b-12">
                            Leave a Comment
                        </h5>

                        <p class="stext-107 cl6 p-b-40">
                            Your email address will not be published. Required fields are marked *
                        </p>

                        <form>
                            <div class="bor19 m-b-20">
                                <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>
                            </div>

                            <div class="bor19 size-218 m-b-20">
                                <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *">
                            </div>

                            <div class="bor19 size-218 m-b-20">
                                <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *">
                            </div>

                            <div class="bor19 size-218 m-b-30">
                                <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="web" placeholder="Website">
                            </div>

                            <button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
                                Post Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</section>

@endsection