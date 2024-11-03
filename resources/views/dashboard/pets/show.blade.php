@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Name:</strong> {{ $pet->name }}</p>
        <p><strong>Age:</strong> {{ $pet->age }}</p>
        <p><strong>Gender:</strong> {{ $pet->gender }}</p>
        <p><strong>Type:</strong> {{ $pet->type }}</p>
        <p><strong>Information:</strong> {{ $pet->information }}</p> 
        <p><strong>Special needs:</strong> {{ $pet->Special_needs }}</p>
        <p><strong>Is adopted:</strong> {{ $pet->is_adopted }}</p>

        <div class="form-group">
            <p><strong>Pet Vaccinations Image:</strong></p> 
    
            @if($pet->pet_vaccinations_image)
                    <img src="{{ asset('uploads/pet/' . $pet->pet_vaccinations_image) }}" alt="Pet vaccinations image" style="width:20%; border-radius: 8px; margin-bottom: 15px;">
                @else
                    <span style="color: #666; font-style: italic;">No image</span>
                @endif
            </div>
            
    <div class="form-group">
        <p><strong>Pet Images:</strong></p> 
        <div class="row">
            @foreach ($petImages as $petImage)
                <div class="col-md-4 mb-3"> 
                    <img src="{{ asset($petImage->image) }}" class="img-fluid rounded" alt="Pet Image"
                         style="height: 200px; object-fit: cover; width: 100%;">
                </div>
            @endforeach
        </div>
    </div>
        <a href="{{ route('pets.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection