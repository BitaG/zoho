<section class="container-fluid bg-primary">
    <nav class="navbar">
        <a class="navbar-brand" href="https://sendpulse.com/">
            <img class="head-logo" src="{{asset('images/sendpulse-logo.png')}}" height="24">
        </a>
        @if(!empty(Cookie::get('shopUrl')))
            <a href="{{Cookie::get('shopUrl')}}" class="text-white">{{trans('pages.Return to the InSales panel')}}</a>
        @endif
    </nav>
</section>
<section class="container-fluid">
    <div class="menu d-flex justify-content-between align-items-center py-3">
        <div class="d-lg-block  d-none">
            <h2 class="title">@yield('title')</h2>
            <span class="description">@yield('description')</span>
        </div>
        <div>
            <a href="/export" class="btn  {{ request()->is('export*') ? 'active' : '' }} ">{{trans('pages.Export')}}</a>
            <a href="/sync" class="btn {{ request()->is('sync*') ? 'active' : '' }}">{{trans('pages.Sync')}}</a>
            <a href="/webpush" class="btn {{ request()->is('webpush*') ? 'active' : '' }} ">{{trans('pages.Web push service')}}</a>
            <a href="/connect" class="btn {{ request()->is('connect*') ? 'active' : '' }}">{{trans('pages.Connect')}}</a>
        </div>
    </div>
</section>