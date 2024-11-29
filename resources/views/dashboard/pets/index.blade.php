@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
<h2 class="title-1">Pets</h2>

        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager' )
        <a href="{{ route('pets.create') }}">
            <button type="button" class="btn btn-outline-info btn-fw">
                <i class="zmdi zmdi-plus"></i> Add new pet
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
                          <th>Age</th>
                          <th>Gender</th>
                          <th>Type</th>
                          <th>Image</th>
                          <th>Is Adopte</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pets as $pet)
                        <tr>
                          <td>{{$pet->id}}</td>
                          <td>{{$pet->name}}</td>
                          <td>{{$pet->age}} </td>
                          <td>{{$pet->gender}}</td>
                          <td>{{$pet->type}}</td>
                          <td>
                            @if($pet->pet_images->isNotEmpty())
                
                            <img src="{{ asset($pet->pet_images[0]->image) }}" alt="{{ $pet->name }}" style="width: 50px; border-radius: 50px;" />
                        @else
                            <span>No image available</span>
                        @endif
</td> 
                          <td>{{$pet->is_adopted}}</td>


                         
                          <td> 

                            
                          <a href="{{ route('pets.show', $pet->id) }}"  title="View">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-eye text-success"></i>
                          </button>
                          </a>


                           @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager' )
                          <a href="{{ route('pets.edit', $pet->id) }}"  title="Edit">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-rename-box text-primary"></i>
                          </button>
                          </a>
                          
                          <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" style="display:inline;" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"  onclick="confirmDeletion(event, '{{ route('pets.destroy', $pet->id) }}')">
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
                    @foreach ($pets->getUrlRange(1, $pets->lastPage()) as $page => $url)
                        @if ($page == $pets->currentPage())
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
        <p>Are you sure you want to delete this pet?</p>
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
