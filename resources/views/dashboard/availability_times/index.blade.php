@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center ">



<h2 class="title-1">Availability times for <a href="{{route('services.index')}}" style="color:#F79257" title="Back to list"> ({{ $service_name }}) </a></h2>

<div class="d-flex flex-column justify-content-center align-items-center mb-4">
  @if(Auth::user()->role == 'manager' || Auth::user()->role == 'receptionist')

        <a href="{{ route('availabilityTimes.create' , $service_id ) }}">
            <button type="button" class="btn btn-outline-info btn-fw">
                <i class="zmdi zmdi-plus"></i> Add availability times
            </button>
        </a>
        @endif
    </div>
  </div>

   
     
   

    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px; ">
        {{ session('success') }}
    </div>
@endif

<div class=" grid-margin stretch-card" >
                <div class="card" >
                  <div class="card-body">
                   
                    </p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Day</th>
                          <th>Start time</th>
                          <th>End time</th>
                          <th>Is Available</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($AvailabilityTimes as $AvailabilityTime)
                        <tr>
                          <td>{{$AvailabilityTime->id}}</td>
                          <td>{{$AvailabilityTime->day_of_week}}</td>
                          <td>{{ \Carbon\Carbon::parse($AvailabilityTime->start_time)->format('h:i A') }}</td>
                          <td>{{ \Carbon\Carbon::parse($AvailabilityTime->end_time)->format('h:i A') }}</td>
                          <td>{{$AvailabilityTime->is_available}}</td>
                          <td> 
                      @if(Auth::user()->role == 'manager' || Auth::user()->role == 'receptionist')

                          <a href="{{ route('availabilityTimes.edit', [$service_id, $AvailabilityTime->id]) }}"  title="Edit">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-rename-box text-primary"></i>
                          </button>
                          </a>
                          
                          <form action="{{ route('availabilityTimes.destroy', [$service_id, $AvailabilityTime->id]) }}" method="POST" style="display:inline;" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"  onclick="confirmDeletion(event, '{{ route('availabilityTimes.destroy', [$service_id, $AvailabilityTime->id]) }}')">
                                                   <i class="mdi mdi mdi-delete text-danger"></i>
                                                </button>
                          </form>
                        @endif                
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

             

                </div>
              </div>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this availability time?</p>
        <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission -. تريد منع نموذج من الإرسال عند النقر على زر الإرسال
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function () {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            // "hidden" يُستخدم للإشارة إلى طرق مختلفة لجعل العناصر غير مرئية أو مخفية
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
