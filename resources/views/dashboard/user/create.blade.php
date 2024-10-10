@extends('layouts.dashboard_master')


@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add new user</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                   
                    <form class="forms-sample" action="{{ route('users.store')}}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">First Name</label>
                        <input type="text" class="form-control" id="Fname" placeholder="First name" name="Fname" value="{{ old('Fname') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Last Name</label>
                        <input type="text" class="form-control" id="Lname" placeholder="Last name" name="Lname" value="{{ old('Lname') }}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Phone number</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Phone number" name="mobile" value="{{ old('mobile') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{ old('password') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword4">Confirm Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password_confirmation" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Role</label>
                        <select class="form-control" id="role" name="role" required>

                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian' || Auth::user()->role == 'receptionist')
                          <option value="user"  {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        @endif

                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian')
                          <option value="receptionist" {{ old('role') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        @endif

                        @if(Auth::user()->role == 'manager')
                          <option value="veterinarian" {{ old('role') == 'veterinarian' ? 'selected' : '' }}>Veterinarian</option>
                         @endif
                        </select>
                      </div>

                      
                      <button type="submit" class="btn btn-gradient-info me-2">Create</button>
                      <a href="{{route('users.index')}}" class="btn btn-light">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
