@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Servics</h2>

        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian')
        <a href="{{ route('services.create') }}">
            <button type="button" class="btn btn-outline-info btn-fw">
                <i class="zmdi zmdi-plus"></i> Add New Service
            </button>
        </a>
        @endif
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
                          <th>Name</th>
                          <th>Average time</th>
                          <th>image</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($services as $service)
                        <tr>
                          <td>{{$service->id}}</td>
                          <td>{{$service->name}}</td>
                          <td>{{$service->average_time}} minutes</td>
                          <td>
                          @if($service->service_images->isNotEmpty())
                
                <img src="{{ asset($service->service_images[0]->image) }}" alt="{{ $service->name }}" style="width: 50px; border-radius: 50px;" />
            @else
                <span>No image available</span>
            @endif
                            </td>

                          <td> 
                          <a href="{{ route('services.show', $service->id) }}"  title="View">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-eye text-success"></i>
                          </button>
                          </a>


                           @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian')
                          <a href="{{ route('services.edit', $service->id) }}"  title="Edit">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-rename-box text-primary"></i>
                          </button>
                          </a>
                          @endif

                          <a href="{{ route('availabilityTimes.index', $service->id) }}"  title="Add availability times">
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                              <i class="mdi mdi-calendar-clock text-info"></i>
                            </button>
                            </a>      

                         
                            <a href="{{ route('serviceFeedbacks.index', $service->id) }}"  title="View feedback">
                              <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="mdi mdi-comment-text-outline text-info"></i>
                              </button>
                              </a> 
                              
                              @if(Auth::user()->role == 'manager')
                              <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;" title="Delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"  onclick="confirmDeletion(event, '{{ route('services.destroy', $service->id) }}')">
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
        <p>Are you sure you want to delete this service?</p>
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
