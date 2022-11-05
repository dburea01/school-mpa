<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link @if ($activeTab === 'address') active @endif" aria-current="page"
            href="/groups/{{ $groupId }}/edit">@lang('group-tabs.address')</a>
    </li>

    @if(! $newGroup)
    <li class="nav-item">
        <a class="nav-link @if ($activeTab === 'users') active @endif"
            href="/groups/{{ $groupId }}/users">@lang('group-tabs.users')</a>
    </li>
    @endif
</ul>
