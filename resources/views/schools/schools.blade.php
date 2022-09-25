@extends('layouts.app_layout')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('schools.title') ({{$schools->total()}})&nbsp;<a href="/schools/create"
        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        Add</a></h1>

<div class="row mt-3 mb-3">
    <form class="row" action="/schools">
        <div class="col-md-3 col-sm-12">
            <input type="text" class="form-control form-control-sm mr-sm-2" name="school_name" id="school_name"
                placeholder="@lang('schools.filter_by_school_name')" value="{{ $school_name }}">
        </div>

        <div class="col-md-3 col-sm-12">
            <input type="text" class="form-control form-control-sm mr-sm-2" name="city" id="city"
                placeholder="@lang('schools.filter_by_city')" value="{{ $city }}">
        </div>

        <div class="col-md-3 col-sm-12 d-grid gap-2 d-md-block">
            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"
                    aria-hidden="true"></i> Filter</button>
        </div>

    </form>
</div>

<div class="row">
    <table class="table table-sm table-striped table-bordered table-hover" aria-label="schools list">
        <thead>
            <tr>
                <th>@lang('schools.name')</th>
                <th>@lang('schools.city')</th>
                <th>@lang('schools.max_users')</th>
                <th>@lang('schools.users')</th>
                <th>@lang('schools.groups')</th>
                <th>@lang('schools.periods')</th>
                <th>@lang('schools.subjects')</th>
                <th>@lang('schools.classrooms')</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
            <tr>
                <td>
                    <a href="/schools/{{ $school->id }}/edit">{{ $school->name }}</a>
                    @if ($school->status === 'INACTIVE')
                    <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                        title="@lang('schools.school_inactive')"></i>
                    @endif
                </td>

                <td>{{ $school->zip_code }} - {{ $school->city }}</td>

                <td>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="progress_{{$school->id}}"
                            style="width: {{ 100 * $school->users_count/$school->max_users }}%;"
                            aria-valuenow="{{ 100 * $school->users_count / $school->max_users }}" aria-valuemin="0"
                            aria-valuemax="100">{{ $school->users_count }} / {{ $school->max_users }} ({{
                            floor(100 *
                            $school->users_count / $school->max_users) }}%)
                        </div>
                    </div>
                </td>
                <td>
                    <a href="/schools/{{ $school->id }}/users">{{ $school->users_count }}</a>
                </td>
                <td>
                    <a href="/schools/{{ $school->id }}/groups">{{ $school->groups_count }}</a>
                </td>
                <td>
                    <a href="/schools/{{ $school->id }}/periods">{{ $school->periods_count }}</a>
                </td>
                <td>
                    <a href="/schools/{{ $school->id }}/subjects">{{ $school->subjects_count }}</a>
                </td>
                <td>
                    <a href="/schools/{{ $school->id }}/classrooms"><i class="bi bi-building"
                            aria-hidden="true"></i></a>
                </td>
                <td>
                    <a href="/schools/{{ $school->id }}/reports"><i class="bi bi-table" aria-hidden="true"
                            title="reports"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@if($schools->hasPages())
<div class=" d-flex justify-content-center">
    {{ $schools->withQueryString()->links() }}
</div>
@endif

@endsection
