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
                   
                    <form class="forms-sample" action="{{ route('pets.update',$pet->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$pet->name}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Age</label>
                        <input type="text" class="form-control" id="age" placeholder="Age" name="age" value="{{$pet->age}}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                          <option value="male"   {{ $pet->gender == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ $pet->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Pet type</label>
                        <input type="text" class="form-control" id="type" placeholder="Pet type" name="type" value="{{$pet->type}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Pet information</label>
                        <input type="text" class="form-control" id="information" placeholder="Pet information" name="information" value="{{$pet->information}}" required>
                      </div>

                      
                      <div class="form-group">
                    <label for="image">Current image</label><br>
                    @if($pet->image)
                        <img src="{{ asset('uploads/pet/' . $pet->image) }}" alt="pet image" style="width: 100px; border-radius: 50px;">
                    @else
                        <span>No image available</span>
                    @endif
                </div>

                      <div class="form-group">
                            <label for="image">Upload new image</label>
                            <input type="file" name="image" id="image" class="form-control">
                      </div>

                      
                      <button type="submit" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('pets.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
