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
                   
                    <form class="forms-sample" action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">First Name</label>
                        <input type="text" class="form-control" id="Fname" placeholder="First name" name="Fname" value="{{$user->Fname}}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Last Name</label>
                        <input type="text" class="form-control" id="Lname" placeholder="Last name" name="Lname" value="{{$user->Lname}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{$user->email}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Phone number</label>
                        <input type="text" class="form-control" id="mobile" placeholder="First name" name="mobile" value="{{$user->mobile}}" required>
                      </div>

                      
                      <div class="form-group">
                        <label for="exampleSelectGender">Role</label>
                        <select class="form-control" id="role" name="role" required>

                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian' || Auth::user()->role == 'receptionist')
                          <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        @endif

                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian')
                          <option value="receptionist" {{ $user->role == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        @endif

                        @if(Auth::user()->role == 'manager')
                          <option value="veterinarian" {{ $user->role == 'veterinarian' ? 'selected' : '' }}>Veterinarian</option>
                         @endif
                        </select>
                      </div>

                      
                      <button type="submit" class="btn btn-gradient-info me-2">Edit</button>
                      <a href="{{route('users.index')}}" class="btn btn-light">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
