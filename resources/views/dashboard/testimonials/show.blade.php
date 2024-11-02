@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
    

        <p><strong>User Name:</strong> {{$testimonial->user->Fname}} {{$testimonial->user->Lname}}</p>
        <p><strong>User Email:</strong> {{$testimonial->user->email}}</p>
        <p><strong>Date:</strong> {{$testimonial->created_at->format('Y-m-d')}}</p>

        <p><strong>Feedback:</strong> {{$testimonial->message}}</p>
       
        
    
        <a href="{{ route('testimonials.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection