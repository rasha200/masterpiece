@extends('layouts.user_side_master')

@section('content')
<div class="wrapper " style="background-color:#D9D9D9; ">
    <div class="inner" style="border-radius: 10px; padding:0px !important; margin-top:90px;">
        <div class="image-holder" style="">
            <img src="{{asset('resgister/images/rigester.jpg')}}" alt="" style="height:500px; width:405px; border-radius: 10px 0 0 10px;">
        </div>
        
                    <form method="POST" action="{{ route('register') }}" autocomplete="off">
                        @csrf
                        <h3>Create your account</h3>

                       
                        <input type="text" name="dummy_Fname" style="display: none;">
                        <input type="password" name="dummy_password" style="display: none;">

                        <div class="form-wrapper">
                                <input id="Fname" type="text" placeholder="First Name" class="form-control @error('Fname') is-invalid @enderror" name="Fname" value="" required autocomplete="off" autofocus style="padding-left:15px;">
                                <i class="zmdi zmdi-account"></i>
                                @error('Fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>



                        <div class="form-wrapper">
                                <input id="Lname" type="text" placeholder="Last Name" class="form-control @error('Lname') is-invalid @enderror" name="Lname" value="" required autocomplete="off" autofocus style="padding-left:15px; ">
                                <i class="zmdi zmdi-account"></i>
                                @error('Lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                            <div class="form-wrapper">
                                <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" style="padding-left:15px;">
                                <i class="zmdi zmdi-email"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-wrapper">
                                <input id="mobile" placeholder="Mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="" required autocomplete="mobile" autofocus style="padding-left:15px;">
                                <i class="zmdi zmdi-phone"></i>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       

                            <div class="form-wrapper">
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="padding-left:15px;">
                                <i class="zmdi zmdi-lock"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      

                     

                            <div class="form-wrapper">
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="padding-left:15px;">
                                <i class="zmdi zmdi-lock"></i>
                            </div>
                       

                     
                                <button type="submit" class="btn btn-primary" style="background-color: #14535F; margin-top: 0px !important;">
                                    {{ __('Register') }}
                                    <i class="zmdi zmdi-arrow-right"></i>
                                </button>
                       
                    </form>
                </div>
            </div>

@endsection
