@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Name:</strong> {{ $service->name }}</p>
        <p><strong>Description:</strong> {{ $service->description }}</p>
      
    
        <a href="{{ route('services.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection