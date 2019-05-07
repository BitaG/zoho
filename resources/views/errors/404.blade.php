@extends('layout')
@section('title','Oopss..')
@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <img src="{{asset('images/error.svg')}}">
                <h5 class="py-3 w-100 text-center" >{{ trans('pages.Page not found') }} </h5>
        </div>
    </div>

@endsection
