<!-- Navbar -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="">
            <img src="{{asset('logo.png')}}" alt="logo" style="width: 200px; height:60px"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="{{asset('placeholder.png')}}" alt="logo"  width="50"   height="150" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            
        </div>
        <ul class="navbar-nav navbar-nav-right">
            
                    <li class="nav-item">
                        <a class="nav-link" href="}">
                            <i class="mdi mdi-login me-2"></i> Login
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="mdi mdi-account-plus me-2"></i> Register
                        </a>
                    </li>
                
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"></p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="">
                            <i class="mdi mdi-cached me-2 text-success"></i> profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href=""
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                        </a>
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
           

            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
{{--                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"--}}
{{--                   data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                    <i class="mdi mdi-email-outline"></i>--}}
{{--                    <span class="count-symbol bg-warning"></span>--}}
{{--                </a>--}}
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                     aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Messages</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="/assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark sent you a message</h6>
                            <p class="text-gray mb-0">1 minute ago</p>
                        </div>
                    </a>
                    <!-- Additional messages -->
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                   data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                        <span class="count-symbol bg-danger"></span>
                   
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                     aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    
                            <a class="dropdown-item preview-item" href="">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">New Booking</h6>
                                    <p class="text-gray ellipsis mb-0"></p>
                                </div>
                            </a>
                        
                    <!-- Additional notifications -->
                </div>
            </li>

{{--            <li class="nav-item nav-logout d-none d-lg-block">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <i class="mdi mdi-power"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item nav-settings d-none d-lg-block">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <i class="mdi mdi-format-line-spacing"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>