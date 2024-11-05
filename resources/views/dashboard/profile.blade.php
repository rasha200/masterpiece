@extends('layouts.dashboard_master')

@section('content')
<div class="container-fluid">
    <h2 class="title-1">Profile</h2>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4" style="background-color: #F1F1F1; border-radius:8px;">
                    <div class="profile-image mt-4">
                        <img src="{{ asset('images/user 2.webp') }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 70px;">
                        <h5 style="margin-top:20px;">{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h5>
                        <p><b>Email:</b> {{ auth()->user()->email }}</p>
                        <p><b>Mobile:</b> {{ auth()->user()->mobile }}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-4">
                            <label for="Fname">First name</label>
                            <input type="text" class="form-control" id="Fname" placeholder="First name" name="Fname" value="{{ auth()->user()->Fname }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Lname">Last name</label>
                            <input type="text" class="form-control" id="Lname" placeholder="Last name" name="Lname" value="{{ auth()->user()->Lname }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Phone number</label>
                            <input type="text" class="form-control" id="mobile" placeholder="Phone number" name="mobile" value="{{ auth()->user()->mobile ?? '' }}" required>
                        </div>

                        <button type="button" class="btn btn-outline-info btn-fw" onclick="confirmUpdate(event)">Edit Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h5>Are you sure you want to update your profile?</h5>
        <button id="confirmButton" class="btn btn-outline-info btn-fw">Update</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmUpdate(event) {
        event.preventDefault(); // Prevent default form submission
        var modal = document.getElementById('confirmationModal');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        document.getElementById('confirmButton').onclick = function () {
            document.getElementById('profileForm').submit(); // Submit the existing form
        };

        // Set up the cancel button to hide the modal
        document.getElementById('cancelButton').onclick = function () {
            modal.style.display = 'none'; // Hide modal
        };
    }
</script>

@endsection
