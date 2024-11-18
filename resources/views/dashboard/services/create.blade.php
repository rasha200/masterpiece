@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Service</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                   
                    <form class="forms-sample" action="{{ route('services.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Small Description</label>
                        <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{ old('small_description') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ old('description') }}</textarea>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{ old('price') }}" required>
                      </div>


                      <div class="form-group">
                        <label for="average_time">Average time (in minutes)</label>
                        <input type="number" class="form-control" id="average_time" name="average_time" 
                               value="{{ old('average_time') }}" placeholder="Enter time in minutes" 
                               required min="1" step="1">
                        <small id="average_time_help" class="form-text text-muted">Please enter the average time in minutes.</small>
                    </div>

                     
                      <div class="form-group">
                            <label for="image">Choose service images</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple/>
                      </div>


                     
                      <button type="submit" class="btn btn-outline-info btn-fw">Create</button>
                      <a href="{{route('services.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
