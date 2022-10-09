<!DOCTYPE html>
<html lang="en" class="h-100">

<head>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="icon" href="img/carre_vert_48_48.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="template admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} · @yield('title')</title>
    @vite(['resources/css/style.css', 'resources/js/burger.js'])
</head>

<body>

    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#" aria-label="hamburger button"><i class="bi bi-list" aria-hidden="true"></i></a>
                </div>
                <span class="text-truncate navbartitle">
                    {{ isset(Auth::user()->school) ? Auth::user()->school->name : 'no school' }} -
                    @php
                    $currentPeriod = App\Models\Period::getCurrentPeriod(Auth::user()->school_id);
                    @endphp

                    @if (null !== $currentPeriod)
                    {{ $currentPeriod->name }}
                    @else
                    <span class="text-danger">
                        <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>no current period

                        <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
                    </span>
                    @endif



                </span>
                <ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @switch(session()->get('locale'))
                            @case('en')
                            <img src="{{ asset('img/flag_en.png') }}" alt="en" width="20" height="13">
                            @break
                            @case('fr')
                            <img src="{{ asset('img/flag_fr.png') }}" alt="fr" width="20" height="13">
                            @break
                            @default
                            <img src="{{ asset('img/flag_en.png') }}" alt="en" width="20" height="13">
                            @endswitch
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/change-locale/fr"><img
                                        src="{{ asset('img/flag_fr.png') }}" alt="fr" width="20" height="13">
                                    Français</a></li>
                            <li><a class="dropdown-item" href="/change-locale/en"><img
                                        src="{{ asset('img/flag_en.png') }}" alt="en" width="20" height="13">
                                    English</a></li>
                        </ul>
                    </li>
                </ul>

            </div>


            <div class="container">
                @yield('content')
            </div>

            <div class="bottom_navbar">

                &copy;Dom {{ now()->year }} | About | CGU

            </div>
        </div>
        <x-vertical-menu />


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    @yield('extra_js')



</body>

</html>
