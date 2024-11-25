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
                          <td> 
                            {{ optional($ToAdoupt->user)->Fname ?? 'Deleted User' }} {{ optional($ToAdoupt->user)->Lname ?? '' }}
                          </td>
                          <td>
                            {{ optional($ToAdoupt->pet)->name ?? 'Deleted pet' }} 
                          </td>
                          
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

                 <!-- Custom Pagination -->
                 <div class="d-flex justify-content-center mt-2">
                  <div class="flex-c-m flex-w w-full p-t-38">
                    {{-- Loop through the pages --}}
                    @foreach ($ToAdoupts->getUrlRange(1, $ToAdoupts->lastPage()) as $page => $url)
                        @if ($page == $ToAdoupts->currentPage())
                            <a href="{{ $url }}" 
                               class="flex-c-m how-pagination1 m-all-7 active-pagination1"
                               style="background-color: #14535F; color: white; border-radius: 5px; padding: 8px 12px;">
                                {{ $page }}
                            </a>
                        @else
                            <a href="{{ $url }}" 
                               class="flex-c-m how-pagination1 m-all-7"
                               style="color: #14535F; border: 1px solid #14535F; border-radius: 5px; padding: 8px 12px; transition: background-color 0.3s, color 0.3s;"
                               onmouseover="this.style.backgroundColor='#14535F'; this.style.color='white';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#14535F';">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                  </div>
                </div>

                </div>
              </div>





@endsection
