<!DOCTYPE html>
<html lang="en">
<head>
	<title>PawClinic</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('paw favicon2.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
<!-- MATERIAL DESIGN ICONIC FONT (register)-->
<link rel="stylesheet" href="{{asset('fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">

<!-- STYLE CSS (register)-->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body class="animsition">

{{--include header start--}}
@include("include/user_side/header")
{{--include header end--}}	


{{--include cart start--}}
@include("include/user_side/cart")
{{--include cart end--}}


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

{{--include footer start--}}
@include("include/user_side/footer")
{{--include footer end--}}
