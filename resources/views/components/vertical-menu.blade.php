<div class="sidebar">
    <div class="profile">
        <i class="bi bi-person-circle profile-icon" aria-hidden="true"></i>
        <h1 class="text-truncate">{{ Auth::user()->full_name }}</h1>
        <p>{{ Auth::user()->role->name }}</p>
    </div>
    <ul>
        <li>
            <a href="/dashboard" @class(['active'=> Route::currentRouteName() === 'dashboard'])>
                <span class="icon"><i class="bi bi-house" aria-hidden="true"></i></span>
                <span class="item">Home</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon"><i class="bi bi-person-circle" aria-hidden="true"></i></span>
                <span class="item">My profil (todo)</span>
            </a>
        </li>
        <li>
            <a href="/logout">
                <span class="icon"><i class="bi bi-box-arrow-left" aria-hidden="true"></i></span>
                <span class="item">Logout</span>
            </a>
        </li>

        @if (Auth::user()->isAdmin())
        <li>
            <a href="/schools" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'schools.index', 'schools.edit'])])>
                <span class="icon"><i class="bi bi-building" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.schools')</span>
            </a>
        </li>
        @endif

        @if (Auth::user()->isDirector())

        <li>
            <a href="/schools/edit" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'schools.edit'])])>
                <span class="icon"><i class="bi bi-building" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.myschool')</span>
            </a>
        </li>

        <li>
            <a href="/users" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'users.index', 'users.edit'])])>
                <span class="icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.users')</span>
            </a>
        </li>
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/groups" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'groups.index', 'groups.edit', 'users_group'])])>
                <span class="icon"><i class="bi bi-person-lines-fill" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.groups')</span>
            </a>
        </li>
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/subjects" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'subjects.index', 'subjects.edit'])])>
                <span class="icon"><i class="bi bi-boxes" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.subjects')</span>
            </a>
        </li>
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/periods" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'periods.index', 'periods.edit'])])>
                <span class="icon"><i class="bi bi-calendar3" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.periods')</span>
            </a>
        </li>
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/classrooms" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'classrooms.index', 'classrooms.edit'])])>
                <span class="icon"><i class="bi bi-square" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.classrooms')</span>
            </a>
        </li>
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/reports" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'reports'])])>
                <span class="icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.reports')</span>
            </a>
        </li>
        @endif

        @if (Auth::user()->isDirector() || Auth::user()->isTeacher())
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/exams" @class( ['active'=>
                in_array(Route::currentRouteName(), [
                'exams.index', 'exams.edit'])])>
                <span class="icon"><i class="bi bi-book" aria-hidden="true"></i></span>
                <span class="item">@lang('menu.exams')</span>
            </a>
        </li>
        @endif






    </ul>
</div>
