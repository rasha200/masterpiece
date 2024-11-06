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
                           

                          @elseif($ToAdoupt->status == 'Reject' )
                          <td><label class="badge badge-info" style="background-color:#A71619">{{$ToAdoupt->status}}</label></td>

                          @endif


                          <td>{{$ToAdoupt->created_at->format('Y-m-d')}}</td>
 
                        


                         
                          <td> 

                            
                          <a href="{{ route('toAdoupts.show', $ToAdoupt->id) }}"  title="View">
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                            <i class="mdi mdi mdi-eye text-success"></i>
                          </button>
                          </a>


                           @if(Auth::user()->role == 'manager' || Auth::user()->role == 'store_manager' )
                         
                          <form action="{{ route('toAdoupts.destroy', $ToAdoupt->id) }}" method="POST" style="display:inline;" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"  onclick="confirmDeletion(event, '{{ route('toAdoupts.destroy', $ToAdoupt->id) }}')">
                            <i class="mdi mdi mdi-delete text-danger"></i>
                          </button>
                                            </form>
                                            @endif
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this pet adoption Request?</p>
        <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission -. تريد منع نموذج من الإرسال عند النقر على زر الإرسال
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function () {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            // "hidden" يُستخدم للإشارة إلى طرق مختلفة لجعل العناصر غير مرئية أو مخفية
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
