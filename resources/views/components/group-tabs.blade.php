<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link @if ($activeTab === 'address') active @endif" aria-current="page"
            href="/schools/{{ $schoolId }}/groups/{{ $groupId }}">@lang('group-tabs.address')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if ($activeTab === 'parents') active @endif"
            href="/schools/{{ $schoolId }}/groups/{{ $groupId }}/users">@lang('group-tabs.parents')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if ($activeTab === 'students') active @endif"
            href="/schools/{{ $schoolId }}/groups/{{ $groupId }}/students">@lang('group-tabs.students')</a>
    </li>
</ul>