@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>User Name:</strong> {{$contact->user->Fname}} {{$contact->user->Lname}}</p>
        <p><strong>User Email:</strong> {{$contact->user->email}}</p>

       
        <p><strong>Subject:</strong> {{$contact->subject}}</p>
        <p><strong>Message:</strong> {{$contact->message}}</p>
       
        
    
        <a href="{{ route('contacts.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection