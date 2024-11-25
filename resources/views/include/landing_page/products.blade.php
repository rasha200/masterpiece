<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">Products</h3>
        </div>

<!------------- product-------------------------------->
        <div class="tab01">
            <!-- Tab panes -->
            <div class="tab-content p-t-50">
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($products->slice(0, 12) as $product)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                    <!-- Product Block -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            @if($product->product_images->isNotEmpty())
                                                <img src="{{ asset($product->product_images[0]->image) }}" alt="IMG-PRODUCT">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                            <a href="{{ route('product_details', $product->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" >
                                                Quick View
                                            </a>
                                        </div>
            
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="{{ route('product_details', $product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $product->name }}
                                                </a>
                                                <span style="color:#f9ba48;"> 
                                                    @for ($i = 1; $i <= 5; $i++)
                                                    <i class="zmdi {{ $i <= $product->averageRating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="display: inline-block; vertical-align: middle;"></i>
                                                   @endfor
                                                </span>
                                                <span class="stext-105 cl3">${{ $product->price }}</span>
                                            </div>


                                           

                                        </div>
                                    </div>
                                </div>


                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
        </div>

                                        
    </div>
    <div class="flex-c-m flex-w w-full p-t-15">
        <a href="{{ route('store') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">Visit Our Store</a>
    </div>
</section>


<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">Our new products</h3>
        </div>

-<!---------------- New products ---------------------------------->
      
        <div class="tab01">
            <!-- Tab panes -->
            <div class="tab-content p-t-50">
                <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach($latestProduct->slice(0, 12) as $product)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                    <!-- Product Block -->
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            @if($product->product_images->isNotEmpty())
                                            <div class="position-relative">
                                                <img src="{{ asset($product->product_images[0]->image) }}" alt="IMG-PRODUCT">
                                                <div class="new-label">New</div>
                                            </div>
                                            <style>
                                                .new-label {
                                                    position: absolute;
                                                    top: 10px;  /* Adjusts the distance from the top */
                                                    left: 10px; /* Adjusts the distance from the left */
                                                    background-color: green;  /* Green background */
                                                    color: white;  /* White text color */
                                                    font-weight: bold;  /* Bold text */
                                                    padding: 5px 10px;  /* Padding around the text */
                                                    border-radius: 5px;  /* Rounded corners */
                                                    font-size: 14px;  /* Adjust the font size */
                                                    z-index: 10;  /* Ensures it stays on top of the image */
                                                }
                                                
                                                .card {
                                                    position: relative;
                                                }
                                                </style>
                                            @else
                                                <span>No Image</span>
                                            @endif
                                            <a href="{{ route('product_details', $product->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" >
                                                Quick View
                                            </a>
                                        </div>
                                      

            
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="{{ route('product_details', $product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $product->name }}
                                                </a>
                                                <span style="color:#f9ba48;"> 
                                                    @for ($i = 1; $i <= 5; $i++)
                                                    <i class="zmdi {{ $i <= $product->averageRating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="display: inline-block; vertical-align: middle;"></i>
                                                   @endfor
                                                </span>
                                                <span class="stext-105 cl3">${{ $product->price }}</span>
                                            </div>


                                           

                                        </div>
                                    </div>
                                </div>


                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
        </div>

                                        
    </div>
    <div class="flex-c-m flex-w w-full p-t-15">
        <a href="{{ route('store') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">Visit Our Store</a>
    </div>
</section>

<script>
// Function to dynamically show modal with product data
function showModal(product) {
    document.getElementById("modalImage").src = product.image;
    document.getElementById("modalProductName").textContent = product.name;
    document.getElementById("modalProductPrice").textContent = "$" + product.price;
    document.getElementById("productModal").style.display = 'block';
    document.querySelector('.overlay-modal1').style.display = 'block';
}

// Hide modal
function hideModal() {
    document.getElementById("productModal").style.display = 'none';
    document.querySelector('.overlay-modal1').style.display = 'none';
}

// Add event listeners to each Quick View button in the loop
document.querySelectorAll('.js-show-modal1').forEach(button => {
    button.addEventListener('click', function() {
        const product = {
            image: this.closest('.block2-pic').querySelector('img').src,
            name: this.closest('.block2').querySelector('.js-name-b2').textContent,
            price: this.closest('.block2').querySelector('.stext-105').textContent.replace('$', '')
        };
        showModal(product);
    });
});

</script>
