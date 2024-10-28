@extends('layouts.user_side_master')

@section('content')

{{--include Hero start--}}
@include("include/user_side/hero")
{{--include Hero end--}}

{{--include About start--}}
@include("include/user_side/about")
{{--include About end--}}


{{--include Services start--}}
@include("include/user_side/services")
{{--include Services end--}}


{{--include Products start--}}
@include("include/user_side/products")
{{--include Products end--}}


{{--include Pets start--}}
@include("include/user_side/pets")
{{--include Pets end--}}

{{--include Testimonials start--}}
@include("include/user_side/testimonials")
{{--include Testimonials end--}}

@endsection