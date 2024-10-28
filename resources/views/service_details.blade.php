@extends('layouts.user_side_master')

@section('content')

<!-- Content page -->
<section class="bg0 p-t-52 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!--  -->
                    <div class="row">
                        @foreach ($serviceImages as $serviceImage)
                            <div class="col-md-4 mb-3"> 
                                <img src="{{ asset($serviceImage->image) }}" class="img-fluid rounded" alt="Service Image"
                                     style="height: 200px; object-fit: cover; width: 100%;">
                            </div>
                       
                   
                        <div class="flex-col-c-m size-123 bg9 how-pos5">
                            <span class="ltext-50 cl2 txt-center">
                                Price
                            </span>

                            <span class="stext-109 cl3 txt-center">
                                {{ $service->price }}
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
                            {{ $service->description }}                        </p>

                       
                    </div>

                    <div class="flex-w flex-t p-t-16">
                        <span class="size-216 stext-116 cl8 p-t-4">
                            Tags
                        </span>

                        <div class="flex-w size-217">
                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Streetstyle
                            </a>

                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Crafts
                            </a>
                        </div>
                    </div>

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