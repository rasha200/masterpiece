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
                   
                    <form class="forms-sample" action="{{ route('products.update',$product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$product->name}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{$product->description}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{$product->price}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="{{$product->quantity}}" required>
                      </div>

                      
                      <div class="form-group">
                        <label for="exampleSelectGender">Category name</label>
                        <select  class="form-control form-control-sm" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                            <option @selected($category->id == $product->category_id) value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                           

                        </select>
                      </div>

                      
                      <button type="submit" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('products.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

@endsection
