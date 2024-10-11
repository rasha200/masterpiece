@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add new service</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                   
                    <form class="forms-sample" action="{{ route('services.store')}}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{ old('description') }}" required>
                      </div>

                     
                      <button type="submit" class="btn btn-gradient-info me-2">Create</button>
                      <a href="{{route('services.index')}}" class="btn btn-light">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
