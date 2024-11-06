@extends('layouts.user_side_master')


@section('content')

<!------------------------------------- success and error modal --------------------------------------------------------------------------->
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
                <a href="{{ route('contact') }}" class="swal-button swal-button--confirm">OK</a>
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


@elseif (Session::get('error'))
 <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
    <div class="swal-modal">
        <div class="swal-icon swal-icon--error">
            <div class="swal-icon--error__x-mark">
                <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                <span class="swal-icon--error__line swal-icon--error__line--right"></span>
            </div>
        </div>
        

        <div class="swal-title" style="">{{ Session::get('error') }}</div>

        <div class="swal-footer">
            <div class="swal-button-container">
                <a href="{{ route('login') }}" class="swal-button swal-button--confirm">Login</a>
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


<!------------------------------------- Adoption from --------------------------------------------------------------------------->

<div class="wrapper mt-4" style="background-color:#D9D9D9; ">
    <div class="inner" style="border-radius: 10px; padding:0px !important;">
        <div class="image-holder" style="">
            @if($pet->pet_images->isNotEmpty())
            <img src="{{ asset($pet->pet_images[0]->image) }}" alt="" style="height:500px; width:405px; border-radius: 10px 0 0 10px;">

        @else
        <img src="{{asset('resgister/images/rigester.jpg')}}" alt="" style="height:500px; width:405px; border-radius: 10px 0 0 10px;">
        @endif
        </div>
        
                    <form method="POST" action="{{ route('toAdoupts.store') }}">
                        @csrf
                        <h3>Adopt me</h3>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="reason_for_adoption" placeholder=" reason_for_adoption" value="{{ old('reason_for_adoption') }}" required>
                         
                        </div>

                        <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                        <input type="hidden" name="status" value="Pending">

                        
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="current_pets" placeholder=" current_pets" value="{{ old('current_pets') }}" required>
                         
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="availability" placeholder=" availability" value="{{ old('availability') }}" required>
                         
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="pet_experience" placeholder=" pet_experience" value="{{ old('pet_experience') }}" required>
                         
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="contact_info" placeholder=" contact_info" value="{{ old('contact_info') }}" required>
                         
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="address" placeholder=" address" value="{{ old('address') }}" required>
                         
                        </div>
                        
                        <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer ">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

















@endsection