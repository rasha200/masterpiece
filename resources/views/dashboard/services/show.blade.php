@extends('layouts.dashboard_master')


@section('content')
<div class="card">
    <div class="card-body">
        
        <p><strong>Name:</strong> {{ $service->name }}</p>
        <p><strong>Description:</strong> {{ $service->description }}</p>
      
    
        <a href="{{ route('services.index') }}" class="btn btn-gradient-primary me-2">Back to List</a>
       
    </div>
</div>
@endsection