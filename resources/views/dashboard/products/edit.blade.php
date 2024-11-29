@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit product</h4>

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

             <div class="form-group">
              <label>Current Product Images</label><br>
              <div class="row">
                  @foreach ($productImages as $productImage)
                      <div class="col-md-4 mb-3"> 
                          <img src="{{ asset($productImage->image) }}" class="img-fluid rounded" alt="Product Image"
                               style="height: 200px; object-fit: cover; width: 100%;">
                               <form action="{{ route('product_images.destroy', $productImage->id) }}" method="POST"  title="Delete">
                                  @csrf
                                  @method('DELETE')
                                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                                  <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" 
                                      onclick="confirmDeletion(event, '{{ route('product_images.destroy', $productImage->id) }}')"
                                      style="margin: 10px;">
                                       <i class="mdi mdi mdi-delete text-danger"></i>
                                  </button>
                              </form>
                      </div>
                  @endforeach
              </div>
            </div>
                   
                    <form id="profileForm" class="forms-sample" action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label for="image">Choose product images</label>
                          <input type="file" name="image[]" id="image" class="form-control" multiple/>
                        </div>
                        

                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$product->name}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Small Description</label>
                        <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{$product->small_description}}" required>
                      </div>



                      <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ $product->description }}</textarea>
                      </div>


          
                      <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{$product->price}}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="quantity" name="quantity" value="{{$product->quantity}}" min="1" step="1">
                      </div>

                     

                      
                      <div class="form-group">
                        <label for="exampleSelectGender">Category name</label>
                        <select  class="form-control form-control-sm" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                            <option @selected($category->id == $product->category_id) value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                           

                        </select>
                      </div>

                      
                      <button type="button" id="editButton"  class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('products.index')}}" class="btn btn-outline-secondary">Cancel</a>
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
    <h5>Are you sure you want to edit this product?</h5>
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
