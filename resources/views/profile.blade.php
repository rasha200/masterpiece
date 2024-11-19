@extends('layouts.user_side_master')

@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center">
        Profile
    </h2>
</section>    

<div class="container mt-5">
    <div class="row">
        <!----------------- Sidebar for Profile Navigation ---------------------->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="profile-sidebar card p-3">
                <div class="profile-photo text-center mb-3">
                    <img src="{{asset('images/user 2.webp')}}" alt="User Photo" class="rounded-circle" width="100">
                </div>
                <h4 class="text-center">{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h4>
                <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" data-toggle="tab" href="#profile" role="tab">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#adoption-requests" role="tab">Adoption Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#orders" role="tab">Order History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#appointments" role="tab">Your Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                </ul>
                
            </div>
        </div>

              


        <div class="col-lg-9 col-md-8 mb-5">
            <div class="card p-4">
                <div class="tab-content">
  <!------------------- Edit profile ------------------->
  <div class="tab-pane fade show active" id="profile" role="tabpanel">
    <h3 class="mb-4">My Profile</h3>
    <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
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
       
        <button type="button" class="btn btn-primary" style="background-color: #14535F; margin-top: 0px;" data-toggle="modal" data-target="#confirmEditModal">Save</button>
    </form>


  </div>

  <!-- Modal for Confirming Profile Edit -->
<div class="modal fade" id="confirmEditModal" tabindex="-1" aria-labelledby="confirmEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmEditModalLabel">Confirm Profile Edit</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to save the changes to your profile?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="background-color: #14535F;" id="confirmEditButton">Yes, Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    // JavaScript to handle form submission on confirmation
    document.getElementById('confirmEditButton').addEventListener('click', function() {
        document.getElementById('profile-form').submit(); // Submit the form if confirmed
    });
</script>



  <!--------------------------- Adoption Requests Tab -------------------------->
                    <div class="tab-pane fade" id="adoption-requests" role="tabpanel">
                        <h3 class="mb-4">Adoption Requests</h3>

                        @if($adoptionRequests->isEmpty())
                        <p>Here you will see your adoption requests</p>
                    @else
                       

                        <!-- Adoption Request Cards -->
                        @foreach ($adoptionRequests as $adoptRequest)
                            <div class="adoption-request-card mb-4">
                                <div class="row">
                                    <!-- Pet Image -->
                                    <div class="col-md-3">  
                                        <img src=" {{ asset($adoptRequest->pet->pet_images[0]->image) }}" alt="Pet Image" class="img-fluid rounded">
                                    </div>
                                    <!-- Request Details -->
                                    <div class="col-md-7">
                                        <h5>{{ $adoptRequest->pet->name }}</h5>
                                        <p><strong>Adoption Date:</strong> {{ $adoptRequest->created_at->format('d M, Y') }}</p>
                                       
                                    @if($adoptRequest->status == "Cancelled" )
                                    <p><strong>Status:</strong> 
                                     <span > You have Cancelled this adoption request</span>
                                    </p>

                                     @else
                                    <p><strong>Status:</strong> 
                                        <span class="badge 
                                        {{ $adoptRequest->status == 'Reject' ? 'badge-danger' : '' }}
                                        {{ $adoptRequest->status == 'Pending' ? 'badge-warning' : '' }}
                                        {{ $adoptRequest->status == 'Accept' ? 'badge-success' : '' }}">
                                        {{ ucfirst($adoptRequest->status) }}
                                    </span>
                                    </p>
                                    @endif

                                    @if($adoptRequest->status == "Reject")
                                   
                                    <p><strong>{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</strong> Thank you for your interest in adopting {{ $adoptRequest->pet->name }}. Unfortunately, your adoption request has been rejected. We appreciate your time and understanding. Please feel free to check for other pets available for adoption.</p>
                              
                                @endif


                                @if($adoptRequest->status == "Accept") 
                                   
                                <p><strong>{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</strong> Congratulations! Your adoption request for {{ $adoptRequest->pet->name }} has been approved. We will contact you with further details soon</p>
                              
                                @endif


                                    @if($adoptRequest->status == "Pending")
                                   
                                        <button class="btn btn-danger custom-btn" data-toggle="modal" data-target="#cancelModal{{ $adoptRequest->id }}" style="margin-top:18px; background-color: #A71619; padding:0px !important; width:120px !important; height : 40px !important;  border-radius: 20px !important;">Cancel Adoption</button>
                                   
                                    @endif
                                    </div>
                                    
                                </div>
                            </div>

                    
                    
            <!------------------------------------------- Modal to Confirm Cancellation -------------------------------------------------->
<div class="modal fade" id="cancelModal{{ $adoptRequest->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $adoptRequest->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel{{ $adoptRequest->id }}">Confirm Cancellation</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel the adoption request for {{ $adoptRequest->pet->name }}?
            </div>
            <div class="modal-footer">
                <form action="{{ route('toAdoupts_user.update', $adoptRequest->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Cancelled">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #A71619">Yes, Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

                        @endforeach
                        @endif
                    </div>

<!-----------------------------(Orders) -------------------------------------------------->
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                        <h3 class="mb-4">Order History</h3>
                        <p>Here you will see your order history.</p>
                    </div>


<!-----------------------------------(Appointments) -------------------------------------------------->

                    <div class="tab-pane fade" id="appointments" role="tabpanel">
                        <h3 class="mb-4">Your Appointments</h3>

                        @if($adoptionRequests->isEmpty())
                        <p>Here you will see your appointments.</p>
                    @else
                       

                        <!-- Adoption Request Cards -->
                        @foreach ($UserAppointments as $UserAppointment)
                            <div class="adoption-request-card mb-4">
                                <div class="row">
                                    <!-- Pet Image -->
                                    <div class="col-md-3">  
                                        @if($UserAppointment->service->service_images->isNotEmpty())
                                        <img src=" {{ asset($UserAppointment->service->service_images[0]->image) }}" alt="Pet Image" class="img-fluid rounded">
                                        @else
                                        <span>No image available</span>
                                      @endif
                                    </div>
                                    <!-- Request Details -->
                                    <div class="col-md-7">
                                        <h5>Service name: {{ $UserAppointment->service->name }}</h5>
                                        <p><strong>Appointment date:</strong>{{ $UserAppointment->day }}</p>
                                        <p><strong>Start time:</strong>{{ \Carbon\Carbon::parse($UserAppointment->start_time)->format('h:i A') }} <strong>End time:</strong> {{ \Carbon\Carbon::parse($UserAppointment->end_time)->format('h:i A') }}</p>
                                        <p><strong>Pet number:</strong>{{ $UserAppointment->pet_number }}  </p>

                                       
                                    @if($UserAppointment->status == "Cancelled" )
                                    <p><strong>Status:</strong> 
                                     <span > You have Cancelled this appointment</span>
                                    </p>

                                     @else
                                    <p><strong>Status:</strong> 
                                        <span class="badge 
                                        {{ $UserAppointment->status == 'Reject' ? 'badge-danger' : '' }}
                                        {{ $UserAppointment->status == 'Pending' ? 'badge-warning' : '' }}
                                        {{ $UserAppointment->status == 'Accept' ? 'badge-success' : '' }}">
                                        {{ ucfirst($UserAppointment->status) }}
                                    </span>
                                    </p>
                                    @endif

                                    @if($UserAppointment->status == "Reject")
                                   
                                    <p><strong>{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</strong> Your appointment has been rejected. Please contact us for further assistance.</p>
                              
                                @endif


                                @if($UserAppointment->status == "Accept") 
                                   
                                <p><strong>{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</strong> Your appointment has been confirmed. See you soon!</p>
                              
                                @endif


                                @if($UserAppointment->status == "Pending" || $UserAppointment->status == "Accept")
                                @php
                                    // Extract the appointment date from the `day` column (e.g., "Friday 2024-11-22")
                                    $appointmentDate = \Carbon\Carbon::createFromFormat('l Y-m-d', $UserAppointment->day, 'Asia/Amman');
                            
                                    // Combine the date and the `start_time` to form the start datetime
                                    $appointmentStartTime = $appointmentDate->setTimeFromTimeString($UserAppointment->start_time);
                            
                                    // Combine the date and the `end_time` to form the end datetime
                                    $appointmentEndTime = $appointmentDate->setTimeFromTimeString($UserAppointment->end_time);
                            

                                    $appointmentDateTime = $appointmentDate->setTimeFromTimeString($UserAppointment->start_time);

                                    // Get the current time
                                    $currentTime = \Carbon\Carbon::now('Asia/Amman');
                            
                                    // Calculate the difference in minutes between now and the appointment start time
                                    $timeDifference = $currentTime->diffInMinutes($appointmentDateTime, false); // Use `false` for past/future difference
                            
                                    // Check if the appointment has ended
                                    $hasEnded = $currentTime->greaterThan($appointmentEndTime);

                                   

                                @endphp
                            
                                {{-- Check if appointment has ended --}}
                                @if($hasEnded && $UserAppointment->status !== "Reject" && $UserAppointment->status !== "Cancelled")
                                    <p style="color: green; font-weight: bold;">This appointment has ended.</p>
                                @else
                                    {{-- Show cancel button logic based on time difference if appointment is not ended --}}
                                    @if($timeDifference >= 240) {{-- 240 minutes = 4 hours --}}
        <button class="btn btn-danger custom-btn" data-toggle="modal" data-target="#cancelModalAppointment{{ $UserAppointment->id }}" style="margin-top:18px; background-color: #A71619; padding:0px !important; width:120px !important; height : 40px !important; border-radius: 20px !important;">Cancel Adoption</button>
    @else
        <button class="btn btn-secondary custom-btn" disabled style="margin-top:18px; padding:0px !important; width:120px !important; height : 40px !important; border-radius: 20px !important;">Cancel (Not Allowed)</button>
    @endif
                                @endif
                            @endif
                            

                            
                            
                                    </div>
                                    
                                </div>
                            </div>

                          
                    
                    
            <!------------------------------------------- Modal to Confirm Cancellation -------------------------------------------------->
<div class="modal fade" id="cancelModalAppointment{{ $UserAppointment->id }}"  tabindex="-1" aria-labelledby="cancelModalLabel{{ $UserAppointment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel{{ $UserAppointment->id }}">Confirm Cancellation</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this appointment?
            </div>
            <div class="modal-footer">
                <form action="{{ route('appointments_user.update', $UserAppointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Cancelled">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #A71619">Yes, Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endforeach
@endif

                       
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>











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
                <div class="swal-button-container">
                    <a href="{{ route('profile.show') }}" class="swal-button swal-button--confirm">OK</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
