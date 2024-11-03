@extends('layouts.dashboard_master')



@section('content')
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Service</h4>

                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif

             @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 0px; ">
        {{ session('success') }}
    </div>
@endif

<div class="form-group">
    <label>Current Images</label><br>
    <div class="row">
        @foreach ($serviceImages as $serviceImage)
            <div class="col-md-4 mb-3"> 
                <img src="{{ asset($serviceImage->image) }}" class="img-fluid rounded" alt="Service Image"
                     style="height: 200px; object-fit: cover; width: 100%;">
                     <form action="{{ route('service_images.destroy', $serviceImage->id) }}" method="POST"  title="Delete">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <button type="submit" class="btn btn-outline-secondary btn-rounded btn-icon" 
                            onclick="confirmDeletion(event, '{{ route('service_images.destroy', $serviceImage->id) }}')"
                            style="margin: 10px;">
                             <i class="mdi mdi mdi-delete text-danger"></i>
                        </button>
                    </form>
            </div>
        @endforeach
    </div>
</div>
                   
                    <form class="forms-sample" action="{{ route('services.update',$service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="image">Choose service images</label>
                            
                            <input type="file" name="image[]" id="image" class="form-control" multiple/>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$service->name}}" required>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="{{$service->price}}" required>
                      </div>

                      
                      <div class="form-group">
                        <label for="exampleInputName1">Small Description</label>
                        <input type="text" class="form-control" id="small_description" placeholder="Small Description" name="small_description" value="{{$service->small_description}}" required>
                      </div>



                      <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <textarea class="form-control" id="description" placeholder="Description" name="description" required>{{ $service->description }}</textarea>
                      </div>


                      
                      <button type="submit" class="btn btn-outline-info btn-fw">Edit</button>
                      <a href="{{route('services.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this image?</p>
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
