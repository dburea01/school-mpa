@extends('layouts.app_layout')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h2 class="text-center mb-3">@if ($classroom->id) @lang('classroom.modify_classroom', ['classroom_name' =>
    $classroom->name]) @else @lang('classroom.create_classroom') @endif</h2>

@if ($classroom->id)
<form action=" /schools/{{ $school->id }}/classrooms/{{ $classroom->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/schools/{{ $school->id }}/classrooms" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="period_id" class="col-sm-2 col-form-label col-form-label-sm text-truncate">
                @lang('classroom.period') : *
            </label>

            <div class="col-sm-10">
                <select class="form-select form-select-sm" name="period_id" id="period_id" required>
                    <option value="">@lang('select-period.select_a_period')</option>
                    @foreach ($periods as $period)
                    <option value="{{ $period->id }}" @if ($period->id === $classroom->period_id) selected @endif>
                        {{ $period->name }}
                        @if ($period->current) (***) @endif
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('period_id'))
                <span class="text-danger">{{ $errors->first('period_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label col-form-label-sm text-truncate">
                @lang('classroom.name') : *
            </label>

            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" required
                    name="name" id="name" maxlength="60" value="{{ old('name', $classroom->name) }}" />
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label col-form-label-sm">@lang('classroom.status') : *</label>

            <div class="col-sm-2">
                <x-select-classroom-status name="status" id="status" required="true" :status="$classroom->status" />
                @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('classroom.comment') :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment"
                    id="comment" rows="4" maxlength="500">{{ old('comment', $classroom->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    @lang('classroom.save')</button>
                @if ($classroom->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteClassroom"><i class="bi bi-trash" aria-hidden="true"></i>
                    @lang('classroom.delete', ['name' => $classroom->name])</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteClassroom" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @lang('classroom.modal_title_delete_classroom', ['name' => $classroom->name])</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('classroom.modal_warning_no_possible_rollback', ['name' => $classroom->name])</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST"
                        action="/schools/{{$school->id}}/classrooms/{{ $classroom->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left" aria-hidden="true"></i>&nbsp;
                            @lang('classroom.cancel_delete')
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3">
                            <i class="bi bi-trash" aria-hidden="true"></i>&nbsp;
                            @lang('classroom.confirm_delete', ['name' => $classroom->name])
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection