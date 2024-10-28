@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>

        <p><strong>Image:</strong></p>
        @if($product->image)
                <img src="{{ asset('uploads/product/' . $product->image) }}" alt="product Image" style="width:20%; margin-bottom: 15px;">
            @else
                <span style="color: #666; font-style: italic;">No image</span>
            @endif
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p><strong>Category name:</strong> {{ $product->category->name }}</p> 
        
    
        <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection