@extends('layouts.app_layout')
@section('title', __('titles.assignments'))
@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('assignment-teachers.title') <span class="text-primary">{{ $classroom->name }}</span></h1>

<div class="row mt-5">
    <div class="col-md-8 offset-md-2">

        @if($assignments->count() === 0)
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i> @lang('assignment-teachers.warning')
        </div>
        @endif

        <form action="/classrooms/{{ $classroom->id }}/assignments" method="POST">
            @csrf

            @foreach ($subjects as $subject)
            <div class="row border-bottom">
                <div class="col">
                    <label for="{{ $subject->id }}" class="form-check-label">
                        {{ $subject->name }} ({{ $subject->short_name }})
                    </label>
                    @if ($subject->status === 'INACTIVE')
                    <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                        title="@lang('subjects.subject_inactive')"></i>
                    @endif

                    @if($subject->comment)
                    <i class="bi bi-card-text" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="{{ $subject->comment }}"></i>
                    @endif
                </div>

                <div class="col">
                    select avec liste des enseignants par matiere
                </div>

            </div>
            @endforeach

            <div class="row mt-3">
                <div class="d-grid gap-2 d-block">
                    <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                        @lang('user_subjects.save')</button>
                </div>
            </div>
        </form>

    </div>
</div>


@endsection
