@extends('layouts.app_layout')
@section('title', __('titles.assignments'))
@section('content')


<h1 class="text-center">@lang('assignments.title')</h1>

<div class="row">
    <div class="col-md-8 mx-auto">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of groups">
            <thead>
                <tr>
                    <th>@lang('assignments.class_name')</th>
                    <th>@lang('assignments.qty_assignments')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignmentsPerClassroom as $assignment)
                <tr>
                    <td>
                        <a href="/schools/{{ $school->id }}/schools/{{ $assignment->id }}/edit">
                            {{ $assignment->name }}
                        </a>
                    </td>

                    <td>
                        <a href="/schools/{{ $school->id }}?classroom_id={{ $assignment->id }}">{{
                            $assignment->name }}</a>
                        {{ $assignment->assignments_count }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>


</div>



@endsection