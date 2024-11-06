@extends('layouts.user_side_master')

@section('content')

{{--include Hero start--}}
@include("include/landing_page/hero")
{{--include Hero end--}}



{{--include About start--}}
@include("include/landing_page/about")
{{--include About end--}}


{{--Services section start--}}
@include("include/landing_page/services")
{{--Services section end--}}


{{--Products section start--}}
@include("include/landing_page/products")
{{--Products section end--}}



{{--Pets section start--}}
@include("include/landing_page/pets")
{{--Pets section end--}}



{{--include Testimonials start--}}
@include("include/landing_page/testimonials")
{{--include Testimonials end--}}



@endsection