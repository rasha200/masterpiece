@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add new pet</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                   
                    <form class="forms-sample" action="{{ route('pets.store')}}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Age</label>
                        <input type="text" class="form-control" id="age" placeholder="Age" name="age" value="{{ old('age') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                          <option value="male"  {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Pet type</label>
                        <input type="text" class="form-control" id="type" placeholder="Pet type" name="type" value="{{ old('type') }}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Pet information</label>
                        <input type="text" class="form-control" id="information" placeholder="Pet information" name="information" value="{{ old('information') }}" required>
                      </div>

                      <button type="submit" class="btn btn-outline-info btn-fw">Create</button>
                      <a href="{{route('pets.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
