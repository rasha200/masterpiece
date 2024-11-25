@extends('layouts.user_side_master')

@section('content')

<!-- breadcrumb -->
<div class="container" style="margin-top: 50px;">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Shoping Cart
        </span>
    </div>
</div>
    

<!-- Shoping Cart -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">

                        @if (isset($cartDetails) && is_array($cartDetails) && count($cartDetails) > 0)
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                               
                                <th class="column-1"></th>
                                <th class="column-2">Product</th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6"></th>
                            </tr>
                          @foreach ($cartDetails as $item)
                            <tr class="table_row">
                                <td class="column-1">
                                    <form action="{{ route('cart.delete',$item['id']) }}" method="POST">
                                        @csrf
                                 
                                        <button type="submit" >
                                           <img src="{{ $item['image'] }}" alt="IMG" style="width:80px;">
                                        </button>
                                  
                                </form>

                                
                                </td>
                                <td class="column-2"> 
                                    {{ $item['name'] }}
                                
                                    <br> 
                                     @if (isset($item['variation']))
                                     {!! $item['variation'] !!}
                                    @else
                                      
                                    @endif
                                </td>
                                <td class="column-3">${{ number_format($item['price'], 2) }}</td>
                                <td class="column-4">
                                   
                                        

                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" >
                                            @csrf
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                               
                                             
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="updateQuantity({{ $item['id'] }}, -1)">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>
                                                <input
                                             class="mtext-104 cl3 txt-center num-product"
                                                type="number"
                                                name="quantity"
                                                data-product-id="{{ $item['id'] }}"
                                                value="{{ $item['quantity'] }}"
                                                min="1"
                                                required
                                            >

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"  onclick="updateQuantity({{ $item['id'] }}, 1)">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                                
                                            </div>
                                        </form>
                                       


                                        
                                      
                                        
                                     
                                  
                                </td>
                                <td class="column-5">${{ number_format($item['total'], 2) }}</td>


                               

                           
                             
                             
                            </tr>
                            @endforeach

                            
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

                          
                        </table>

                        @else
                        <p>Your cart is empty!</p>
                    @endif
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
                                
                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Apply coupon
                            </div>
                        </div>

                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="route-box__link">
                                <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Delete Cart
                                </div>
                            </button>
                        </form>

                       
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        @php
                        $total = collect($cartDetails)->sum(function($item) {
                            return $item['price'] * $item['quantity'];
                        });
                        
                    @endphp

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                ${{ number_format($total, 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Shipping:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">
                                There are no shipping methods available. Please double check your address, or contact us if you need any help.
                            </p>
                            
                            <div class="p-t-15">
                                <span class="stext-112 cl8">
                                    Calculate Shipping
                                </span>

                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2" name="time">
                                        <option>Select a country...</option>
                                        <option>USA</option>
                                        <option>UK</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                </div>
                                
                                <div class="flex-w">
                                    <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                        Update Totals
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                ${{ number_format($total, 2) }}
                            </span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection