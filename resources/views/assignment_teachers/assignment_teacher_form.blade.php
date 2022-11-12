@extends('layouts.app_layout')
@section('title', __('titles.teacher-assignments'))
@section('content')

@include('errors.session-values')


<h2 class="text-center">
    @if ($assignmentTeacher->id)
    @lang('assignment-teacher.modify_assignment')
    @else
    @lang('assignment-teacher.create_assignment')
    @endif
</h2>

@if ($assignmentTeacher->id)
<form action="/assignment-teachers/{{ $assignmentTeacher->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/assignment-teachers" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="user_id"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('assignment-teacher.teacher') :
                *</label>
            <div class="col-md-6 col-sm-10">
                <x-select-teacher name="user_id" id="user_id" required="true"
                    :value="old('user_id', $assignmentTeacher->user_id)"
                    placeholder="{{ __('assignment-teacher.placeholder_teacher') }}" />

                @if ($errors->has('user_id'))
                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="subject_id"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('assignment-teacher.subject') :
                *</label>
            <div class="col-md-6 col-sm-10">
                <x-select-subject name="subject_id" id="subject_id" required="true"
                    :value="old('subject_id', $assignmentTeacher->subject_id)"
                    placeholder="{{ __('assignment-teacher.placeholder_subject') }}" />

                @if ($errors->has('subject_id'))
                <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="classroom_id"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('assignment-teacher.classroom') :
                *</label>
            <div class="col-md-6 col-sm-10">
                <x-select-classroom name="classroom_id" id="classroom_id" required="true"
                    :value="old('classroom_id', $assignmentTeacher->classroom_id)"
                    placeholder="{{ __('assignment-teacher.placeholder_classroom') }}" />

                @if ($errors->has('classroom_id'))
                <span class="text-danger">{{ $errors->first('classroom_id') }}</span>
                @endif
            </div>
        </div>







        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label col-form-label-sm text-truncate">
                @lang('assignment-teacher.comment') :
            </label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment"
                    id="comment" rows="4" maxlength="500">{{ old('comment', $assignmentTeacher->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>





        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    @lang('assignment-teacher.save')</button>
                @if ($assignmentTeacher->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteAssignmentTeacher"><i class="bi bi-trash" aria-hidden="true"></i>
                    @lang('assignment-teacher.delete')</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteAssignmentTeacher" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('assignment-teacher.title_modal_delete')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('assignment-teacher.p_warning_delete_assignment_teacher')</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/assignment-teachers/{{$assignmentTeacher->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left" aria-hidden="true"></i>
                            @lang('assignment-teacher.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"
                                aria-hidden="true"></i> @lang('assignment-teacher.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
