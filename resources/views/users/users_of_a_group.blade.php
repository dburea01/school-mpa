@extends('layouts.layout_with_menu_sidebar')

@section('content')


<h2 class="text-center mb-3">@if ($group->id) @lang('group.modify_group') @else @lang('group.create_group') @endif</h2>

<x-group-tabs activeTab="users" schoolId="{{ $school->id }}" groupId="{{ $group->id }}" newGroup="{{ false }}" />

<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-header text-center">@lang('group.users_of_a_group')
                <strong>({{count($usersOfAGroup)}})</strong>
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('group.user_name_of_a_group')</th>
                            <th>@lang('group.user_role_of_a_group')</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($usersOfAGroup as $userOfAGroup)
                        <tr>
                            <td>
                                <a href="/schools/{{ $school->id }}/users/{{ $userOfAGroup->id }}">{{
                                    $userOfAGroup->full_name }}</a>
                                @if ($userOfAGroup->status === 'INACTIVE')
                                <i class="bi bi-exclamation-triangle-fill text-danger"
                                    title="@lang('users.user_inactive')"></i>
                                @endif
                            </td>
                            <td>{{ $userOfAGroup->role->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalRemoveUserFromGroup_{{ $userOfAGroup->id }}"
                                    aria-label="remove">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col">

        <div class="card">
            <div class="card-header text-center">@lang('group.add_user_for_a_group')</div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-10">
                        <form class="row" action="/schools/{{ $school->id }}/groups/{{ $group->id }}/users"
                            aria-label="search">
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control form-control-sm" name="user_name"
                                    value="{{ $user_name }}" />
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-primary btn-sm btn-block"><i
                                        class="bi bi-funnel"></i>
                                    @lang('users.filter')</button>
                            </div>

                        </form>
                    </div>
                </div>

                @if (count($usersWithoutGroup) === 0)
                no users found
                @else
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('user.full_name')</th>
                            <th>@lang('user.role')</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersWithoutGroup as $userWithoutGroup)
                        <tr>
                            <td>
                                {{ $userWithoutGroup->full_name }}
                                @if ($userWithoutGroup->status === 'INACTIVE')
                                <i class="bi bi-exclamation-triangle-fill text-danger"
                                    title="@lang('users.user_inactive')"></i>
                                @endif
                            </td>
                            <td>{{ $userWithoutGroup->role->name }}</td>
                            <td>
                                <form action="/schools/{{ $school->id }}/groups/{{ $group->id }}/users" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $userWithoutGroup->id }}" />
                                    <input type="hidden" name="user_name" value="{{ $user_name }}" />
                                    <button type="submit" class="btn btn-sm btn-success" aria-label="add">
                                        <i class="bi bi-plus-circle"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif




            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach ($usersOfAGroup as $userOfAGroup)
<div class="modal fade" id="modalRemoveUserFromGroup_{{ $userOfAGroup->id }}" tabindex="-1"
    aria-labelledby="modalLabel_{{ $userOfAGroup->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel_{{ $userOfAGroup->id }}">
                    @lang('group.remove_user_of_a_group',
                    ['full_name' => $userOfAGroup->full_name])</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>@lang('group.warning_remove_user_no_possible_rollback', ['full_name' =>
                    $userOfAGroup->full_name])
                </p>
            </div>
            <div class="modal-footer">
                <form class="form-inline" method="POST"
                    action="/schools/{{ $school->id }}/groups/{{ $group->id }}/users/{{ $userOfAGroup->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-chevron-left"></i> @lang('group.cancel_remove_user')</button>
                    <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"></i>
                        @lang('group.confirm_remove_user', ['full_name' => $userOfAGroup->full_name])</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection