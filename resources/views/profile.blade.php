@extends('layouts.user_side_master')

@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center">
      Profile
    </h2>
</section>	
<div class="container mt-5">
    <div class="row">
        <!----------------- Sidebar for Profile Navigation --------------------->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="profile-sidebar card p-3">
                <div class="profile-photo text-center mb-3">
                    <img src="{{asset('images/user 2.webp')}}" alt="User Photo" class="rounded-circle" width="100">
                </div>
                <h4 class="text-center">{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h4>
                <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="#">Order History</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Your Appointments</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }} </a>
                    </li>
                </ul>
            </div>
        </div>

        <!------------------- Profile Details Section ----------------------------------->
        <div class="col-lg-9 col-md-8">
            <div class="card p-4">
                <h3 class="mb-4">My Profile</h3>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="Fname" name="Fname" value="{{ auth()->user()->Fname }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" id="Lname" name="Lname" value="{{ auth()->user()->Lname }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">

                        <div class="col-md-6">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth()->user()->mobile ?? '' }}">
                        </div>
                       
                    </div>
                   
                    <button type="submit" class="btn btn-primary" style="background-color: #14535F">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!------------------ Success  modal ----------------->

@if (Session::get('success'))

<div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
    <div class="swal-modal">
        <div class="swal-icon swal-icon--success">
            <span class="swal-icon--success__line swal-icon--success__line--long"></span>
            <span class="swal-icon--success__line swal-icon--success__line--tip"></span>
            <div class="swal-icon--success__ring"></div>
            <div class="swal-icon--success__hide-corners"></div>
        </div>

        <div class="swal-title" style="">{{ Session::get('success') }}</div>

        <div class="swal-footer">
            <div class="swal-button-container">
                <a href="{{ route('profile.show') }}" class="swal-button swal-button--confirm">OK</a>
                <div class="swal-button__loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif   

@endsection
