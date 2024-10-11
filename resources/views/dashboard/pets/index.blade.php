@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Pets</h2>

        @if(Auth::user()->role == 'receptionist' )
        <a href="{{ route('pets.create') }}">
            <button type="button" class="btn-gradient-info">
                <i class="zmdi zmdi-plus"></i> Add New Pet
            </button>
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class=" grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Age</th>
                          <th>Gender</th>
                          <th>Type</th>
                          <th>Is adote</th>
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
                          <td>{{$pet->is_adopted}}</td>


                         
                          <td> 

                            
                          <a href="{{ route('pets.show', $pet->id) }}"  title="view">
                                <button type="submit" class="btn btn-gradient-success btn-rounded btn-icon">
                                  <i class="fa-solid fa-eye"></i>
                                </button>
                          </a>


                           @if(Auth::user()->role == 'receptionist' )
                          <a href="{{ route('pets.edit', $pet->id) }}"  title="Edit">
                                <button type="submit" class="btn btn-gradient-info btn-rounded btn-icon">
                                  <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                          </a>
                          
                          <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" style="display:inline;" title="delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger btn-rounded btn-icon" onclick="confirmDeletion(event, '{{ route('pets.destroy', $pet->id) }}')">
                                                  <i class="mdi mdi-delete" ></i>
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
        <p>Are you sure you want to delete this user?</p>
        <button id="confirmButton" class="btn btn-outline-danger">delete</button>
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
