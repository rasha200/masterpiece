@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Date:</strong>{{$serviceFeedback->created_at->format('Y-m-d H:i')}}</p>
        <p><strong>User Name:</strong> {{ optional($serviceFeedback->user)->Fname ?? 'Unknown User' }} {{ optional($serviceFeedback->user)->Lname ?? '' }}</p>
        <p><strong>User Email:</strong>  {{ optional($serviceFeedback->user)->email ?? '' }}</p>
        <p><strong>Service Name:</strong> {{$serviceFeedback->service->name}}</p>
        <p><strong>Rating:</strong>
            <span class="fs-18 cl11">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="zmdi {{ $i <= $serviceFeedback->rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="color: #f9ba48;"></i>
                @endfor
            </span>
            
            
            </p>
        <p><strong>Review:</strong> {{$serviceFeedback->feedback}}</p>
        
       
        
    
        <a href="{{ route('serviceFeedbacks.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection