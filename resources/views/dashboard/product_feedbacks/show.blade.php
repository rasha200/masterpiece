@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Date:</strong>{{$productFeedback->created_at->format('Y-m-d H:i')}}</p>
        <p><strong>User Name:</strong> {{ optional($productFeedback->user)->Fname ?? 'Unknown User' }} {{ optional($productFeedback->user)->Lname ?? '' }}</p>
        <p><strong>User Email:</strong> {{ optional($productFeedback->user)->email ?? '' }}</p>
        <p><strong>Product Name:</strong> {{$productFeedback->product->name}}</p>
        <p><strong>Rating:</strong>
            <span class="fs-18 cl11">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="zmdi {{ $i <= $productFeedback->rating ? 'zmdi-star' : 'zmdi-star-outline' }}" style="color: #f9ba48;"></i>
                @endfor
            </span>
            
            
            </p>
        <p><strong>Review:</strong> {{$productFeedback->feedback}}</p>
        
       
        

        <a href="{{ route('productFeedbacks.index', ['product_id' => $productFeedback->product_id]) }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection