@extends('layouts.app_layout')
@section('title', __('titles.users'))
@section('content')

@include('errors.session-values')


<h1 class="text-center">@lang('users.title') ({{ $users->total() }})&nbsp;<a href="/users/create"
        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        @lang('users.add')</a></h1>

<div class="row mt-3 mb-3 d-flex justify-content-center">
    <div class="col-md-10">
        <form class="row" action="/users">
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

            <div class="col-md-2 col-sm-12 d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"
                        aria-hidden="true"></i>
                    @lang('users.filter')</button>
            </div>

            <div class="col-md-1 btn-group" role="group" aria-label="wiew style">

                <input type="radio" class="btn-check" name="view" id="list" value="list" @if ($view==='list' ) checked
                    @endif onchange="this.form.submit()" aria-label="users without media">
                <label class="btn btn-sm btn-outline-primary" for="list">
                    <i class="bi bi-list" aria-hidden="true"></i>
                </label>

                <input type="radio" class="btn-check" name="view" id="media" value="media" @if ($view==='media' )
                    checked @endif onchange="this.form.submit()" aria-label="users with media">
                <label class="btn btn-sm btn-outline-primary" for="media">
                    <i class="bi bi-list-stars" aria-hidden="true"></i>
                </label>
            </div>

        </form>


    </div>
</div>



<div class="row">
    <div class="col">

        @if ($view === 'list')
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="users list">
            <thead>
                <tr>
                    <th>@lang('users.name')</th>
                    <th>@lang('users.email')</th>
                    <th>@lang('users.role')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="align-middle">
                    <td>
                        <a href="/users/{{ $user->id }}/edit">{{ $user->full_name }}</a>

                        @if ($user->status === 'INACTIVE')
                        <x-alert-user-inactive />
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}

                        @if ($user->role_id === 'TEACHER')
                        <x-quantity-assignment :user="$user" />
                        @endif

                        @if($user->role_id === 'STUDENT')
                        @foreach($user->user_groups as $user_group)
                        @php $group = \App\Models\Group::find($user_group->group_id) @endphp
                        <span class="badge bg-info"><a href="/groups/{{ $user_group->group_id }}/users">{{
                                $group->name }}</a></span>

                        @endforeach
                        @endif

                    </td>


                </tr>
                @endforeach
            </tbody>

        </table>
        @endif

        @if ($view === 'media')
        @foreach ($users as $user)
        <div class="row border mb-2">
            <div class="col-md-2 text-center">
                @if($user->user_image_url)
                <img src="{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="img not found" height="100">
                @else
                <i class="bi bi-person-square" style="font-size: 4rem;" aria-hidden="true"></i>
                @endif
            </div>

            <div class="col-md-10 ps-5">
                <h3><a href="/users/{{ $user->id }}/edit">{{ $user->full_name }}</a> ({{
                    $user->role->name }})</h3>
                <h6>{{ $user->email }}</h6>
                @if ($user->status === 'INACTIVE')
                <x-alert-user-inactive />
                @endif
                @foreach($user->user_groups as $user_group)
                @php $group = \App\Models\Group::find($user_group->group_id) @endphp
                <span class="badge bg-info"><a href="/groups/{{ $user_group->group_id }}/users">{{
                        $group->name }}</a></span>

                @endforeach
            </div>

        </div>
        @endforeach
        @endif

        @if($users->hasPages())
        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>
        @endif
    </div>



</div>


@endsection
