@extends('layouts.dashboard_master')


@section('content')
<div class="card">
<div class="card-body" style="border: 1px solid #e7dee9;">
        
        <p><strong>First name:</strong> {{ $user->Fname }}</p>
        <p><strong>Last name:</strong> {{ $user->Lname }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone number:</strong> {{ $user->mobile }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>

    
        <a href="{{ route('users.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>
@endsection