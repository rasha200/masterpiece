@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit category</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
                   
                    <form class="forms-sample" action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$category->name}}" required>
                      </div>

                      <div class="form-group">
                    <label for="image">Current image</label><br>
                    @if($category->image)
                        <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category image" style="width: 100px;">
                    @else
                        <span>No image available</span>
                    @endif
                </div>

                      <div class="form-group">
                            <label for="image">Upload new image</label>
                            <input type="file" name="image" id="image" class="form-control">
                      </div>


                      
                      <button type="submit" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('categories.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
