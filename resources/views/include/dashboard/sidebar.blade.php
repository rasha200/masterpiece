<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
       
        <li class="nav-item">
            <a class="nav-link" href="{{route('chart')}}">
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
            <a class="nav-link" href="{{route('services.index')}}">
                <span class="menu-title">Services</span>
                <i class="mdi mdi mdi-pharmacy menu-icon"></i>
               
            </a>
        </li>

        @if(Auth::user()->role == 'veterinarian')
        <li class="nav-item">
            <a class="nav-link" href="{{route('veterinarian_schedule')}}">
                <span class="menu-title">Your schedule</span>
                <i class="mdi mdi mdi-calendar-check menu-icon"></i>
               
            </a>
        </li>
        @endif

        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'receptionist')
        <li class="nav-item">
            <a class="nav-link" href="{{route('appointments.index')}}">
                <span class="menu-title">Appointments</span>
                <i class="mdi mdi mdi-calendar-check menu-icon"></i>
               
            </a>
        </li>
        @endif
        


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
                <i class="mdi mdi-package-variant menu-icon"></i>
            </a>
        </li>

    

        @endif

        

        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Orders</span>
                <i class="mdi mdi mdi mdi-cart-plus menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('pets.index')}}">
                <span class="menu-title">Pets</span>
                <i class="mdi mdi mdi-cat menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('toAdoupts.index')}}">
                <span class="menu-title">Adoption</span>
                <i class="mdi mdi mdi-cat menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('contacts.index')}}">
                <span class="menu-title">Contacts</span>
                <i class="mdi mdi mdi-phone menu-icon"></i>
            </a>
        </li>

        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager' || Auth::user()->role == 'receptionist')
        <li class="nav-item">
            <a class="nav-link" href="{{route('testimonials.index')}}">
                <span class="menu-title">Testimonials</span>
                <i class="mdi mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>
        @endif


        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <span class="menu-title">User side</span>
                <i class="mdi mdi-eye menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- partial -->
 
