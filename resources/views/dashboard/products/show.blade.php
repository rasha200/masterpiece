@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Small Description:</strong> {{ $product->small_description }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        {{-- <p><strong>Quantity:</strong> {{ $product->quantity }}</p> --}}
        <p><strong>Category name:</strong> {{ $product->category->name }}</p> 
        <div class="form-group">
            <p><strong>Product Images:</strong></p> 
            <div class="row">
                @foreach ($productImages as $productImage)
                    <div class="col-md-4 mb-3"> 
                        <img src="{{ asset($productImage->image) }}" class="img-fluid rounded" alt="Product Image"
                             style="height: 200px; object-fit: cover; width: 100%;">
                    </div>
                @endforeach
            </div>
        </div>
    
        <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection