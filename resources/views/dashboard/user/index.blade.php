@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Users</h2>
        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager'|| Auth::user()->role == 'receptionist')
        <a href="{{ route('users.create') }}">
            <button type="button" class="btn-gradient-info">
                <i class="zmdi zmdi-plus"></i> Add New User
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
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Email</th>
                          <th>Phone number</th>
                          <th>role</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{$user->id}}</td>
                          <td>{{$user->Fname}}</td>
                          <td > {{$user->Lname}} </td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->mobile}}</td>

                          @if($user->role == 'manager')
                              <td><label class="badge badge-primary">{{$user->role}}</label></td>

                          @elseif($user->role == 'veterinarian')
                              <td><label class="badge badge-dark">{{$user->role}}</label></td>

                          @elseif($user->role == 'store_manager' )
                            <td><label class="badge badge-info">{{$user->role}}</label></td>

                          @elseif($user->role == 'receptionist' )
                              <td><label class="badge badge-success">{{$user->role}}</label></td>

                          @elseif($user->role == 'user' )
                            <td><label class="badge badge-danger">{{$user->role}}</label></td>

                          @endif
                          <td> 
                            
                          <a href="{{ route('users.show', $user->id) }}"  title="view">
                                <button type="submit" class="btn btn-gradient-success btn-rounded btn-icon">
                                  <i class="fa-solid fa-eye"></i>
                                </button>
                          </a>

                           @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager'|| Auth::user()->role == 'receptionist')
                          <a href="{{ route('users.edit', $user->id) }}"  title="Edit">
                                <button type="submit" class="btn btn-gradient-info btn-rounded btn-icon">
                                  <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                          </a>
                          
                          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" title="delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger btn-rounded btn-icon" onclick="confirmDeletion(event, '{{ route('users.destroy', $user->id) }}')">
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
