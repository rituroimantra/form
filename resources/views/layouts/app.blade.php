<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <title>OIL India Limited</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://oilspe.cbtexamportal.in/assests/images/favicon.ico" rel="shortcut icon" />
  
    <link href="https://oilspe.cbtexamportal.in/assests/css/style.css" rel="stylesheet" />
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://oilspe.cbtexamportal.in/assests/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://oilspe.cbtexamportal.in/assests/css/all.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
.gray {
    background: #f1f1f1;
    padding: 0px 20px 8px;
    margin-bottom: 8px;
}

.lightgreen {
    background: #ecf8ee;
    padding: 0px 20px 8px;
    margin-bottom: 8px;
}

.box-horizontal {
    background: #336086;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
</style>
</head>

<body>
    <header class="header">
        <div class="ajax-loader ajax-busy-wrap" style="display:none">loading</div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo"><img src="https://oilspe.cbtexamportal.in//assests/images/logo.png" /></div>
                </div>
                <div class="col-sm-4 vcenter">
                    <div class="headerTitle"> OIL INDIA LIMITED : Recruitment For Various Posts<br>
                        <span class=""><strong>POST CODE </strong> - SPE 01</span>
                    </div>
                </div>
                <div class="col-sm-5 vbottom">
                    <nav id="customStyleNav" class="navbar navbar-expand-lg p-0">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation"> <span
                                    class="navbar-toggler-icon"></span> </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item"> <a class="nav-link" href="https://oilspe.cbtexamportal.in/"><i
                                                class="fa-solid fa-house"></i> Home</a> </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="https://oilspe.cbtexamportal.in/View/important-date"><i
                                                class="fa-solid fa-calendar-days"></i> Important Dates</a> </li>
                                    </li>

                                    @guest
                                    @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @endif
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                    @endif
                                    @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main class="py-4">
        @yield('content')
    </main>
<!-- Bootstrap JavaScript (Popper.js is required for dropdowns, tooltips, and popovers) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://oilspe.cbtexamportal.in//assests/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://oilspe.cbtexamportal.in/assests/js/jquery-1.8.3.min.js"></script>
    <script src="https://oilspe.cbtexamportal.in/assests/js/jquery-ui.min.js"></script> -->

    <!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include jQuery UI library -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@stack('scripts')

</body>

</html>