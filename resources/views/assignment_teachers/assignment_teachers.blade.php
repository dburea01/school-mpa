@extends('layouts.app_layout')
@section('title', __('titles.teacher-assignments'))
@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center text-primary">@lang('assignment-teachers.title')</h1>

<div class="row mt-5 mb-3">
    <div class="col-md-8">
        <form class="row" action="/assignment-teachers">
            <div class="col-md-3 col-sm-12">
                <x-select-teacher name="user_id" id="user_id" required="false" :value="$user_id"
                    placeholder="{{ __('assignment-teachers.placeholder_teacher') }}" />
            </div>

            <div class="col-md-3 col-sm-12">
                <x-select-classroom name="classroom_id" id="classroom_id" required="false" :value="$classroom_id"
                    placeholder="{{ __('assignment-teachers.placeholder_classroom') }}" />
            </div>

            <div class="col-md-3 col-sm-12">
                <x-select-subject name="subject_id" id="subject_id" required="false" :value="$subject_id"
                    placeholder="{{ __('assignment-teachers.placeholder_subject') }}" />
            </div>

            <div class="col-md-3 col-sm-12 d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi bi-funnel"
                        aria-hidden="true"></i>
                    @lang('assignment-teachers.filter')</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of assignments">

            <thead>
                <tr>
                    <th>@lang('assignment-teachers.teachers')</th>
                    <th>@lang('assignment-teachers.classrooms')</th>
                    <th>@lang('assignment-teachers.subjects')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($assignmentTeachers as $assignment)
                <tr>
                    <td>
                        {{ $assignment->user->fullName }}
                        @if ($assignment->user->status === 'INACTIVE')
                        <x-alert-user-inactive />@endif
                    </td>
                    <td>{{ $assignment->classroom->name }}</td>
                    <td>{{ $assignment->subject->name }}</td>

                    <td>
                        <form action="/assignment-teachers/{{ $assignment->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" aria-label="add"
                                title="@lang('assignment-teachers.delete_assignment')">
                                <i class="bi bi-trash" aria-hidden="true"></i> </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @if($assignmentTeachers->hasPages())
    <div class="d-flex justify-content-center">
        {{ $assignmentTeachers->withQueryString()->links() }}
    </div>
    @endif

</div>
@endsection
