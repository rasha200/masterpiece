@extends('layouts.dashboard_master')


@section('content')
<div class="card">
    <div class="card-body">
        
        <p><strong>Name:</strong> {{ $pet->name }}</p>
        <p><strong>Age:</strong> {{ $pet->age }}</p>
        <p><strong>Gender:</strong> {{ $pet->gender }}</p>
        <p><strong>Type:</strong> {{ $pet->type }}</p>
        <p><strong>Information:</strong> {{ $pet->information }}</p> 
        <p><strong>Is adopted:</strong> {{ $pet->is_adopted }}</p>
    
        <a href="{{ route('pets.index') }}" class="btn btn-gradient-primary me-2">Back to List</a>
       
    </div>
</div>
@endsection