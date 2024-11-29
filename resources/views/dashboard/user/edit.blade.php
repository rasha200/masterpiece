@extends('layouts.dashboard_master')


@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit user</h4>

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
                   
                    <form id="profileForm" class="forms-sample" action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">First name</label>
                        <input type="text" class="form-control" id="Fname" placeholder="First name" name="Fname" value="{{$user->Fname}}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Last name</label>
                        <input type="text" class="form-control" id="Lname" placeholder="Last name" name="Lname" value="{{$user->Lname}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{$user->email}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Phone number</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Phone number" name="mobile" value="{{$user->mobile}}" required>
                      </div>

                      
                      <div class="form-group">
                        <label for="exampleSelectGender">Role</label>
                        <select class="form-control" id="role" name="role" required>

                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian' || Auth::user()->role == 'store_manager' || Auth::user()->role == 'receptionist')
                          <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        @endif

                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian')
                        <option value="store_manager" {{ $user->role == 'store_manager' ? 'selected' : '' }}>Store Manager</option>
                          <option value="receptionist" {{ $user->role == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        @endif

                        @if(Auth::user()->role == 'manager')
                          <option value="veterinarian" {{ $user->role == 'veterinarian' ? 'selected' : '' }}>Veterinarian</option>
                         @endif
                        </select>
                      </div>

                      
                      <button type="button" id="editButton" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('users.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>


              <div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                    <h5>Are you sure you want to edit this user?</h5>
                    <button id="confirmButton" class="btn btn-outline-info btn-fw">Edit</button>
                    <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </div>


            <script>
              // Get the modal
              var modal = document.getElementById('confirmationModal');
              var form = document.getElementById('profileForm');
          
              // Show the modal when the user clicks the "Edit" button
              document.getElementById('editButton').onclick = function (event) {
                  event.preventDefault(); // Prevent form submission
                  modal.style.display = 'flex'; // Show the modal
              };
          
              // Set up the confirm button to submit the form
              document.getElementById('confirmButton').onclick = function () {
                  form.submit(); // Submit the form
              };
          
              // Set up the cancel button to close the modal
              document.getElementById('cancelButton').onclick = function () {
                  modal.style.display = 'none'; // Hide the modal
              };
          </script>
          

@endsection
