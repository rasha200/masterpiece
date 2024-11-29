@extends('layouts.dashboard_master')

@section('content')
<div class="card">
    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px;">
        {{ session('success') }}
    </div>
@endif
<style>
    /* Animation to fade out */
    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
  
    /* Apply fade-out animation to messages */
    .alert {
        animation: fadeOut 3s ease-out forwards;
    }
  </style>
    <div class="card-body" style="border: 1px solid #e7dee9;">
       
        <p><strong>User Name:</strong>{{ optional($toAdoupt->user)->Fname ?? 'Deleted User' }} {{ optional($toAdoupt->user)->Lname ?? '' }}</p>
        <p><strong>User Email:</strong> {{ optional($toAdoupt->user)->email ?? '' }} </p>
        <p><strong>Pet Name:</strong>  {{ optional($toAdoupt->pet)->name ?? 'Deleted pet' }}  </p>
        <p><strong>Reason For Adoption:</strong>{{ $toAdoupt->reason_for_adoption }} </p>
        <p><strong>Current Pets:</strong> {{ $toAdoupt->current_pets }} </p>
        <p><strong>Availability:</strong> {{ $toAdoupt->availability }} </p>
        <p><strong>Pet Experience:</strong> {{ $toAdoupt->pet_experience }} </p>
        <p><strong>Contact Info:</strong> {{ $toAdoupt->contact_info }} </p>
        <p><strong>Address:</strong> {{ $toAdoupt->address }} </p>

       
        <form id="statusForm" action="{{ route('toAdoupts.update', $toAdoupt->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager' )
                <!-- Accept and Reject buttons outside the modal -->
                <button type="button" class="btn btn-outline-info btn-fw" onclick="confirmUpdate(event, 'Accept')">Accept</button>
                <button type="button" class="btn btn-outline-danger" onclick="confirmUpdate(event, 'Reject')">Reject</button>
            @endif
            <a href="{{ route('toAdoupts.index') }}" class="btn btn-outline-secondary">Back to list</a>
        </form>
        
        <!-- The Edit Modal -->
        <div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
            <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                <h5 id="modalTitle">Update Adoption Status</h5>
                
                <!-- Reason of Reject Input Field (hidden initially) -->
                <div class="form-group" id="reasonGroup" style="display: none;">
                    <label for="reason_of_reject">Reason of Reject</label>
                    <input type="text" class="form-control" id="reason_of_reject" placeholder="Enter reason for rejection" name="reason_of_reject">
                </div>
        
                <button id="confirmButton" class="btn btn-outline-info btn-fw">Confirm</button>
                <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
            </div>
        </div>
        
        <script>
            function confirmUpdate(event, status) {
                event.preventDefault(); // Prevent form submission
                var modal = document.getElementById('editModal');
                var reasonGroup = document.getElementById('reasonGroup');
                var modalTitle = document.getElementById('modalTitle');
                var confirmButton = document.getElementById('confirmButton');
                
                // Show the modal
                modal.style.display = 'flex';
        
                // Set up the modal title and input visibility based on status
                if (status === 'Reject') {
                    modalTitle.textContent = "Reject Adoption";
                    reasonGroup.style.display = 'block'; // Show the reason of reject input
                    confirmButton.className = 'btn btn-outline-danger'; // Change confirm button to Reject color
                } else {
                    modalTitle.textContent = "Accept Adoption";
                    reasonGroup.style.display = 'none'; // Hide the reason of reject input
                    confirmButton.className = 'btn btn-outline-info btn-fw'; // Keep confirm button in Accept color
                }
        
                // When "Confirm" is clicked, submit the form with the selected status
                confirmButton.onclick = function () {
                    var form = document.getElementById('statusForm');
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'status';
                    input.value = status;
                    form.appendChild(input);
        
                    // If status is "Reject", append the reason to the form as well
                    if (status === 'Reject') {
                        var reasonInput = document.getElementById('reason_of_reject');
                        if (reasonInput && reasonInput.value) {
                            var reason = document.createElement('input');
                            reason.type = 'hidden';
                            reason.name = 'reason_of_reject';
                            reason.value = reasonInput.value;
                            form.appendChild(reason);
                        }
                    }
        
                    form.submit(); // Submit the form
                    modal.style.display = 'none'; // Close the modal
                };
        
                // When "Cancel" is clicked, hide the modal
                document.getElementById('cancelButton').onclick = function () {
                    modal.style.display = 'none';
                };
            }
        </script>
        
        
@endsection
