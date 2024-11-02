@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>Date:</strong>{{$contact->created_at->format('Y-m-d H:i')}}</p>
        <p><strong>User Name:</strong> {{$contact->Fname}} {{$contact->Lname}}</p>
        <p><strong>User Email:</strong> {{$contact->email}}</p>
        <p><strong>Subject:</strong> {{$contact->subject}}</p>
        <p><strong>Message:</strong> {{$contact->message}}</p>
        
       
        
    
        <a href="{{ route('contacts.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection