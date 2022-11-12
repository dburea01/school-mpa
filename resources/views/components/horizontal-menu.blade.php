<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->full_name }} ({{ Auth::user()->role->name }})
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="/logout">@lang('menu.logout')</a></li>
                        <li><a class="dropdown-item" href="#">Profil (todo)</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('menu.myoptions')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        @if (Auth::user()->isAdmin())

                        <li><a class="dropdown-item" href="/schools/edit">@lang('menu.myschool')</a></li>
                        <li><a class="dropdown-item" href="/reports">@lang('menu.reports')</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/users">@lang('menu.users')</a></li>
                        <li><a class="dropdown-item" href="/groups">@lang('menu.groups')</a></li>
                        <li><a class="dropdown-item" href="/subjects">@lang('menu.subjects')</a></li>
                        <li><a class="dropdown-item" href="/periods">@lang('menu.periods')</a></li>
                        <li><a class="dropdown-item" href="/classrooms">@lang('menu.classrooms')</a></li>
                        <li><a class="dropdown-item" href="/assignment-teachers">@lang('menu.assignment-teachers')</a>
                        </li>
                        <li><a class="dropdown-item" href="/appreciations">@lang('menu.appreciations')</a></li>
                        <li><a class="dropdown-item" href="/exams">@lang('menu.exams')</a></li>

                        @endif

                        @if (Auth::user()->isTeacher())
                        <li><a class="dropdown-item" href="/exams">@lang('menu.exams')</a></li>
                        @endif
                    </ul>
                </li>


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
                        <li><a class="dropdown-item" href="/change-locale/fr"><img src="{{ asset('img/flag_fr.png') }}"
                                    alt="fr" width="20" height="13">
                                Français</a></li>
                        <li><a class="dropdown-item" href="/change-locale/en"><img src="{{ asset('img/flag_en.png') }}"
                                    alt="en" width="20" height="13">
                                English</a></li>
                    </ul>
                </li>

            </ul>

            <span class="text-truncate navbar-text">
                @php
                $school = App\Models\School::first();
                $currentPeriod = App\Models\Period::getCurrentPeriod();
                @endphp

                @if (null !== $currentPeriod)
                {{ $school->name }} - {{ $currentPeriod->name }}
                @else
                <span class="text-danger">
                    <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>no current period
                    <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
                </span>
                @endif
            </span>


        </div>


    </div>
</nav>
