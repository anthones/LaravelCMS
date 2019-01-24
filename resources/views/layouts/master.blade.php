<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Antonie">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaravelCMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 54px;
            }
        @media (min-width: 992px) {
            body {
                padding-top: 56px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand">LaravelCMS</a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a 
                            href="{{ route('logout') }}" 
                            class="nav-link"
                            onclick="
                                event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >Log out</a>
                            <form 
                            action="{{ route('logout') }}" 
                            id="logout-form"
                            method="POST"
                            style="display:none;"
                            >@csrf</form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div id="app">
        @yield('content')
    </div>

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; LaravelCMS 2018</p>
        </div>
    </footer>
</body>
</html>