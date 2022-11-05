@extends('layouts.app_layout')

@section('content')

@include('errors.session-values')


<h2 class="text-center">@if ($period->id) @lang('period.modify_period') @else @lang('period.create_period') @endif</h2>

@if ($period->id)
<form action="/periods/{{ $period->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/periods" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('period.name') :
                *</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" required
                    name="name" id="name" maxlength="30" value="{{ old('name', $period->name) }}">
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_date"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('period.start_date') : *</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm @error('start_date') is-invalid @enderror"
                    required name="start_date" id="start_date" maxlength="10"
                    value="{{ old('start_date', $period->start_date) }}">
                @if ($errors->has('start_date'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
            </div>
            <div class="col-auto">
                <span class="form-text">@lang('period.date_format')</span>
            </div>
        </div>

        <div class="row mb-3">
            <label for="end_date"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('period.end_date') : *</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm @error('end_date') is-invalid @enderror" required
                    name="end_date" id="end_date" maxlength="10" value="{{ old('end_date', $period->end_date) }}">
                @if ($errors->has('end_date'))
                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
            </div>
            <div class="col-auto">
                <span id="passwordHelpInline" class="form-text">@lang('period.date_format')</span>
            </div>
        </div>

        <div class="row mb-3">
            <label for="current" class="col-sm-2 form-check-label">@lang('period.current') :</label>

            <div class="col-sm-2">
                <input type="checkbox" class="form-check-input" @if ($period->current) checked @endif name="current"
                id="current" >
                @if ($errors->has('current'))
                <span class="text-danger">{{ $errors->first('current') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('period.comment')
                :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment"
                    id="comment" rows="4" maxlength="500">{{ old('comment', $period->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>





        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    @lang('period.save')</button>
                @if ($period->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeletePeriod"><i class="bi bi-trash" aria-hidden="true"></i>
                    @lang('period.delete')</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeletePeriod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('period.title_modal_delete')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('period.p_warning_delete_period')</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/periods/{{$period->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left" aria-hidden="true"></i> @lang('period.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"
                                aria-hidden="true"></i> @lang('period.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
