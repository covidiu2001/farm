@extends('frontend.layout')

@section('content')

    @include('frontend.header')
    
    @include('frontend.search')
    
    @if(!empty($subview))
        @include('frontend.breadcrumbs')
        @include('frontend.' . $subview)
    @else
        @include('frontend.slider')
        @include('frontend.categories')   
        @include('frontend.products')
    @endif
    
    @include('frontend.footer')
@endsection
