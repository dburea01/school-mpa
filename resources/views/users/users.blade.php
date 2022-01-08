@extends('layouts.layout_with_menu_sidebar')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('users.title') ({{$users->total()}})&nbsp;<a
        href="/schools/{{ $school->id }}/users/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i>
        @lang('users.add')</a></h1>

<div class="row mt-3 mb-3">
    <form class="row" action="/schools/{{ $school->id }}/users">
        <div class="col-md-3 col-sm-12">
            <input type="text" class="form-control form-control-sm mr-sm-2" name="user_name" id="user_name"
                placeholder="@lang('users.filter_by_user_name')" value="{{ $user_name }}">
        </div>

        <div class="col-md-3 col-sm-12">
            <x-select-role name="role_id" id="role_id" required="false" :value="$role_id" family-role="false" />
        </div>

        <div class="col-md-3 col-sm-12 d-grid gap-2 d-md-block">
            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"></i>
                @lang('users.filter')</button>
        </div>

    </form>
</div>

<div class="row">
    <div class="col-md-8">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>@lang('users.name')</th>
                    <th>@lang('users.role')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="/schools/{{ $school->id }}/users/{{ $user->id }}/edit">{{
                            $user->full_name }}</a>
                        @if ($user->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" title="@lang('users.user_inactive')"></i>
                        @endif
                    </td>
                    <td>{{ $user->role->name }}</td>
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

    <div class="col-md-4">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">@lang('users.summary')</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>@lang('users.qty_teachers')</th>
                    <td>{{ $summary_users_by_role->firstWhere('role_id', 'TEACHER')->user_count }}</td>
                </tr>
                <tr>
                    <th>@lang('users.qty_directors')</th>
                    <td>{{ $summary_users_by_role->firstWhere('role_id', 'DIRECTOR')->user_count }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



@endsection