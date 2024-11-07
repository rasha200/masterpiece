@extends('layouts.user_side_master')

@section('content')

<!-- Success and Error Modals -->
@if (Session::get('success'))
    <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
        <div class="swal-modal">
            <div class="swal-icon swal-icon--success">
                <span class="swal-icon--success__line swal-icon--success__line--long"></span>
                <span class="swal-icon--success__line swal-icon--success__line--tip"></span>
                <div class="swal-icon--success__ring"></div>
                <div class="swal-icon--success__hide-corners"></div>
            </div>
            <div class="swal-title">{{ Session::get('success') }}</div>
            <div class="swal-footer">
                <a href="{{ route('pet_adoption') }}" class="swal-button swal-button--confirm">OK</a>
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
            <div class="swal-title">{{ Session::get('error') }}</div>
            <div class="swal-footer">
                <a href="{{ route('login') }}" class="swal-button swal-button--confirm">Login</a>
            </div>
        </div>
    </div>
@endif

<!-- Adoption Form -->
<div class="container mt-5" style="max-width: 800px; padding: 40px; border-radius: 15px; background-size: cover; background-position: center; background-image: url('{{ $pet->pet_images->isNotEmpty() ? asset($pet->pet_images[0]->image) : asset('resgister/images/rigester.jpg') }}');">

    <!-- Form Heading -->
    <div class="text-center mb-5" style="background: rgba(255, 255, 255, 0.8); padding: 15px; border-radius: 10px;">
        <h3 class="text-center">Adopt Me</h3>
    </div>

    <!-- Form Start -->
    <form id="adoptionForm" method="POST" action="{{ route('toAdoupts.store') }}" style="padding: 30px; border-radius: 10px;">
        @csrf
        <input type="hidden" name="pet_id" value="{{ $pet->id }}">
        <input type="hidden" name="status" value="Pending">

        <!-- Input Fields with Semi-Transparent Background for Each Input -->
        <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="reason_for_adoption" placeholder="Reason for Adoption" value="{{ old('reason_for_adoption') }}" required style="background: rgba(255, 255, 255, 0.7);">
        </div>

        <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="current_pets" placeholder="Current Pets" value="{{ old('current_pets') }}" required style="background: rgba(255, 255, 255, 0.7);">
        </div>

        <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="availability" placeholder="Availability" value="{{ old('availability') }}" required style="background: rgba(255, 255, 255, 0.7);">
        </div>

        <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="pet_experience" placeholder="Pet Experience" value="{{ old('pet_experience') }}" required style="background: rgba(255, 255, 255, 0.7);">
        </div>

        <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="contact_info" placeholder="Contact Info" value="{{ old('contact_info') }}" required style="background: rgba(255, 255, 255, 0.7);">
        </div>

        <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="address" placeholder="Address" value="{{ old('address') }}" required style="background: rgba(255, 255, 255, 0.7);">
        </div>

        <!-- Submit Button -->
        <button type="button" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer mt-3" data-toggle="modal" data-target="#confirmationModal">
            Submit
        </button>
    </form>
</div>

<!-- Modal for Confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
               
            </div>
            <div class="modal-body">
                Are you sure you want to Adopt this pet?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit" style="background-color: #14535F;">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to handle form submission -->
<script>
    document.getElementById('confirmSubmit').addEventListener('click', function () {
        document.getElementById('adoptionForm').submit();
    });
</script>

@endsection
