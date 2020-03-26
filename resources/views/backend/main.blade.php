@extends('backend.layout')

@section('content')
    @include('backend.header')
    <div class="page-content">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar content-box" style="display: block;">
                    @include('backend.menu')
                </div>
            </div>
            <div class="col-md-10">
                <div class="content-box-large">
                    <div class="row">
                        @include('backend.' . $subview)
                    </div>
                </div>
            </div>            
        </div>
    </div>

@endsection
