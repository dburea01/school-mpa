@extends('layouts.layout_with_horizontal_menu')

@section('title', 'school')

@section('content')

@include('errors.session-values')


<h2 class="text-center">@if ($subject->id) @lang('subject.modify_subject') @else @lang('subject.create_subject') @endif</h2>

@if ($subject->id)
<form action="/schools/{{ $school->id }}/subjects/{{ $subject->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/schools/{{ $school->id }}/subjects" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('subject.name') : *</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" required name="name" id="name" maxlength="30" value="{{ old('name', $subject->name) }}" />
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="short_name" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('subject.short_name') : *</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm @error('short_name') is-invalid @enderror text-uppercase" required name="short_name" id="short_name" maxlength="10" value="{{ old('short_name', $subject->short_name) }}" />
                @if ($errors->has('short_name'))
                <span class="text-danger">{{ $errors->first('short_name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label col-form-label-sm">@lang('subject.status') : *</label>

            <div class="col-sm-2">
                <x-select-subject-status name="status" id="status" required="true" :status="$subject->status" />
                @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('subject.comment') :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment" id="comment" rows="4" maxlength="500">{{ old('comment', $subject->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>





        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2"></i> @lang('subject.save')</button>
                @if ($subject->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteSubject"><i class="bi bi-trash"></i> @lang('subject.delete')</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('subject.title_modal_delete')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('subject.p_warning_delete_subject')</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/schools/{{$school->id}}/subjects/{{$subject->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left"></i> @lang('subject.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"></i> @lang('subject.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection