@extends('layouts.layout_with_horizontal_menu')

@section('content')

@include('errors.session-values')


<h1 class="text-center">@lang('periods.title') ({{$periods->count()}})&nbsp;<a href="/schools/{{ $school->id }}/periods/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        @lang('periods.add')</a></h1>

@if (count($currentPeriod) === 0)
<div class="row">
    <div class="col">
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i> @lang('periods.no_current_period')
        </div>
    </div>
</div>

@endif

<div class="row">
    <div class="col">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of periods">
            <thead>
                <tr>
                    <th>@lang('periods.name')</th>
                    <th>@lang('periods.start_date')</th>
                    <th>@lang('periods.end_date')</th>
                    <th>@lang('periods.comment')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periods as $period)
                <tr>
                    <td>
                        <a href="/schools/{{ $school->id }}/periods/{{ $period->id }}/edit">{{
                            $period->name }}</a>
                        @if ($period->current)
                        <i class="bi bi-check-circle-fill text-success" aria-hidden="true" title="@lang('periods.current_period')"></i>
                        @endif
                    </td>
                    <td>{{ $period->start_date }}</td>
                    <td>{{ $period->end_date }}</td>
                    <td>{{ $period->comment }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>



@endsection