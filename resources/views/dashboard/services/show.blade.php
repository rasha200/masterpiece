@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Name:</strong> {{ $service->name }}</p>
        <p><strong>Price:</strong> ${{ $service->price }}</p>
        <p><strong>Small Description:</strong> {{ $service->small_description }}</p>
        <p><strong>Description:</strong> {{ $service->description }}</p>
       
        <div class="form-group">
   
    <p><strong>Service images:</strong></p>
    <div class="row">
        @foreach ($serviceImages as $serviceImage)
            <div class="col-md-4 mb-3"> 
                <img src="{{ asset($serviceImage->image) }}" class="img-fluid rounded" alt="Service Image"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
        @endforeach
    </div>
</div>

    
        <a href="{{ route('services.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection