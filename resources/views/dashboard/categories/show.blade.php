@extends('layouts.dashboard_master')


@section('content')
<div class="card">
    <div class="card-body">
    @if($category->image)
                <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category Image" style="width:20%; border-radius: 8px; margin-bottom: 15px;">
            @else
                <span style="color: #666; font-style: italic;">No Image</span>
            @endif
        <p><strong>Name:</strong> {{ $category->name }}</p>
    
      
    
        <a href="{{ route('categories.index') }}" class="btn btn-gradient-primary me-2">Back to List</a>
       
    </div>
</div>
@endsection