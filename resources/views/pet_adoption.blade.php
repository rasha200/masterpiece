@extends('layouts.user_side_master')

@section('content')

<!-- page title -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/hero-16.webp');">
    <h2 class="ltext-105 cl0 txt-center" style="color:#14535F;">
        Adopt a Pet Today
    </h2>
</section>		


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
    
<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Pet type
							</div>

							<ul>
								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Persian
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Siamese
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Maine Coon
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										Bengal Cat
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Sphynx Cat
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										Ragdoll Cat
									</a>
								</li>
							</ul>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Age
							</div>

							<ul>
								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04 filter-link-active">
										0-3 month
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										3-6 month
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										6-11 month
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										1 year
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										2 year
									</a>
								</li>

								<li class="p-b-6">
									<a href="#" class="filter-link stext-106 trans-04">
										+ 3 year
									</a>
								</li>
							</ul>
						</div>

						

						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Gender
							</div>

							<div class="flex-w p-t-4 m-r--5">
								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Male
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Female
								</a>

								
							</div>
						</div>
					</div>
				</div>
			</div>
       <div class="row">

           @foreach($pets as $pet)
           <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto" >
               <!-- Block1 -->
               <div class="block1 wrap-pic-w"  >
                  
                @if($pet->pet_images->isNotEmpty())
                
                <img src="{{ asset($pet->pet_images[0]->image) }}" alt="{{ $pet->name }}" alt="{{$pet->name}}" />
            @else
                <span>No image available</span>
            @endif
                   <a href="{{ route('pet_details', $pet->id) }}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                       <div class="block1-txt-child1 flex-col-l">
                           <span class="block1-name ltext-102 trans-04 p-b-8" style="color:#333;">
                               {{$pet->name}}
                           </span>

                           <span class="block1-info stext-102 trans-04" style="color:#333;">
                               {{$pet->type}}
                           </span>
                       </div>
                    @if($pet->is_adopted == "Available" ||$pet->is_adopted == "Pending")
                       <div class="block1-txt-child2 p-b-4 trans-05">
                           <div class="block1-link stext-101 cl0 trans-09" style="color:#333;">
                               Adopt me
                           </div>
                       </div>
                    @else
                    <div class="block1-txt-child2 p-b-4 trans-05">
                        <div class="block1-link stext-101 cl0 trans-09" style="color:#333;">
                            View profile
                        </div>
                    </div>
                    @endif
                    
                   </a>
               </div>
           </div>
           @endforeach

           <style>
            .block1 {
                width: 100%; /* Or a specific value if necessary */
                height: 250px; /* Adjust the height based on your design */
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                overflow: hidden; /* Prevent content from overflowing */
                background-color: #f9f9f9; /* Optional: add a background color */
                border: 1px solid #ddd; /* Optional: add a border */
                padding: 10px;
                box-sizing: border-box;
            }
            
 

            </style>

   <!-- Custom Pagination -->
<div class="flex-c-m flex-w w-full p-t-38">
    {{-- Loop through the pages --}}
    @foreach ($pets->getUrlRange(1, $pets->lastPage()) as $page => $url)
        @if ($page == $pets->currentPage())
            <a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                {{ $page }}
            </a>
        @else
            <a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                {{ $page }}
            </a>
        @endif
    @endforeach
</div>
        
  
       </div>
   </div>
</div>

@endsection