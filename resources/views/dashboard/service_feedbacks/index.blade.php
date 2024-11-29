@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="title-1">Service Feedbacks for<span style="color:#F79257"> ({{ $service_name }}) </span></h2>

  <a href="{{route('services.index')}}">
    <button type="button" class="btn btn-outline-info btn-fw">
       Back to service list
    </button>
</a>    </div>

     
    

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
                         
                          <th>Rating</th>
                          <th>Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($serviceFeedbacks as $serviceFeedback)
                        <tr>
                          <td>{{$serviceFeedback->id}}</td>
                          <td>{{ optional($serviceFeedback->user)->Fname ?? 'Unknown User' }} {{ optional($serviceFeedback->user)->Lname ?? '' }}</td>
                          <td>
                            <span class="fs-18 cl11">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="zmdi {{ $i <= $serviceFeedback->rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="color: #f9ba48;"></i>
                            @endfor
                            </span>
                          </td>
                          <td>{{$serviceFeedback->created_at->format('Y-m-d')}}</td>

                          <td> 

                            
                          <a href="{{ route('serviceFeedbacks.show', ['service_id' => $serviceFeedback->service_id, 'serviceFeedback' => $serviceFeedback->id]) }}"  title="View">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-eye text-success"></i>
                          </button>
                          </a>


                          @if(Auth::user()->role == 'manager')
                          <form action="{{ route('serviceFeedbacks.destroy', $serviceFeedback->id) }}" method="POST" style="display:inline;" title="Delete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"  onclick="confirmDeletion(event, '{{ route('serviceFeedbacks.destroy', $serviceFeedback->id) }}')">
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

                  <!-- Custom Pagination -->
<div class="d-flex justify-content-center mt-2">
  <div class="flex-c-m flex-w w-full p-t-38">
    {{-- Loop through the pages --}}
    @foreach ($serviceFeedbacks->getUrlRange(1, $serviceFeedbacks->lastPage()) as $page => $url)
        @if ($page == $serviceFeedbacks->currentPage())
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

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this review?</p>
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
