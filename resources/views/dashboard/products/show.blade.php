@extends('layouts.dashboard_master')


@section('content')
<div class="card">
    <div class="card-body">
        
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p><strong>Category name:</strong> {{ $product->category->name }}</p> 
        
    
        <a href="{{ route('products.index') }}" class="btn btn-gradient-primary me-2">Back to List</a>
       
    </div>
</div>
@endsection