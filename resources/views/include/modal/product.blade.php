<!-- Modal Structure -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="modal-{{ $product->id }}">
    <div class="overlay-modal1 js-hide-modal1"></div>

    <div class="container">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                <img src="images/icons/icon-close.png" alt="CLOSE">
            </button>

            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">

                                @foreach ($product->product_images as $productImage)
                                <div class="item-slick3" data-thumb="{{ asset($productImage->image) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset($productImage->image) }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($productImage->image) }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <a href="{{ route('product_details', $product->id) }}" class="mtext-105 cl2 js-name-detail p-b-14">{{ $product->name }}</a>
                       <br> <span class="mtext-106 cl2">${{ $product->price }}</span>
                        <p class="stext-102 cl3 p-t-23">{{ $product->small_description }}</p>

                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>


                        @if (Auth::check())
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <form action="{{ route('wishLists.store') }}" method="POST" id="wishlist-form-{{ $product->id }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist" id="add-to-wishlist-{{ $product->id }}">
                                        <i class="zmdi zmdi-favorite" id="heart-icon-{{ $product->id }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div> <!-- End of .row -->
        </div> <!-- End of .bg0 -->
    </div> <!-- End of .container -->
</div> <!-- End of .wrap-modal1 -->
