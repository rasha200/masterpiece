@extends('layouts.dashboard_master')

@section('content')
<div class="card">
    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px;">
        {{ session('success') }}
    </div>
@endif
    <div class="card-body" style="border: 1px solid #e7dee9;">
       
        <p><strong>User Name:</strong>{{ optional($appointment->user)->Fname ?? 'Deleted User' }} {{ optional($appointment->user)->Lname ?? '' }}</p>
        <p><strong>User Email:</strong> {{ optional($appointment->user)->email ?? '' }} </p>
        <p><strong>Service Name:</strong>  {{ optional($appointment->service)->name ?? 'Deleted pet' }}  </p>
        <p><strong>Appointment date:</strong>{{ $appointment->day }}</p>
        <p><strong>Start time:</strong>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} </p>
        <p><strong>End time:</strong>{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }} </p>
        <p><strong>Pet number:</strong> {{ $appointment->pet_number }} </p>
        <p><strong>Appointment Duration:</strong> {{ $formattedDuration }} </p>

        <form id="statusForm" action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
           
            <button type="button" class="btn btn-outline-info btn-fw" onclick="confirmUpdate(event, 'Accept')">Accept</button>
            <button type="button" class="btn btn-outline-danger" onclick="confirmUpdate(event, 'Reject')">Reject</button>
           
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">Back to list</a>

        </form>
        
    </div>
</div>

<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h5>Are you sure you want to update this appointment status?</h5>
        <button id="confirmButton" class="btn btn-outline-info btn-fw">Confirm</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmUpdate(event, status) {
        event.preventDefault(); // Prevent form submission
        var modal = document.getElementById('confirmationModal');
        
        // Show the confirmation modal
        modal.style.display = 'flex';
        
        // Set up the confirm button based on status
        var confirmButton = document.getElementById('confirmButton');
        if (status === 'Accept') {
            confirmButton.className = 'btn btn-outline-info btn-fw'; // Keep same button style as form
        } else {
            confirmButton.className = 'btn btn-outline-danger'; // Change to "Reject" button style
        }

        // When "Confirm" is clicked, submit the form with the selected status
        confirmButton.onclick = function () {
            var form = document.getElementById('statusForm');
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            input.value = status;
            form.appendChild(input);
            form.submit(); // Submit the form
        };

        // When "Cancel" is clicked, hide the modal
        document.getElementById('cancelButton').onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>
@endsection
