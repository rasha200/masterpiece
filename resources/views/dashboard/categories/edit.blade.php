@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
                   
                    <form id="profileForm" class="forms-sample" action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
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


                      
                      <button type="button" id="editButton" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('categories.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

              
              <div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                    <h5>Are you sure you want to edit this category?</h5>
                    <button id="confirmButton" class="btn btn-outline-info btn-fw">Edit</button>
                    <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </div>


            <script>
              // Get the modal
              var modal = document.getElementById('confirmationModal');
              var form = document.getElementById('profileForm');
          
              // Show the modal when the user clicks the "Edit" button
              document.getElementById('editButton').onclick = function (event) {
                  event.preventDefault(); // Prevent form submission
                  modal.style.display = 'flex'; // Show the modal
              };
          
              // Set up the confirm button to submit the form
              document.getElementById('confirmButton').onclick = function () {
                  form.submit(); // Submit the form
              };
          
              // Set up the cancel button to close the modal
              document.getElementById('cancelButton').onclick = function () {
                  modal.style.display = 'none'; // Hide the modal
              };
          </script>

@endsection
