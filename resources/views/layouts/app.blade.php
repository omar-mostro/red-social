<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="user" content="{{Auth::user()}}">
    <meta name="base-url" content="{{ URL::to('/') }}">
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <title>SocialApp</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-socialapp">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            <i class="material-icons text-primary">supervised_user_circle</i>SocialApp
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                {{--<li class="nav-item active">--}}
                {{--<a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">Link</a>--}}
                {{--</li>--}}
            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->email}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a onclick="document.getElementById('logout').submit()" class="dropdown-item" href="#">Cerrar sesión</a>
                        </div>
                    </li>
                    <form id="logout" action="{{route('logout')}}" method="post">@csrf</form>
                @endguest
            </ul>

        </div>
    </div>
</nav>

<main id="app" class="py-4">
    @yield('content')
</main>

<script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
