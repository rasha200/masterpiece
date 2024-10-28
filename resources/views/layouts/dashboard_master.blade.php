<!-- first include start -->
@include("include/dashboard/first")
<!-- first include end -->



<!-- start mobile navbar -->
@include("include/dashboard/mobile_navbar")
<!-- end mobile navbar -->


<div class="container-fluid page-body-wrapper">

        <!-- include nav bar start -->
        @include("include/dashboard/sidebar")
        <!-- include nav bar end -->
         
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <!-- @if(Auth::user()->role == 'manager')
                    <h3 class="page-title">
                        <a href="">
                        <span class="page-title-icon bg-gradient-info text-white me-2">
                            <i class="mdi mdi-home"></i>
                            </a>
                    </h3>
                    @endif -->
                   
                </div>
                @yield("content")
            </div>
            <!-- content-wrapper ends -->

            <!-- include end start -->
            @include("include/dashboard/end")
            <!-- include end END -->
