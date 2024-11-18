@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add new product varient for the <span style="color:#F79257"> ({{ $product_name }}) </span></h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                   
                    <form class="forms-sample" action="{{ route('productVariations.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Size</label>
                        <input type="text" class="form-control" id="size" placeholder="Size" name="size" value="{{ old('size') }}" >
                      </div>

                     
                      <div class="form-group">
                        <label for="color">Color</label>
                        <input type="color" class="form-control" id="color" name="color" value="{{ old('color') }}">
                    </div>
                    
                    <script>
                      // When the form is submitted, update the hidden input with the selected color
                      document.querySelector('form').addEventListener('submit', function(event) {
                          var colorInput = document.getElementById('color');
                          var colorValue = colorInput.value;
                  
                          // If no color is selected or the default black color is selected, set the hidden input to null
                          if (colorValue === '' || colorValue === '#000000') {
                              document.getElementById('color_hidden').value = ''; // Set to null if no color is selected
                          } else {
                              document.getElementById('color_hidden').value = colorValue; // Set to selected color
                          }
                      });
                  </script>
                  
                  
                  
                     
                      <div class="form-group">
                        <label for="exampleInputEmail3">Flavour</label>
                        <input type="text" class="form-control" id="flavour" placeholder="Flavour" name="flavour" value="{{ old('flavour') }}" >
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Age group</label>
                        <input type="text" class="form-control" id="age_group" placeholder="Age group" name="age_group" value="{{ old('age_group') }}" >
                      </div>


                      <div class="form-group">
                        <label for="exampleSelectGender">Disinfected</label>
                        <select class="form-control" id="disinfected" name="disinfected" >
                          <option value="" ></option>
                          <option value="yes"  {{ old('disinfected') == 'yes' ? 'selected' : '' }}>Yes</option>
                          <option value="no" {{ old('disinfected') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                      </div>


                      <input type="hidden" value="{{ $product->id }}" name="product_id">

            
                      <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{ old('price') }}" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" required min="1" step="1">
                      </div>

                      <button type="submit" class="btn btn-outline-info btn-fw">Create</button>
                      <a href="{{ route('productVariations.index', $product->id) }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
