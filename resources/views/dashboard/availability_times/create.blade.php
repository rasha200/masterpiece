@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add availability times for the <span style="color:#F79257"> ({{ $service_name }}) </span></h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                   
                    <form class="forms-sample" action="{{ route('availabilityTimes.store')}}" method="POST" >
                        @csrf
                        <div class="form-group">
                          <label for="day_of_week">Day of week</label>
                          <select class="form-control" id="day_of_week" name="day_of_week">
                              <option value="">Select a day</option>
                              <option value="Monday" {{ old('day_of_week') == 'Monday' ? 'selected' : '' }}>Monday</option>
                              <option value="Tuesday" {{ old('day_of_week') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                              <option value="Wednesday" {{ old('day_of_week') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                              <option value="Thursday" {{ old('day_of_week') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                              <option value="Friday" {{ old('day_of_week') == 'Friday' ? 'selected' : '' }}>Friday</option>
                              <option value="Saturday" {{ old('day_of_week') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                              <option value="Sunday" {{ old('day_of_week') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                          </select>
                      </div>

                     
                      <div class="form-group">
                        <label for="color">Start time</label>
                        <input type="time" class="form-control" id="start_time" placeholder="Start time" name="start_time" value="{{ old('start_time') }}">
                    </div>
                    
                   
                      <div class="form-group">
                        <label for="exampleInputEmail3">End time</label>
                        <input type="time" class="form-control" id="end_time" placeholder="End time" name="end_time" value="{{ old('end_time') }}" >
                      </div>


                      <input type="hidden" value="{{ $service->id }}" name="service_id">
                      <input type="hidden" value="true" name="is_available">

          

                      <button type="submit" class="btn btn-outline-info btn-fw">Create</button>
                      <a href="{{ route('availabilityTimes.index', $service->id) }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
