@extends('layouts.dashboard_master')


@section('content')
<div class="card">
    <div class="card-body" style="border: 1px solid #e7dee9;">
        <p><strong>Name:</strong> {{ $category->name }}</p>

    @if($category->image)
                <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Category Image" style="width:20%; border-radius: 8px; margin-bottom: 15px;">
            @else
                <span style="color: #666; font-style: italic;">No image</span>
            @endif
    <br>
      
    
        <a href="{{ route('categories.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection