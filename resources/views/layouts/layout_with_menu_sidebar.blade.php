<!DOCTYPE html>
<html lang="{{ session()->get('locale') }}">

<head>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="icon" href="{{ asset('img/carre_vert_48_48.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="template admin">
    <title>template dom</title>
    <style>

    </style>
</head>

<body>

    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#" aria-label="hamburger button"><i class="bi bi-list"></i></a>
                </div>

                @php
                $school = App\Models\School::find(Auth::user()->school_id);
                @endphp
                <span class="text-truncate navbartitle">{{ $school ? $school->name : '' }}</span>


                <form style="display: inline" action="http://example.com/" method="get">

                    <div class="dropdown">
                        <button class="btn dropdown-toggle btn-sm dropdown-flag" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
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

                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/change-locale/en"><img
                                        src="{{ asset('img/flag_en.png') }}" alt="en">
                                    English</a></li>
                            <li><a class="dropdown-item" href="/change-locale/fr"><img
                                        src="{{ asset('img/flag_fr.png') }}" alt="fr">
                                    Français</a></li>
                        </ul>
                    </div>

                </form>
            </div>

            <div class="container">
                @yield('content')
            </div>

            <div class="bottom_navbar">
                &copy;Dom | About | CGU
            </div>
        </div>
        <div class="sidebar">
            <div class="profile">
                {{--
                <img src="https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg"
                    alt="profile_picture">
                --}}
                <i class="bi bi-person-circle profile-icon"></i>
                <h1 class="text-truncate">{{ Auth::user()->full_name }}</h1>
                <p>{{ Auth::user()->role->name }}</p>
            </div>
            @include('layouts.menu')

        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/main_js.js') }}">
    </script>


</body>

</html>