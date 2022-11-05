@extends('layouts.app_layout')
@section('title', __('titles.groups'))
@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('groups.title') ({{$groups->total()}})&nbsp;<a href="/groups/create"
        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        @lang('groups.add')</a></h1>

<div class="row mt-3 mb-3">
    <form class="row col-md-8 mx-auto" action="/groups">
        <div class="col-md-3 col-sm-12">
            <input type="text" class="form-control form-control-sm mr-sm-2" name="group_name" id="group_name"
                placeholder="@lang('groups.filter_by_group_name')" value="{{ $group_name }}">
        </div>

        <div class="col-md-3 col-sm-12">
            <input type="text" class="form-control form-control-sm mr-sm-2" name="group_city" id="group_city"
                placeholder="@lang('groups.filter_by_group_city')" value="{{ $group_city }}">
        </div>

        <div class="col-md-3 col-sm-12 d-grid gap-2 d-md-block">
            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"
                    aria-hidden="true"></i>
                @lang('groups.filter')</button>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of groups">
            <thead>
                <tr>
                    <th>@lang('groups.name')</th>
                    <th>@lang('groups.city')</th>
                    <th>@lang('groups.users')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                <tr>
                    <td>
                        <a href="/groups/{{ $group->id }}/edit">{{ $group->name }}</a>
                        @if ($group->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                            title="@lang('groups.group_inactive')"></i>
                        @endif
                    </td>
                    <td>{{ $group->city }}</td>
                    <td><a href="/groups/{{ $group->id }}/users">{{ $group->user_groups_count
                            }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($groups->hasPages())
        <div class="d-flex justify-content-center">
            {{ $groups->withQueryString()->links() }}
        </div>
        @endif
    </div>


</div>



@endsection
