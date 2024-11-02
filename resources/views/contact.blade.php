@extends('layouts.user_side_master')

@section('content')

<!-- page title -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center">
        Connect with Us
    </h2>
</section>	


<!-- Contact page -->
<section class="bg0 p-t-104 p-b-10">
    <div class="container">
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
                                <a href="{{ route('contact') }}" class="swal-button swal-button--confirm">OK</a>
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
        <div class="flex-w flex-tr">

            <!-- Contact form -->
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                
                
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Send Us A Message
                    </h4>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="Fname" placeholder=" First Name" value="{{ old('Fname') }}" required>
                     
                    </div>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="Lname" placeholder=" Last Name" value="{{ old('Lname') }}" required>
                     
                    </div>


                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder=" Email Address" value="{{ old('email') }}" required>
                        <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
                    </div>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="subject" placeholder="Contact subject" value="{{ old('subject') }}" required>
                      
                    </div>

                    

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="How Can We Help?" required>{{ old('message') }}</textarea>
                    </div>

               
                      

                        <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer ">
                            Submit
                        </button>
                   
                    
                </form>
                
            </div>


            <!-- Add testimonial -->

            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form action="{{ route('testimonials.store') }}" method="POST">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">Leave a Review</h4>
            
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="name" placeholder="Your Name" 
                        value="{{ auth()->check() ? auth()->user()->Fname . ' ' . auth()->user()->Lname : '' }}" required>
                    </div>
            
                    <input type="hidden" value="{{ auth()->check() ? auth()->user()->id : '' }}" name="user_id">
            
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Your Email Address" 
                        value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                        <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
                    </div>
            
                  
            
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="message" placeholder="Your feedback" value="{{ old('message') }}" required>
                    </div>
            
                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Submit
                    </button>
                </form>
            
               
            </div>
            



           
        </div>
    </div>
</section>	



<section class="bg0 p-t-70 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">

             <!-- Information -->
            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Address
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Lets Talk
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            +1 800 1236879
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Sale Support
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            contact@example.com
                        </p>
                    </div>
                </div>
            </div>


             <!-- Map -->
            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
             
                    <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d222066.04683265666!2d34.91032113402467!3d29.580946131814773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15007039ff2efa81%3A0x595faa556d2e6acc!2sAqaba!5e0!3m2!1sen!2sjo!4v1725726841692!5m2!1sen!2sjo"
                            frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
              
            </div>
        </div>
    </div>

</section>	






@endsection