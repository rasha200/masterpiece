<!-- Navbar -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-left navbar-brand-wrapper d-flex align-items-center">
        <div class="navbar-brand brand-logo" href="">
            <img src="{{asset('masterlogo2.png')}}" alt="logo" style="width: 90px; height:27px"/>
        </div>
        <a class="navbar-brand brand-logo-mini" href="index.html">
        <i class="mdi mdi-paw"></i> 
</a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      
        <ul class="navbar-nav navbar-nav-right">
            
                    

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile_dash.show') }}">
                            <i class="mdi mdi-account"></i> Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile_dash.show') }}">
                            {{ Auth::user()->Fname }}  {{ Auth::user()->Lname }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-login me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
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
