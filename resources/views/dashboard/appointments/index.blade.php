@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
<h2 class="title-1">Appointment Requests</h2>

        
    </div>

     
   

    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px; ">
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
                          <th>status</th>
                          <th>Date</th>
                         
                          <th></th>
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
                          
                          @if($appointment->status == 'Accept')
                             <td><label class="badge badge-danger">{{$appointment->status}}</label></td>

                          @elseif($appointment->status == 'Pending')
                            <td><label class="badge badge-success">{{$appointment->status}}</label></td>
                           

                          @elseif($appointment->status == 'Reject' || $appointment->status == 'Cancelled')
                          <td><label class="badge badge-info" style="background-color:#A71619">{{$appointment->status}}</label></td>

                          @endif


                          <td>{{$appointment->created_at->format('Y-m-d')}}</td>
 
                        


                         
                          <td> 

                            @if($appointment->status == 'Accept' || $appointment->status == 'Reject' || $appointment->status == 'Pending') 
                          <a href="{{ route('appointments.show', $appointment->id) }}"  title="View">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-eye text-success"></i>
                          </button>
                          </a>
                          @endif


                         
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                 <!-- Custom Pagination -->
                 <div class="d-flex justify-content-center mt-2">
                  <div class="flex-c-m flex-w w-full p-t-38">
                    {{-- Loop through the pages --}}
                    @foreach ($appointments->getUrlRange(1, $appointments->lastPage()) as $page => $url)
                        @if ($page == $appointments->currentPage())
                            <a href="{{ $url }}" 
                               class="flex-c-m how-pagination1 m-all-7 active-pagination1"
                               style="background-color: #14535F; color: white; border-radius: 5px; padding: 8px 12px;">
                                {{ $page }}
                            </a>
                        @else
                            <a href="{{ $url }}" 
                               class="flex-c-m how-pagination1 m-all-7"
                               style="color: #14535F; border: 1px solid #14535F; border-radius: 5px; padding: 8px 12px; transition: background-color 0.3s, color 0.3s;"
                               onmouseover="this.style.backgroundColor='#14535F'; this.style.color='white';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#14535F';">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                  </div>
                </div>

                </div>
              </div>





@endsection
