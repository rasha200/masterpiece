<!-- Header -->

<header>

    <!-- Header desktop -->
    <div class="container-menu-desktop">

         <!-- Topbar -->
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="left-top-bar">
                📞 Call Us: (123) 456-7890 
            </div>

            <div class="right-top-bar flex-w h-full">
                @guest
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                    Login
                </a>
                @endif
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
                    Sign Up
                </a>
                @endif

                @else

                @if (Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian' || Auth::user()->role == 'store_manager'|| Auth::user()->role == 'receptionist')
                <a href="{{ route('dashboard') }}" class="flex-c-m trans-04 p-lr-25">
                    Dashboard
                </a>
                @endif

                <a href="{{ route('profile.show') }}" class="flex-c-m trans-04 p-lr-25">
                    <i class="zmdi zmdi-account"></i>
                 </a>
                <a href="{{ route('profile.show') }}" class="flex-c-m trans-04 p-lr-25">
                    {{ Auth::user()->Fname }}  {{ Auth::user()->Lname }}
                </a>
               
                 <a href="{{ route('logout') }}" class="flex-c-m trans-04 p-lr-25"
                 onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
               
                @endguest
            </div>





        </div>
    </div>
    <!-- End Topbar -->


       	<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <a href="#" class="logo">
                    <img src="{{asset('masterlogo.png')}}" alt="IMG-LOGO" style="width:90px;">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li >
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li>
                            <a href="{{ route('about_us') }}">About</a>
                        </li>

                        <li >
                            <a href="{{ route('services') }}">Services</a>
                        </li>


                        <li>
                            <a href="{{ route('store') }}">Store</a>
                        </li>

                        <li>
                            <a href="{{ route('pet_adoption') }}">Pet Adoption</a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    
                        
                   
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        @if (Auth::check())
                        <a href="{{ route('wishLists.index') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="{{ $wishlistCount }}">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
                    @endif
                       
                  
                   

                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="index.html"><img src="{{asset('paw favicon.png')}}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
           

            <div class="flex-c-m h-full p-lr-10 bor5">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>

            <li>
                <a href="{{ route('about_us') }}">ِAbout</a>
            </li>

            <li>
                <a href="{{ route('services') }}">Services</a>
            </li>

            <li>
                <a href="{{ route('store') }}">Store</a>
            </li>

           

            <li>
                <a href="{{ route('pet_adoption') }}">Pet Adoption</a>
            </li>

            <li>
                <a href="{{ route('contact') }}">Contact</a>
            </li>

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>