@php
    use App\Models\ProductVariation;
    use App\Models\Product;

    $cartItems = json_decode(Cookie::get('cart', json_encode([])), true);
    $subtotal = 0;
@endphp

<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">Your Cart</span>
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @foreach ($cartItems as $item)
                    @php
                        $variation = isset($item['variation_id']) ? ProductVariation::with('product.product_images')->find($item['variation_id']) : null;
                        $product = $variation ? $variation->product : Product::with('product_images')->find($item['product_id']);
                        $productImage = $variation ? $variation->product->product_images->first() : $product->product_images->first();
                        $imageUrl = $productImage ? asset($productImage->image) : asset('images/default-product.jpg');
                        $price = $variation ? $variation->price : $product->price;
                        $subtotal += $price * $item['quantity'];
                    @endphp

                    <li class="header-cart-item flex-w flex-t m-b-12"  style="display: flex;">
                       

                            <form action="{{ route('cart.delete',$product->id) }}" method="POST">
                                @csrf
                         
                                <button type="submit" class="header-cart-item-img">
                                   <img src="{{ $imageUrl }}" alt="IMG" style="height: 75px; width:75px;">
                                </button>
                          
                        </form>


                        
                      
                        <div class="header-cart-item-txt p-t-8">
                            <a href="{{ route('product_details', $product->id) }}" class="header-cart-item-name m-b-8 hov-cl1 trans-04">
                                {{ $product->name }}
                            </a>

                            @if ($variation)
                                <div class="variation-details">
                                    @if ($variation->color)
                                        <span class="color-circle" style="background-color: {{ $variation->color }};"></span>
                                    @endif
                                    @if ($variation->size)
                                        <span>{{ $variation->size }} </span>
                                    @endif
                                    @if ($variation->flavour)
                                        <span>, {{ $variation->flavour }} </span>
                                    @endif
                                    @if ($variation->age_group)
                                        <span>, {{ $variation->age_group }} </span>
                                    @endif
                                    @if ($variation->disinfected)
                                        <span></span>
                                    @endif

                                    
                                </div>
                            @endif

                            <span class="header-cart-item-info">
                                {{ $item['quantity'] }} x ${{ number_format($price, 2) }}
                            </span>
                        </div>

                        <div class="header-cart-item-txt p-t-8" style="height: 60px; width:60px; margin-top:35px; margin-left:35px;">
                            <form action="{{ route('cart.update',  $product->id) }}" method="POST" style="height: 60px; width:60px;">
                                @csrf
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10" style="height: 20px; width:62px;">
                                   
                                 
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="updateQuantity({{  $product->id }}, -1)" style="height: 20px; width:20px;">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>
                                    <input
                                 class="mtext-104 cl3 txt-center num-product"
                                    type="number"
                                    name="quantity"
                                    data-product-id="{{  $product->id }}"
                                    value="{{ $item['quantity'] }}"
                                    min="1"
                                    style="height: 20px; width:20px;"
                                    required
                                >

                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"  onclick="updateQuantity({{  $product->id }}, 1)" style="height: 20px; width:20px;">
                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                </div>
                                    
                                </div>
                            </form>

                            <script>
                                function updateQuantity(id, change) {
                                    // Select the input element using data-product-id
                                    const quantityInput = document.querySelector(`input[name="quantity"][data-product-id="${id}"]`);
                    
                                    if (quantityInput) {
                                        // Adjust the quantity based on the change value
                                        let newQuantity = parseInt(quantityInput.value) + change;
                    
                                        // Ensure quantity remains at least 1
                                        if (newQuantity < 1) {
                                            newQuantity = 1;
                                        }
                    
                                        // Update the input value
                                        quantityInput.value = newQuantity;
                    
                                        // Automatically submit the form to apply the update to the cart
                                        quantityInput.closest('form').submit();
                                    }
                                }
                            </script>

                        </div>

                    </li>
                @endforeach
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: ${{ number_format($subtotal, 2) }}
                </div>
                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{ route('cart.index') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>
                    <a href="" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
