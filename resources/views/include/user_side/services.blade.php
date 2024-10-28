<!-- Service -->
<section class="sec-blog bg0 p-t-0">
    <div class="container">
        <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Our Services
            </h3>
        </div>

        <div class="row">

            @foreach($services as $service)
            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="blog-detail.html">
                            <img src="images/blog-01.jpg" alt="IMG-BLOG">
                        </a>
                    </div>

                    <div class="p-t-15">
                        

                        <h4 class="p-b-12">
                            <a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
                                {{$service->name}}
                            </a>
                        </h4>

                       
                    </div>
                </div>
            </div>
            @endforeach
           
    </div>
    
</section>