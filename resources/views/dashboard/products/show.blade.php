@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p><strong>Category name:</strong> {{ $product->category->name }}</p> 
        
    
        <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection