@extends('layout')
@section('title','Oopss..')
@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <img src="{{asset('images/error.svg')}}">
            @if ( isset($error) )
            <h5 class="py-3 w-100 text-center" >{{ $error }} </h5>
            @endif
            @if ( isset($value) )
            <p class="text-center font-weight-light">{{$value}}</p>
            @endif
        </div>
    </div>

@endsection
