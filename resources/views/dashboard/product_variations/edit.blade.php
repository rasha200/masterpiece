@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit product varient for the <span style="color:#F79257"> ({{ $product_name }}) </span> </h4>

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


                   
                    <form id="profileForm" class="forms-sample" action="{{ route('productVariations.update',$productVariation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                      <div class="form-group">
                        <label for="exampleInputName1">Size</label>
                        <input type="text" class="form-control" id="size" placeholder="Size" name="size" value="{{$productVariation->size}}" >
                      </div>


                      <div class="form-group">
                        <label for="color">Color</label>
                        <input type="color" class="form-control" id="color" name="color" value="{{ old('color', $productVariation->color) }}">
                    </div>
                    
                   

                      <div class="form-group">
                        <label for="exampleInputEmail3">Flavour</label>
                        <input type="text" class="form-control" id="flavour" placeholder="Flavour" name="flavour" value="{{$productVariation->flavour}}" >
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Age group</label>
                        <input type="text" class="form-control" id="age_group" placeholder="Age group" name="age_group" value="{{$productVariation->age_group}}" >
                      </div>


                      <div class="form-group">
                        <label for="exampleSelectGender">Disinfected</label>
                        <select class="form-control" id="disinfected" name="disinfected" >
                          <option value="" ></option>
                          <option value="yes"   {{ $productVariation->disinfected == 'yes' ? 'selected' : '' }}>Yes</option>
                          <option value="no" {{ $productVariation->disinfected == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                      </div>

                      <input type="hidden" value="{{ $product->id }}" name="product_id">


                      <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{$productVariation->price}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="{{$productVariation->quantity}}" required>
                      </div>

                      
                 

                   

                   
                      
                      <button type="button" id="editButton" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{ route('productVariations.index', $product->id) }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

             
            

<!-- Service Update Confirmation Modal -->
<div id="confirmationModalUpdate"
style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
<div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
    <h5>Are you sure you want to edit this product variant?</h5>
    <button id="confirmButtonUpdate" class="btn btn-outline-info btn-fw">Edit</button>
    <button id="cancelButtonUpdate" class="btn btn-outline-secondary">Cancel</button>
</div>
</div>

<script>


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
