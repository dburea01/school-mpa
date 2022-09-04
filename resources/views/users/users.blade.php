@extends('layouts.app_layout')

@section('content')

@include('errors.session-values')


<h1 class="text-center">@lang('users.title') ({{ $users->total() }})&nbsp;<a
        href="/schools/{{ $school->id }}/users/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"
            aria-hidden="true"></i>
        @lang('users.add')</a></h1>

<div class="row mt-3 mb-3">
    <div class="col-md-10">
        <form class="row" action="/schools/{{ $school->id }}/users">
            <div class="col-md-3 col-sm-12">
                <input type="text" class="form-control form-control-sm mr-sm-2" name="user_name" id="user_name"
                    placeholder="@lang('users.filter_by_user_name')" value="{{ $user_name }}">
            </div>

            <div class="col-md-3 col-sm-12">
                <x-select-role name="role_id" id="role_id" required="false" :value="$role_id" />
            </div>

            <div class="col-md-3 col-sm-12">
                <x-select-user-status name="status" id="status" required="{{ false }}" :status="$status" />
            </div>

            <div class="col-md-3 col-sm-12 d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"
                        aria-hidden="true"></i>
                    @lang('users.filter')</button>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="users list">
            <thead>
                <tr>
                    <th>@lang('users.name')</th>
                    <th>@lang('users.role')</th>
                    <th>@lang('users.in_group')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="/schools/{{ $school->id }}/users/{{ $user->id }}/edit">{{
                            $user->full_name }}</a>
                        @if ($user->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                            title="@lang('users.user_inactive')"></i>
                        @endif
                    </td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        @foreach($user->user_groups as $user_group)
                        @php $group = \App\Models\Group::find($user_group->group_id) @endphp
                        <span class="badge bg-info"><a
                                href="/schools/{{ $school->id }}/groups/{{ $user_group->group_id }}/users">{{
                                $group->name }}</a></span>

                        @endforeach
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

        @if($users->hasPages())
        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>
        @endif
    </div>


</div>



@endsection