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
            <x-select-role name="role_id" id="role_id" required="false" :value="$role_id" />
        </div>

        <div class="col-md-3 col-sm-12 d-grid gap-2 d-md-block">
            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"></i>
                @lang('users.filter')</button>
        </div>

    </form>
</div>

<div class="row">
    <table class="table table-sm table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>@lang('users.name')</th>
                <th>@lang('users.role')</th>
                <th>@lang('users.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><a href="/schools/{{ $school->id }}/users/{{ $user->id }}/edit">{{ $user->full_name }}</a></td>
                <td>{{ $user->role->name }}</td>
                <td @if($user->status === 'INACTIVE') class="table-danger" @endif>{{ $user->status }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@if($users->hasPages())
<div class="d-flex justify-content-center">
    {{ $users->withQueryString()->links() }}
</div>
@endif

@endsection