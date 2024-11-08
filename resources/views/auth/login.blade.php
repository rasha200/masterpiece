@extends('layouts.user_side_master')

@section('content')
<!-- Title page -->
	


<div class="wrapper" style="background-color:#EEEEEE;">
    <div class="inner" style="border-radius: 10px; padding:0px !important; width:800px;">
       
        <div class="image-holder" style="" style="margin-right:0px !important;">
            <img src="{{asset('resgister/images/registerbackground.jpg')}}" alt="" style="height:400px; border-radius: 10px;">
        </div>

                    <form method="POST" action="{{ route('login') }}" style="margin-left:0px !important;">
                        @csrf
                        <h3 >{{ __('Login') }}</h3>

                       <div class="form-wrapper">
                             <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="padding-left:15px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                          
                      

                        <div class="form-wrapper">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="padding-left:15px;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row mb-3"  style="padding-left:17px;  padding-bottom:0px !important; margin-bottom:0px !important;">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check" >
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember"  style="padding-left:1px !important;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0" style="margin-top:0px !important; padding-top:0px !important;">
                            <div class="col-md-8 offset-md-4" style="margin-top:0px !important;padding-top:0px !important;">
                                <button type="submit" class="btn btn-primary" style="background-color: #14535F; margin-top: 18px; margin-buttom: 15x;" style="margin-top:0px !important;">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #14535F; margin-top: 8px; margin-left: 0px; padding-left: 0px;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
 
@endsection
