<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{--            <li class="nav-item nav-profile">--}}
        {{--              <a href="#" class="nav-link">--}}
        {{--                <div class="nav-profile-image">--}}
        {{--                  <img src="/assets/images/faces/face1.jpg" alt="profile">--}}
        {{--                  <span class="login-status online"></span>--}}
        {{--                  <!--change to offline or busy as needed-->--}}
        {{--                </div>--}}
        {{--                <div class="nav-profile-text d-flex flex-column">--}}
        {{--                  <span class="font-weight-bold mb-2"></span>--}}

        {{--                </div>--}}
        {{--                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>--}}
        {{--              </a>--}}
        {{--            </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
               
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="{{route('pets.index')}}">
                <span class="menu-title">Pets</span>
                <i class="mdi mdi mdi-cat menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('services.index')}}">
                <span class="menu-title">Services</span>
                <i class="mdi mdi mdi-pharmacy menu-icon"></i>
            </a>
        </li>


        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager')
        <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
                <span class="menu-title">Categories</span>
                <i class="mdi mdi-collage menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('products.index')}}">
                <span class="menu-title">Products</span>
                <i class="mdi mdi-cart-outline menu-icon"></i>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Orders</span>
                <i class="mdi mdi mdi mdi-cart-plus menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
 
