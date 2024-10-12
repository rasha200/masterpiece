@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit service</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
                   
                    <form class="forms-sample" action="{{ route('services.update',$service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$service->name}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{$service->description}}" required>
                      </div>

                     

                      
                      <button type="submit" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('services.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
