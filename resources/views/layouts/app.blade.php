<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <script src="{{asset('/js/app.js')}}"></script>
    <title>{{config('app.name')}}</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container novmargin">
        <a class="navbar-brand" href="/">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">新規作成</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">予約ツイート一覧</a>
            </li>
            @endif
        </ul>
        @if(! Auth::check())
        <div class="btn-group" role="group" aria-label="Login or Register">
            <button class="btn btn-outline-primary" onclick="location.href='{{route('oauth.login')}}'" type="button">Login</button>
        </div>
        @else
        <div class="btn-group" role="group" aria-label="Login or Register">
            <button class="btn btn-outline-primary" onclick="location.href='{{route('home')}}'" type="button">{{Auth::user()->name}}</button>
        </div>
        @endif
        
        </div>
    </div>
    </nav>
    <div class="container">
    @if (session('flash_message'))
            <div class="alert alert-secondary" role="alert">
                {{ session('flash_message') }}
            </div>
    @endif
    @yield('content')
    </div>
</body>
</html>