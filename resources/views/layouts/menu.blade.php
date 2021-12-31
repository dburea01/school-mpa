<ul>
    <li>
        <a href="/logout">
            <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
            <span class="item">@lang('menu.logout')</span>
        </a>
    </li>
    <li>
        <a href="/home_connected" @if (url()->current() === route('home_connected')) class="active" @endif>
            <span class="icon"><i class="bi bi-house"></i></span>
            <span class="item">@lang('menu.home')</span>
        </a>
    </li>

    @if (Auth::user()->isSuperAdmin())
    <li>
        <a href="/schools" @if (in_array(request()->route()->getName(), [
            'schools.index','schools.create','schools.edit'
            ]))
            class="active" @endif>
            <span class="icon"><i class="bi bi-building"></i></span>
            <span class="item">@lang('menu.schools')</span>
        </a>
    </li>
    @endif

    @if (Auth::user()->isDirector())
    <li>
        <a href="/schools/{{ Auth::user()->school_id }}/edit" @if (request()->route()->getName() ===
            'schools.edit')
            class="active" @endif>
            <span class="icon"><i class="bi bi-building"></i></span>
            <span class="item">@lang('menu.myschool')</span>
        </a>
    </li>

    <li>
        <a href="/schools/{{ Auth::user()->school_id }}/users" @if (in_array(request()->route()->getName(), [
            'schools.users.index','schools.users.create','schools.users.edit'
            ]))
            class="active" @endif>
            <span class="icon"><i class="bi bi-people-fill"></i></span>
            <span class="item">@lang('menu.users')</span>
        </a>
    </li>

    <li>
        <a href="#">
            <span class="icon"><i class="bi bi-book"></i></span>
            <span class="item">@lang('menu.periods')</span>
        </a>
    </li>

    <li>
        <a href="#">
            <span class="icon"><i class="bi bi-boxes"></i></span>
            <span class="item">@lang('menu.subjects')</span>
        </a>
    </li>

    <li>
        <a href="#">
            <span class="icon"><i class="bi bi-flag"></i></span>
            <span class="item">@lang('menu.assignments')</span>
        </a>
    </li>
    @endif



</ul>