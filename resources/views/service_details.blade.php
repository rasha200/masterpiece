@extends('layouts.user_side_master')

@section('content')

 <!--==========================================  (ٌService)  =====================================================-->
 <div class="container" style="margin-top: 50px;">
    <div class="bread-crumb flex-w  p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="{{ route('services') }}" class="stext-109 cl8 hov-cl1 trans-04">
           Services
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $service->name }}
        </span>
    </div>
</div>
<section class="bg0 p-t-52 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!--  -->
                    <div class="row">
                        @foreach ($serviceImages->slice(0, 3) as $serviceImage)
                            <div class="col-md-4 mb-3"> 
                                <img src="{{ asset($serviceImage->image) }}" class="img-fluid rounded" alt="Service Image"
                                     style="height: 200px; object-fit: cover; width: 100%;">
                            </div>
                       
                   
                       
                        @endforeach
                    </div>

                    <div class="p-t-32">
                        <span class="flex-w flex-m stext-111 cl2 p-b-19">
                            <span>
                                <span class="cl4">By</span> Service Team
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                Highly Recommended
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span>
                                ({{ count($servicefeedbacks) }} Reviews)
                                <span class="cl12 m-l-4 m-r-6">|</span>
                            </span>

                            <span style="color:#f9ba48;">
                                @for ($i = 1; $i <= 5; $i++)
                                <i class="zmdi {{ $i <= $averageRating ? 'zmdi-star' : 'zmdi-star-outline' }}"></i>
                            @endfor
                            </span>
                        </span>

                        <h4 class="ltext-109 cl2 p-b-28">
                            {{ $service->name }}
                        </h4>

                        <p class="stext-117 cl6 p-b-26">
                            {{ $service->description }}                       
                         </p>

                          

                       
                    </div>

                    <h4 class="ltext-109 cl2 p-t-28 p-b-28">
                        Book appointment
                    </h4>

                    <div class="p-t-40">
                        <!-- Availability Form -->
                        <form method="GET" action="{{ route('service_details', $service->id) }}" id="availability-form">
                            @csrf
                            <div class="bor8 m-b-20 p-tb-15 p-lr-20 bg-light shadow-sm">
                                <label for="appointment-date" class="stext-111 cl2 m-b-10 d-block font-weight-bold">Select a Date:</label>
                                <input 
                                    type="date" 
                                    id="appointment-date" 
                                    name="date" 
                                    class="stext-111 cl2 size-116 p-lr-15 border rounded shadow-sm" 
                                    value="{{ request('date', now()->format('Y-m-d')) }}" 
                                    min="{{ now()->startOfDay()->format('Y-m-d') }}" 
                                    max="{{ now()->endOfWeek(Carbon\Carbon::THURSDAY)->format('Y-m-d') }}"
                                    onchange="this.form.submit()"> <!-- Auto-submit form on date change -->
                            </div>
                        </form>
                    
                        <!-- Time Slots Section -->
                        @if(count($timeSlots) > 0)
                            <h3 class="stext-102 cl3 p-b-20 m-t-30 font-weight-bold">Available Slots for {{ request('date') }}</h3>
                            <div class="flex-w wrap-buttons m-b-20">
                                @foreach($timeSlots as $slot)
                                    <button 
                                        type="button" 
                                        class="slot-button attribute-option stext-102 cl2 size-72 m-r-5 m-tb-4" 
                                        data-start="{{ $slot['start_time'] }}" 
                                        data-end="{{ $slot['end_time'] }}">
                                        {{ $slot['start_time'] }}
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <p class="stext-102 cl6 p-b-20 text-center">No available slots for {{ request('date') }}</p>
                        @endif

                        <script>
                            // Wait for the DOM to load
                            document.addEventListener('DOMContentLoaded', function () {
                                // Select all buttons with the class 'attribute-option'
                                const buttons = document.querySelectorAll('.attribute-option');
                        
                                // Add a click event listener to each button
                                buttons.forEach(function(button) {
                                    button.addEventListener('click', function() {
                                        // Toggle the 'active' class on the clicked button
                                        button.classList.toggle('active');
                                    });
                                });
                            });
                        </script>

                        <style>
                           .variation-group {
    margin-bottom: 15px;
}

.variation-title {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
}

.variation-options {
    display: flex;
    flex-wrap: wrap;
}

.attribute-option {
    padding: 8px 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 5px;
    cursor: pointer;
    transition: border-color 0.3s, background-color 0.3s;
}

.color-option {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    padding: 0;
    margin-right: 10px;
}

.attribute-option:hover,
.color-option:hover {
    border-color: #ffa500;
}

