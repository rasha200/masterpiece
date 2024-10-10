@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit pet</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
                   
                    <form class="forms-sample" action="{{ route('pets.update',$pet->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$user->name}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Age</label>
                        <input type="text" class="form-control" id="age" placeholder="Age" name="age" value="{{$user->age}}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                          <option value="male"  {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Pet Type</label>
                        <input type="text" class="form-control" id="type" placeholder="Pet Type" name="type" value="{{$user->type}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Pet Information</label>
                        <input type="text" class="form-control" id="information" placeholder="Pet Information" name="information" value="{{$user->information}}" required>
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
