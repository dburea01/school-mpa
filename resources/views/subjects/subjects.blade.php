@extends('layouts.app_layout')
@section('title', __('titles.subjects'))
@section('content')

@include('errors.session-values')

<h1 class="text-center">@lang('subjects.title') ({{$subjects->count()}})&nbsp;
    <a href="/subjects/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        @lang('subjects.add')</a>
</h1>

<div class="row">
    <div class="col">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of the subjects">
            <thead>
                <tr>
                    <th>@lang('subjects.short_name')</th>
                    <th>@lang('subjects.name')</th>
                    <th>@lang('subjects.assigned_teachers')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td>
                        <a href="/subjects/{{ $subject->id }}/edit">{{
                            $subject->short_name }}</a>

                        @if ($subject->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                            title="@lang('subjects.subject_inactive')"></i>
                        @endif

                        @if($subject->comment)
                        <i class="bi bi-card-text" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="{{ $subject->comment }}"></i>
                        @endif
                    </td>
                    <td>{{ $subject->name }}</td>
                    <td>
                        @php
                        $quantityAssignmentTeachers = $assignmentTeachers
                        ->filter( function ($assignmentTeacher) use($subject){
                        return $assignmentTeacher->classroom_id == $subject->id;
                        })->count();
                        @endphp
                        <a href="/assignment-teachers?classroom_id={{$subject->id}}">
                            {{ $quantityAssignmentTeachers }}
                        </a>
                        @if ($quantityAssignmentTeachers === 0)
                        &nbsp;&nbsp;<i class="bi bi-exclamation-triangle text-danger"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
