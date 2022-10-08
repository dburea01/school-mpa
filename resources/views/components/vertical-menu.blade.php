<div class="sidebar">
    <div class="profile">
        <!--
        <img src="https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg"
            alt="profile_picture">
        -->
        <i class="bi bi-person-circle profile-icon"></i>
        <h1 class="text-truncate">{{ Auth::user()->full_name }}</h1>
        <p>{{ Auth::user()->role->name }}</p>
    </div>
    <ul>
        <li>
            <a href="#" class="active">
                <span class="icon"><i class="bi bi-house"></i></span>
                <span class="item">Home</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon"><i class="bi bi-person-circle"></i></span>
                <span class="item">My profil</span>
            </a>
        </li>
        <li>
            <a href="/logout">
                <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                <span class="item">Logout</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon"><i class="bi bi-speedometer2"></i></span>
                <span class="item">My Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->isDirector() || Auth::user()->isTeacher())
        <li>
            <a href="/schools/{{ Auth::user()->school_id }}/exams">
                <span class="icon"><i class="bi bi-book"></i></span>
                <span class="item">@lang('menu.exams')</span>
            </a>
        </li>
        @endif




    </ul>
</div>
