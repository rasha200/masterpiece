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

             
             @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 0px; ">
        {{ session('success') }}
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

<div class="form-group">
  <label>Current Pet Images</label><br>
  <div class="row">
      @foreach ($petImages as $petImage)
          <div class="col-md-4 mb-3"> 
              <img src="{{ asset($petImage->image) }}" class="img-fluid rounded" alt="Pet Image"
                   style="height: 200px; object-fit: cover; width: 100%;">
                   <form action="{{ route('pet_images.destroy', $petImage->id) }}" method="POST"  title="Delete">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                      <button type="submit" class="btn btn-outline-secondary btn-rounded btn-icon" 
                          onclick="confirmDeletion(event, '{{ route('pet_images.destroy', $petImage->id) }}')"
                          style="margin: 10px;">
                           <i class="mdi mdi mdi-delete text-danger"></i>
                      </button>
                  </form>
          </div>
      @endforeach
  </div>
</div>
                   
                    <form id="profileForm" class="forms-sample" action="{{ route('pets.update',$pet->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label for="image">Choose pet images</label>
                          <input type="file" name="image[]" id="image" class="form-control" multiple/>
                    </div>

                    <div class="form-group">
                      <label for="image">Current pet vaccinations image</label><br>
                      @if($pet->pet_vaccinations_image)
                          <img src="{{ asset('uploads/pet/' . $pet->pet_vaccinations_image) }}" alt="Pet vaccinations image" style="width: 100px;">
                          <input type="hidden" name="pet_vaccinations_image"id="pet_vaccinations_image">
                      @else
                          <span>No image available</span>
                      @endif
                  </div>

                  <div class="form-group">
                    <label for="image">Upload new pet vaccinations image</label>
                    <input type="file" name="pet_vaccinations_image" id="pet_vaccinations_image" class="form-control">
              </div>


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
                        <label for="exampleInputName1">Special needs</label>
                        <input type="text" class="form-control" id="Special_needs" placeholder="Special needs" name="Special_needs" value="{{$pet->Special_needs}}" >
                      </div>

                      
                      <button type="button" id="editButton" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('pets.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

             
             <!-- Image Deletion Confirmation Modal -->
<div id="confirmationModalDelete"
style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
<div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
    <p>Are you sure you want to delete this image?</p>
    <button id="confirmButtonDelete" class="btn btn-outline-danger">Delete</button>
    <button id="cancelButtonDelete" class="btn btn-outline-secondary">Cancel</button>
</div>
</div>

<!-- Service Update Confirmation Modal -->
<div id="confirmationModalUpdate"
style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
<div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
    <h5>Are you sure you want to edit this pet?</h5>
    <button id="confirmButtonUpdate" class="btn btn-outline-info btn-fw">Edit</button>
    <button id="cancelButtonUpdate" class="btn btn-outline-secondary">Cancel</button>
</div>
</div>

<script>
// Function for Confirming Deletion of Image
function confirmDeletion(event, url) {
    event.preventDefault(); // Prevent the form submission
    var modal = document.getElementById('confirmationModalDelete');
    var confirmButton = document.getElementById('confirmButtonDelete');
    var cancelButton = document.getElementById('cancelButtonDelete');

    // Show the confirmation modal
    modal.style.display = 'flex';

    // Set up the confirm button to submit the form
    confirmButton.onclick = function () {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = url;

        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        var methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();
    };

    // Set up the cancel button to hide the modal
    cancelButton.onclick = function () {
        modal.style.display = 'none';
    };
}

// Function for Confirming Update of Service
document.getElementById('editButton').onclick = function (event) {
    event.preventDefault(); // Prevent the form submission
    var modal = document.getElementById('confirmationModalUpdate');
    modal.style.display = 'flex'; // Show the modal
};

document.getElementById('confirmButtonUpdate').onclick = function () {
    document.getElementById('profileForm').submit(); // Submit the form
};

document.getElementById('cancelButtonUpdate').onclick = function () {
    document.getElementById('confirmationModalUpdate').style.display = 'none'; // Hide the modal
};
</script>
          
@endsection
