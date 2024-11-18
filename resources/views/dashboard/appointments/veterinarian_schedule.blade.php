@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
<h2 class="title-1">Your Schedule</h2>

        
    </div>

     
   

    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px; ">
        {{ session('success') }}
    </div>
@endif

<div class=" grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    </p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>User Name</th>
                          <th>Date</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Service Name</th>
                          <th>Pet number</th>
                          <th>Appointment Duration</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                          <td>{{$appointment->id}}</td>
                          <td> 
                            {{ optional($appointment->user)->Fname ?? 'Deleted User' }} {{ optional($appointment->user)->Lname ?? '' }}
                          </td>

                          <td>{{ $appointment->day }}</td>
                        
                          <td>  {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
                          <td>  {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</td>


                          <td>
                            {{ optional($appointment->service)->name ?? 'Deleted service' }} 
                          </td>
                     
                          <td>
                            {{ $appointment->pet_number}} 
                          </td>

                          <td>{{ $appointment->formattedDuration }}</td>
 
                        


                         
                         
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

          

                </div>
              </div>





@endsection
