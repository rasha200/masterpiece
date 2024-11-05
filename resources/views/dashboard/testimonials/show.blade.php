@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
    

        <p><strong>User Name:</strong> {{ optional($testimonial->user)->Fname ?? 'Unknown User' }} {{ optional($testimonial->user)->Lname ?? '' }}</p>
        <p><strong>User Email:</strong> {{ optional($testimonial->user)->email ?? '' }}</p>
        <p><strong>Date:</strong> {{$testimonial->created_at->format('Y-m-d')}}</p>
        <p><strong>Rating:</strong>
            <span class="fs-18 cl11">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="zmdi {{ $i <= $testimonial->rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="color: #f9ba48;"></i>
                @endfor
            </span>
            
            
            </p>
        <p><strong>Feedback:</strong> {{$testimonial->message}}</p>
       
        
    
        <a href="{{ route('testimonials.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection