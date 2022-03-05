<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="template admin bootstrap">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <title>Dashboard Template · essai dom</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="icon" href="img/carre_vert_48_48.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body class="d-flex flex-column h-100">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LaraSchool</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">



                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->full_name }} ({{ Auth::user()->role->name }})
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <li><a class="dropdown-item" href="/logout">@lang('menu.logout')</a></li>
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>

                    @if (Auth::user()->isSuperAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="/schools" role="button">@lang('menu.schools')</a>
                    </li>
                    @endif

                    @if (Auth::user()->isDirector())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @lang('menu.myoptions')
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                            <li><a class="dropdown-item" href="/schools/{{ Auth::user()->school_id }}/edit">@lang('menu.myschool')</a></li>
                            <li><a class="dropdown-item" href="/schools/{{ Auth::user()->school_id }}/reports">@lang('menu.reports')</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/schools/{{ Auth::user()->school_id }}/users">@lang('menu.users')</a></li>
                            <li><a class="dropdown-item" href="/schools/{{ Auth::user()->school_id }}/groups">@lang('menu.groups')</a></li>
                            <li><a class="dropdown-item" href="/schools/{{ Auth::user()->school_id }}/subjects">@lang('menu.subjects')</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @switch(session()->get('locale'))
                            @case('en')
                            <img src="{{ asset('img/flag_en.png') }}" alt="en" />
                            @break
                            @case('fr')
                            <img src="{{ asset('img/flag_fr.png') }}" alt="fr" />
                            @break
                            @default
                            <img src="{{ asset('img/flag_en.png') }}" alt="en" />
                            @endswitch

                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/change-locale/fr"><img src="{{ asset('img/flag_fr.png') }}" alt="fr" />
                                    Français</a></li>
                            <li><a class="dropdown-item" href="/change-locale/en"><img src="{{ asset('img/flag_en.png') }}" alt="en" />
                                    English</a></li>
                        </ul>
                    </li>

                </ul>


                @php
                $school = App\Models\School::find(Auth::user()->school_id)
                @endphp
                <span class="navbar-text text-truncate">{{ $school->name }} (Année scolaire
                    2021-2022)
                </span>

                <!--
                <form class="d-flex">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-success btn-sm" type="submit">Search</button>
                </form>
            -->
            </div>
        </div>
    </nav>


    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container" id="container">
            @yield('content')
        </div>
    </main>

    <footer class=" footer mt-auto py-3">
        <div class="container">
            &copy;Dom 2022 | About | CGU
        </div>
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/main_js.js') }}"></script>
    @yield('extra_js')


</body>

</html>