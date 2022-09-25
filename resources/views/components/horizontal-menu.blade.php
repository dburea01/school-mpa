<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LaraSchool</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">



            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->full_name }} ({{ Auth::user()->role->name }})
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="/logout">@lang('menu.logout')</a></li>
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                    </ul>
                </li>

                @if (Auth::user()->isSuperAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="/schools" role="button">@lang('menu.schools')</a>
                </li>
                @endif

                @if (Auth::user()->isDirector())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('menu.myoptions')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/edit">@lang('menu.myschool')</a></li>
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/reports">@lang('menu.reports')</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/users">@lang('menu.users')</a></li>
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/groups">@lang('menu.groups')</a></li>
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/subjects">@lang('menu.subjects')</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/periods">@lang('menu.periods')</a></li>
                        <li><a class="dropdown-item"
                                href="/schools/{{ Auth::user()->school_id }}/classrooms">@lang('menu.classrooms')</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @switch(session()->get('locale'))
                        @case('en')
                        <img src="{{ asset('img/flag_en.png') }}" alt="en" width="20" height="13" />
                        @break
                        @case('fr')
                        <img src="{{ asset('img/flag_fr.png') }}" alt="fr" width="20" height="13" />
                        @break
                        @default
                        <img src="{{ asset('img/flag_en.png') }}" alt="en" width="20" height="13" />
                        @endswitch

                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/change-locale/fr"><img src="{{ asset('img/flag_fr.png') }}"
                                    alt="fr" width="20" height="13" />
                                Français</a></li>
                        <li><a class="dropdown-item" href="/change-locale/en"><img src="{{ asset('img/flag_en.png') }}"
                                    alt="en" width="20" height="13" />
                                English</a></li>
                    </ul>
                </li>

            </ul>


            @php
            $school = App\Models\School::find(Auth::user()->school_id);
            if ($school) {
            $currentPeriod = App\Models\Period::where('school_id', $school->id)->where('current', true)->first();
            }
            @endphp
            <span class="navbar-text text-truncate">
                {{ $school ? $school->name : 'no school' }} -
                {{ isset($currentPeriod->name) ? $currentPeriod->name : 'no current period' }}
            </span>

        </div>
    </div>
</nav>