.attribute-option.active,
.color-option.active {
    border-color: #ffa500;
    background-color: #ffe4b5; /* Highlight color */
}

                            </style>



                    
                        <!-- Booking Form -->
                        <form method="POST" action="{{ route('appointments.store') }}" id="booking-form">
                            @csrf
                            <div class="bor8 m-b-20 p-tb-15 p-lr-20 bg-light shadow-sm">
                                <input type="number" name="pet_number" placeholder="Pet Number *" class="stext-111 cl2 size-116 p-lr-15 border rounded shadow-sm" required>
                            </div>
                            <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
                            <input type="hidden" value="{{ $service->id }}" name="service_id">
                            <input type="hidden" name="status" value="Pending">
                            <input type="hidden" id="appointment_datetime" name="appointment_datetime">
                    
                            <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Book Appointment
                            </button>
                        </form>
                    </div>
                     
                    
                    
                    
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                       $(document).ready(function () {
                        // Handle slot selection
                        $('.slot-button').click(function () {
                            var selectedStartTime = $(this).data('start');
                            var selectedDate = $('#appointment-date').val();
                    
                            if (!selectedDate) {
                                alert('Please select a date first.');
                                return;
                            }
                    
                            // Combine selected date and time into a datetime value
                            var appointmentDatetime = selectedDate + ' ' + selectedStartTime;
                            $('#appointment_datetime').val(appointmentDatetime);
                    
                            // Highlight selected slot
                            $('.slot-button').removeClass('selected');
                            $(this).addClass('selected');
                        });
                    
                        // Restrict this submit handler to the booking form only
                        $('#booking-form').submit(function (e) {
                            if (!$('#appointment_datetime').val()) {
                                alert('Please select a time slot before booking.');
                                e.preventDefault(); // Prevent the form from submitting
                            }
                        });
                    });
                    
                    </script> 







 <!--==========================================  (ٌReview)  =====================================================-->
 <div class="bor10 m-t-50 p-t-43 p-b-40">
    <!-- Tab01 -->
    <div class="tab01">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item p-b-10">
                <a class="nav-link active" data-toggle="tab" href="#reviews" role="tab">Reviews ({{ count($servicefeedbacks) }})</a>
            </li>

            

            <li class="nav-item p-b-10">
                <a class="nav-link" data-toggle="tab" href="#add_review" role="tab">Add Review</a>
            </li>
        </ul>



        <!----------- Reviews ------------->
        <div class="tab-content p-t-43">
            <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                <div class="how-pos2 p-lr-15-md">
                    @foreach ($servicefeedbacks as $servicefeedback)
                    <div class="flex-w flex-t p-b-68">
                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                            <img src="{{asset('images/user 2.webp')}}" alt="AVATAR">
                        </div>

                        <div class="size-207">
                           
                                <span class="fs-18 cl11">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="zmdi {{ $i <= $servicefeedback->rating ? 'zmdi-star' : 'zmdi-star-outline' }}"></i>
                                    @endfor
                                </span>
                                <br>

                                <p class="mtext-107 cl2 p-r-20">
                                   
                                    {{$servicefeedback->feedback}}
                                </p>
                                

                                <p class="stext-102 cl6">
                                    {{ optional($servicefeedback->user)->Fname ?? 'Unknown User' }} {{ optional($servicefeedback->user)->Lname ?? '' }}
                                </p>

                               <p class="stext-102 cl6">
                                    {{$servicefeedback->created_at->format('Y-m-d')}}
                               </p>

                               @if(Auth::id() === $servicefeedback->user_id)
                               <!-- Edit Icon -->
                               <a href="javascript:void(0);" onclick="toggleEditForm({{ $servicefeedback->id }})" class="edit-icon">
                                   <button style="border:solid 1px #14535F; background-color:#14535F;" title="Edit">
                                       <i class=" zmdi zmdi-edit" style="padding: 3px; color:#FFF;"></i>
                                   </button>
                               </a>

                               
                               
           
                               <!-- Edit Form (initially hidden) -->
                               <div id="edit-form-{{ $servicefeedback->id }}" style="display: none; margin-top: 10px;">
                                   <form action="{{ route('serviceFeedbacks.update', $servicefeedback->id) }}" method="POST">
                                       @csrf
                                       @method('PUT')
                                    
                                       
                                       <div class="flex-w flex-m p-t-50 p-b-23">
                                           <span class="stext-102 cl3 m-r-16">
                                               Your Rating *
                                           </span>
                   
                                           <span class="wrap-rating fs-18 cl11 pointer">
                                               <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(1)"></i>
                                               <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(2)"></i>
                                               <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(3)"></i>
                                               <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(4)"></i>
                                               <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(5)"></i>
                                               <input class="dis-none" type="hidden" name="rating" id="rating" value="{{ $servicefeedback->rating }}" required>
                                           </span>
                                       </div>
                                       
        <script>
            // Function to update the stars based on the rating
            function setRating(rating) {
                // Set the hidden input field's value
                document.getElementById('rating').value = rating;

                // Update star visuals based on selected rating
                const stars = document.querySelectorAll('.item-rating');
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('zmdi-star'); // Filled star class
                        star.classList.remove('zmdi-star-outline'); // Outline star class
                    } else {
                        star.classList.add('zmdi-star-outline');
                        star.classList.remove('zmdi-star');
                    }
                });
            }

            // Function to initialize the stars based on the existing rating
            window.onload = function() {
                const existingRating = {{ $servicefeedback->rating }};
                setRating(existingRating);
            }
        </script>
                                       <div class="bor8 m-b-20 how-pos4-parent">
                                           <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="feedback" placeholder="Your feedback" value="{{ $servicefeedback->feedback }}" required>
                                       </div>
                                       <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
                                       <input type="hidden" value="{{ $service->id }}" name="service_id">
           
                                       <button type="submit" class="btn btn-primary mt-2" style="background-color: #14535F">Save</button>
                                       <button type="button" class="btn btn-secondary mt-2" onclick="toggleEditForm({{ $servicefeedback->id }})">Cancel</button>
                                   </form>
                               </div>








                               
                               @endif


                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <script>
                function toggleEditForm(feedbackId) {
                    const editForm = document.getElementById(`edit-form-${feedbackId}`);
                    if (editForm.style.display === 'none') {
                        editForm.style.display = 'block';
                    } else {
                        editForm.style.display = 'none';
                    }
                }
            </script>

            <!-- - -->
         

            <!-------------- Success & error modal ------------->
            @if (Session::get('success'))

                <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
                    <div class="swal-modal">
                        <div class="swal-icon swal-icon--success">
                            <span class="swal-icon--success__line swal-icon--success__line--long"></span>
                            <span class="swal-icon--success__line swal-icon--success__line--tip"></span>
                            <div class="swal-icon--success__ring"></div>
                            <div class="swal-icon--success__hide-corners"></div>
                        </div>
                
                        <div class="swal-title" style="">{{ Session::get('success') }}</div>
                
                        <div class="swal-footer">
                            <div class="swal-button-container">
                                <a href="{{ route('service_details', ['id' => $service->id]) }}" class="swal-button swal-button--confirm">OK</a>
                                <div class="swal-button__loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @elseif (Session::get('error'))
                 <div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
                    <div class="swal-modal">
                        <div class="swal-icon swal-icon--error">
                            <div class="swal-icon--error__x-mark">
                                <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                                <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                            </div>
                        </div>
                        
                
                        <div class="swal-title" style="">{{ Session::get('error') }}</div>
                
                        <div class="swal-footer">
                            <div class="swal-button-container">
                                <a href="{{ route('login') }}" class="swal-button swal-button--confirm">Login</a>
                                <div class="swal-button__loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif   



             <!-------------------- Add review -------------->
            <div class="tab-pane fade" id="add_review" role="tabpanel">
                <div class="row">
                    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                        <div class="p-b-30 m-lr-15-sm">
                           
                            <form class="w-full" action="{{ route('serviceFeedbacks.store') }}" method="POST">
                                @csrf
                                <h5 class="mtext-108 cl2 p-b-7">
                                    Add a review
                                </h5>

                                <p class="stext-102 cl6">
                                   Required fields are marked *
                                </p>

                                <div class="flex-w flex-m p-t-30 p-b-23">
                                    <span class="stext-102 cl3 m-r-16">
                                        Your Rating <span id="rating-warning" style="color: red;">*Required*</span>
                                    </span>

                                    <span class="wrap-rating fs-18 cl11 pointer">
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(1)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(2)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(3)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(4)"></i>
                                        <i class="item-rating pointer zmdi zmdi-star-outline" onclick="setRating(5)"></i>
                                        <input class="dis-none" type="hidden" name="rating" id="rating" value="" required>
                                    </span>
                                </div>

                                <script>
                                    function setRating(rating) {
                                        document.getElementById('rating').value = rating;
                                        // Update star visuals based on selected rating
                                        const stars = document.querySelectorAll('.item-rating');
                                        stars.forEach((star, index) => {
                                            if (index < rating) {
                                                star.classList.add('zmdi-star'); // Filled star class
                                                star.classList.remove('zmdi-star-outline'); // Outline star class
                                            } else {
                                                star.classList.add('zmdi-star-outline');
                                                star.classList.remove('zmdi-star');
                                            }
                                        });
                                    }
                                </script>

                        <div class="row p-b-25">
                              <div class="col-12 p-b-5">
                                 <label class="stext-102 cl3" for="review">Your Review *</label>
                                 <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="feedback" name="feedback" required>{{ old('feedback') }}</textarea>
                              </div>

                              <div class="col-12 p-b-5">
                                 <label class="stext-102 cl3" for="name">Name *</label>
                                 <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name"
                                 value="{{ auth()->check() ? auth()->user()->Fname . ' ' . auth()->user()->Lname : '' }}" required>
                              </div>

                                 <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
                                 <input type="hidden" value="{{ $service->id }}" name="service_id">

                             <div class="col-12 p-b-5">
                                  <label class="stext-102 cl3" for="email">Email *</label>
                                  <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email"
                                  value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                             </div>
                        </div>

                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Submit
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!--==========================================  (ٌReview)  =====================================================-->


                    
                  





                    
                </div>
            </div>

           
        </div>
    </div>
</section>

@endsection