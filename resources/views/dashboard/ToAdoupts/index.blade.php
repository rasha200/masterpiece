@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
<h2 class="title-1">Adoption Requests</h2>

        
    </div>

     
   

    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px; ">
        {{ session('success') }}
    </div>
@endif

<div class=" grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    </p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>User Name</th>
                          <th>Pet Name</th>
                          <th>status</th>
                          <th>Date</th>
                         
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($ToAdoupts as $ToAdoupt)
                        <tr>
                          <td>{{$ToAdoupt->id}}</td>
                          <td>{{$ToAdoupt->user->Fname}} {{$ToAdoupt->user->Lname}}</td>
                          <td>{{$ToAdoupt->pet->name}} </td>
                          
                          @if($ToAdoupt->status == 'Accept')
                             <td><label class="badge badge-danger">{{$ToAdoupt->status}}</label></td>

                          @elseif($ToAdoupt->status == 'Pending')
                            <td><label class="badge badge-success">{{$ToAdoupt->status}}</label></td>
                           

                          @elseif($ToAdoupt->status == 'Reject' || $ToAdoupt->status == 'Cancelled')
                          <td><label class="badge badge-info" style="background-color:#A71619">{{$ToAdoupt->status}}</label></td>

                          @endif


                          <td>{{$ToAdoupt->created_at->format('Y-m-d')}}</td>
 
                        


                         
                          <td> 

                            @if($ToAdoupt->status == 'Accept' || $ToAdoupt->status == 'Reject' || $ToAdoupt->status == 'Pending') 
                          <a href="{{ route('toAdoupts.show', $ToAdoupt->id) }}"  title="View">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-eye text-success"></i>
                          </button>
                          </a>
                          @endif


                         
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>





@endsection
