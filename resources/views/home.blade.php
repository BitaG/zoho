<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SendPulse</title>
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
</head>
<body>
<div class="home">

    <div  class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-8 text-center">
                <img class="fadeIn wow" data-wow-delay=".5s" src="{{asset('images/sendpulse-logo.png')}}">
                <h2 class="h6 pt-3 text-white font-weight-light fadeInUp wow" data-wow-delay="1s">{{trans('pages.Insale integration app')}}</h2>
                <img class="bg_logo d-none d-md-block w-100 fadeIn wow" data-wow-delay="1.5s"  src="{{asset('images/groups.svg')}}">
            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script>new WOW().init();</script>

</body>
</html>