@extends('layouts.layout_with_horizontal_menu')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('classrooms.title') <a href="/schools/{{ $school->id }}/classrooms/create"
        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        @lang('classrooms.add')</a></h1>

<div class="row mt-3 mb-3">
    <form class="row col-md-4 mx-auto" action="/schools/{{ $school->id }}/groups">


        <select class="form-select form-select-sm" name="select-period" id="select-period"
            onchange="window.location.assign('{{ url()->current().'?period_id=' }}'+this.value)">
            <option value="">@lang('select-period.select_a_period')</option>
            @foreach ($periods as $period)
            <option value="{{ $period->id }}" @if ($period->id === $periodToDisplay->id) selected @endif>
                {{ $period->name }}
                @if ($period->current) (***) @endif
            </option>
            @endforeach
        </select>

    </form>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of groups">
            <thead>
                <tr>
                    <th>@lang('classrooms.name')</th>
                    <th>@lang('classrooms.users')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)
                <tr>
                    <td>
                        <a href="/schools/{{ $school->id }}/classrooms/{{ $classroom->id }}/edit">{{ $classroom->name
                            }}</a>
                        @if ($classroom->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                            title="@lang('classrooms.classroom_inactive')"></i>
                        @endif
                    </td>

                    <td><a href="/schools/{{ $school->id }}/classrooms/{{ $classroom->id }}/users">123</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>


</div>



@endsection