@extends('layouts.layout_with_menu_sidebar')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('schools.title') ({{$schools->total()}})&nbsp;<a href="/schools/create"
        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i>
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
            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"></i> Filter</button>
        </div>

    </form>
</div>

<div class="row">
    <table class="table table-sm table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>@lang('schools.name')</th>
                <th>@lang('schools.status')</th>
                <th>@lang('schools.city')</th>
                <th>@lang('schools.users')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
            <tr>
                <td><a href="/schools/{{ $school->id }}/edit">{{ $school->name }}</a></td>
                <td @if($school->status === 'INACTIVE') class="table-danger" @endif>{{ $school->status }}</td>
                <td>{{ $school->zip_code }} - {{ $school->city }}</td>
                <td>{{ $school->users_count }} / {{ $school->max_users }}
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@if($schools->hasPages())
<div class="d-flex justify-content-center">
    {{ $schools->withQueryString()->links() }}
</div>
@endif

@endsection