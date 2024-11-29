@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit availability times for the <span style="color:#F79257"> ({{ $service_name }}) </span> </h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif

             
             @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 0px; ">
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


                   
                    <form id="profileForm" class="forms-sample" action="{{ route('availabilityTimes.update',$availabilityTime->id) }}" method="POST" >
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label for="day_of_week">Day of week</label>
                          <select class="form-control" id="day_of_week" name="day_of_week">
                              <option value="">Select a day</option>
                              <option value="Monday" {{ $availabilityTime->day_of_week == 'Monday' ? 'selected' : '' }}>Monday</option>
                              <option value="Tuesday" {{ $availabilityTime->day_of_week == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                              <option value="Wednesday" {{ $availabilityTime->day_of_week == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                              <option value="Thursday" {{ $availabilityTime->day_of_week == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                              <option value="Friday" {{ $availabilityTime->day_of_week == 'Friday' ? 'selected' : '' }}>Friday</option>
                              <option value="Saturday" {{ $availabilityTime->day_of_week == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                              <option value="Sunday" {{ $availabilityTime->day_of_week == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                          </select>
                      </div>


                      <div class="form-group">
                        <label for="color">Start time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($availabilityTime->start_time)->format('H:i') }}" >
                    </div>
                    
                   

                      <div class="form-group">
                        <label for="exampleInputEmail3">End time</label>
                        <input type="time" class="form-control" id="end_time"  name="end_time" value="{{ \Carbon\Carbon::parse($availabilityTime->end_time)->format('H:i') }}" >
                      </div>

                      
                      <input type="hidden" value="{{ $service->id }}" name="service_id">


                     
                      
                      <button type="button" id="editButton" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{ route('availabilityTimes.index', $service->id) }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

             
            

<!-- Service Update Confirmation Modal -->
<div id="confirmationModalUpdate"
style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
<div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
    <h5>Are you sure you want to edit this availability time?</h5>
    <button id="confirmButtonUpdate" class="btn btn-outline-info btn-fw">Edit</button>
    <button id="cancelButtonUpdate" class="btn btn-outline-secondary">Cancel</button>
</div>
</div>

<script>


// Function for Confirming Update of Service
document.getElementById('editButton').onclick = function (event) {
    event.preventDefault(); // Prevent the form submission
    var modal = document.getElementById('confirmationModalUpdate');
    modal.style.display = 'flex'; // Show the modal
};

document.getElementById('confirmButtonUpdate').onclick = function () {
    document.getElementById('profileForm').submit(); // Submit the form
};

document.getElementById('cancelButtonUpdate').onclick = function () {
    document.getElementById('confirmationModalUpdate').style.display = 'none'; // Hide the modal
};
</script>
          
@endsection
