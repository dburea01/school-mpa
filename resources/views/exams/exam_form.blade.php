@extends('layouts.app_layout')

@section('title', __('titles.exam_edit'))

@section('content')

@include('errors.session-values')


<h2 class="text-center">@if ($exam->id) @lang('exam.modify_exam') @else @lang('exam.create_exam') @endif
</h2>

@if ($exam->id)
<form action="/schools/{{ $school->id }}/exams/{{ $exam->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/schools/{{ $school->id }}/exams" method="POST">
        @endif

        @csrf

        {{-- title --}}
        <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('exam.title') :
                *</label>
            <div class="col">
                <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" required
                    name="title" id="title" maxlength="30" value="{{ old('title', $exam->title) }}">
                @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>

        {{-- classroom --}}
        <div class="row mb-3">
            <label for="classroom_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('exam.classroom') :
                *</label>

            <div class="col-sm-4">
                <x-select-classroom name="classroom_id" id="classroom_id" required="true" :school="$school"
                    :placeholder="__('exams.select_a_classroom')" :value="$exam->classroom_id" />
                @if ($errors->has('classroom_id'))
                <span class="text-danger">{{ $errors->first('classroom_id') }}</span>
                @endif
            </div>
        </div>

        {{-- exam type --}}
        <div class="row mb-3">
            <label for="exam_type_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('exam.exam_type') :
                *</label>

            <div class="col-sm-4">
                <x-select-exam-type name="exam_type_id" id="exam_type_id" required="true" :school="$school"
                    :placeholder="__('exam.select_an_exam_type')" :value="$exam->exam_type_id" />
                @if ($errors->has('exam_type_id'))
                <span class="text-danger">{{ $errors->first('exam_type_id') }}</span>
                @endif
            </div>
        </div>

        {{-- subject --}}
        <div class="row mb-3">
            <label for="subject_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('exam.subject_id') :
                *</label>

            <div class="col-sm-4">
                <x-select-subject name="subject_id" id="subject_id" required="true" :school="$school"
                    :placeholder="__('exam.select_a_subject')" :value="$exam->subject_id" />
                @if ($errors->has('subject_id'))
                <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                @endif
            </div>
        </div>

        {{-- status --}}
        <div class="row mb-3">
            <label for="exam_status_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('exam.exam_status_id') :
                *</label>

            <div class="col-sm-4">
                <x-select-exam-status name="exam_status_id" id="exam_status_id" required="true"
                    :placeholder="__('exam.select_a_status')" :value="$exam->exam_status_id" />
                @if ($errors->has('exam_status_id'))
                <span class="text-danger">{{ $errors->first('exam_status_id') }}</span>
                @endif
            </div>
        </div>

        {{-- description --}}
        <div class="row mb-3">
            <label for="description"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('exam.description') :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                    name="description" id="description" rows="4"
                    maxlength="500">{{ old('description', $exam->description) }}</textarea>
                @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>

        {{-- instruction --}}
        <div class="row mb-3">
            <label for="instruction"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('exam.instruction') :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('instruction') is-invalid @enderror"
                    name="instruction" id="instruction" rows="4"
                    maxlength="500">{{ old('instruction', $exam->instruction) }}</textarea>
                @if ($errors->has('instruction'))
                <span class="text-danger">{{ $errors->first('instruction') }}</span>
                @endif
            </div>
        </div>

        {{-- start date --}}
        <div class="row mb-3">
            <label for="start_date"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('exam.start_date') :
                *</label>
            <div class="col-sm-2">
                <input type="date" class="form-control form-control-sm @error('start_date') is-invalid @enderror"
                    required name="start_date" id="start_date" value="{{ old('start_date', $exam->start_date) }}">
                <div id="startDateHelpBlock" class="form-text">@lang('exam.format_date')</div>
                @if ($errors->has('start_date'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif

            </div>
        </div>

        {{-- end date --}}
        <div class="row mb-3">
            <label for="end_date" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('exam.end_date')
                :</label>
            <div class="col-sm-2">
                <input type="date" class="form-control form-control-sm @error('end_date') is-invalid @enderror"
                    name="end_date" id="end_date" value="{{ old('end_date', $exam->end_date) }}">
                <div id="startDateHelpBlock" class="form-text">@lang('exam.format_date')</div>
                @if ($errors->has('end_date'))
                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    @lang('exam.save')</button>
                @if ($exam->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteExam"><i class="bi bi-trash" aria-hidden="true"></i>
                    @lang('exam.delete')</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteExam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('exam.title_modal_delete')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('exam.p_warning_delete_subject')</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/schools/{{$school->id}}/exams/{{$exam->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left" aria-hidden="true"></i>
                            @lang('exam.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"
                                aria-hidden="true"></i> @lang('exam.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
