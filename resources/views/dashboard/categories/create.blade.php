@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add new category</h4>

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
                   
                    <form class="forms-sample" action="{{ route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                            <label for="image">Choose Category Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                      </div>

                      
                      <button type="submit" class="btn btn-outline-info btn-fw">Create</button>
                      <a href="{{route('categories.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
