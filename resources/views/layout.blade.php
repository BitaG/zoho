<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('/images/favicon.png')}}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- animate -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!-- style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- theme color-->
    <meta name="theme-color" content="#0097B7">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
@if(!request()->is('error*'))
    @include('component.head')
@endif

@yield('content')

@if(!empty($msg))
    @component('component.message'){{$msg}}@endcomponent
@section('script')
    <script>$('#msg').toast('show');</script>
@endsection
@endif
<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/jquery.twbsPagination.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>new WOW().init();</script>
@yield('script')
</body>
</html>