<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">Best Seller</h3>
        </div>

        <!-- Tab01 -->
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
                                            <button type="button" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-modal="modal-{{ $product->id }}">
                                                Quick View
                                            </button>
                                        </div>
            
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="{{ route('product_details', $product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $product->name }}
                                                </a>
                                                <span class="stext-105 cl3">${{ $product->price }}</span>
                                            </div>


                                           

                                        </div>
                                    </div>
                                </div>

                                @include("include/modal/product", ['product' => $product]) <!-- Pass product data to modal partial -->

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
