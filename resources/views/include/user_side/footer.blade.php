<!-- Footer -->
<footer class="bg3 mb-5 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
             
                <h4 class="stext-301 cl0 p-b-30">
                    <img src="{{asset('masterlogo2.png')}}" alt="IMG-LOGO" style="width : 100px;">
                </h4>

            <p class="stext-107 cl7 size-201">
                At PawClinic, we are dedicated to providing exceptional veterinary care and support for your beloved pets. Explore our range of services, pet supplies, and adoption opportunities

            </p>

            </div>

           

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Our Opening Hours
                </h4>

                <ul>
                    <li class="p-b-10">
                        <p class="stext-107 cl7 size-201">
                            Sunday: 10:00 AM - 6:00 PM
                        </p>
                    </li>

                    <li class="p-b-10">
                        <p class="stext-107 cl7 size-201">
                            Monday:              10:00 AM - 6:00 PM
                        </p>
                    </li>

                    <li class="p-b-10">
                        <p class="stext-107 cl7 size-201">
                            Tuesday:             10:00 AM - 6:00 PM
                        </p>
                    </li>

                    <li class="p-b-10">
                        <p class="stext-107 cl7 size-201">
                            Wednesday:        10:00 AM - 6:00 PM
                        </p>
                    </li>

                    <li class="p-b-10">
                        <p class="stext-107 cl7 size-201">
                            Thursday:            10:00 AM - 6:00 PM
                        </p>
                    </li>

                    <li class="p-b-10">
                        <p class="stext-107 cl7 size-201">
                            Friday & Saturday:                   Closed
                        </p>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in Clinic at 3th floor, 123 Marina Road Aqaba, Jordan 77110 or call us on (+1) 96 716 6879
                </p>

                <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-envelope"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Navigation Links
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Home
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            About
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Services
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Store
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Pet Adoption
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

           
        </div>

       
           

            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script><a href="" target="_blank"> PawClinic</a> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="" target="_blank">Rasha Yaseen</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
       
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>


<!--===============================================================================================-->

<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
   
<!--===============================================================================================-->
	<script src="  {{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="    {{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/slick/slick.min.js')}}"></script>
	<script src="  {{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src=" {{asset('vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src=" {{asset('vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
 
<!--===============================================================================================-->
	<script src="{{asset('vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

<script>
    // Function to update the heart icon based on the product's wishlist status
    function updateHeartIcon(productId, isAdded) {
        const heartIcon = document.getElementById(`heart-icon-${productId}`);
        if (heartIcon) {
            if (isAdded) {
                heartIcon.classList.add('zmdi-favorite');
                heartIcon.classList.remove('zmdi-favorite-outline');
            } else {
                heartIcon.classList.remove('zmdi-favorite');
                heartIcon.classList.add('zmdi-favorite-outline');
            }
        }
    }
    
    // Initialize heart icons based on the items in the wishlist
    function initializeWishlistIcons() {
        const wishlistItems = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlistItems.forEach(productId => updateHeartIcon(productId, true));
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        initializeWishlistIcons(); // Set icons on page load
    
        // Handle adding/removing products to the wishlist when the heart icon is clicked
        document.querySelectorAll('.js-addwish-detail').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
    
                const productId = this.closest('form').querySelector('input[name="product_id"]').value;
    
                // Retrieve and parse wishlist from localStorage
                let wishlistItems = JSON.parse(localStorage.getItem('wishlist')) || [];
    
                // Toggle wishlist status and update localStorage and icon
                if (wishlistItems.includes(productId)) {
                    // Remove item if it exists in wishlist
                    wishlistItems = wishlistItems.filter(id => id !== productId);
                    updateHeartIcon(productId, false);
                } else {
                    // Add item if it's not already in the wishlist
                    wishlistItems.push(productId);
                    updateHeartIcon(productId, true);
                }
    
                // Save updated wishlist in localStorage
                localStorage.setItem('wishlist', JSON.stringify(wishlistItems));
    
                // Submit form to update the backend
                document.getElementById(`wishlist-form-${productId}`).submit();
            });
        });
    
        // Handle deleting products from wishlist when the delete button is clicked
        document.querySelectorAll('.delete-wishlist-item').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
    
                const productId = this.closest('form').querySelector('input[name="product_id"]').value;
    
                // Retrieve and parse wishlist from localStorage
                let wishlistItems = JSON.parse(localStorage.getItem('wishlist')) || [];
    
                // Remove the item from wishlist
                wishlistItems = wishlistItems.filter(id => id !== productId);
    
                // Update localStorage
                localStorage.setItem('wishlist', JSON.stringify(wishlistItems));
    
                // Update UI (Heart Icon)
                updateHeartIcon(productId, false);
    
                // Submit the form to remove the item from the backend
                this.closest('form').submit(); // This will trigger the form submission
            });
        });
    });
    </script>
    
    
















    

       
<!--===============================================================================================-->
	<script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src=" {{asset('js/main.js')}}"></script>

</body>
</html>