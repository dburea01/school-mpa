@extends('layouts.app_layout')
@section('title', __('titles.exams'))
@section('content')

@include('errors.session-values')


<h1 class="text-center">@lang('exams.title') ({{ $exams->total() }})&nbsp;<a
        href="/schools/{{ $school->id }}/exams/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"
            aria-hidden="true"></i>
        @lang('exams.add')</a></h1>

<div class="row mt-3 mb-3 d-flex">
    <div class="col">
        <form class="row" action="/schools/{{ $school->id }}/exams">
            <div class="col-md-3 col-sm-12">
                <input type="text" class="form-control form-control-sm mr-sm-2" name="filter_by_title"
                    id="filter_by_title" placeholder="@lang('exams.search')" value="{{ $filter_by_title }}">
            </div>


            <div class="col-md-2 col-sm-12">
                <x-select-classroom name="filter_by_classroom_id" id="filter_by_classroom_id" required="false"
                    :value="$filter_by_classroom_id" :school="$school" :placeholder="__('exams.filter_by_classroom')" />
            </div>

            <div class="col-md-2 col-sm-12">
                <x-select-subject name="filter_by_subject_id" id="filter_by_subject_id" required="false"
                    :value="$filter_by_subject_id" :school="$school" :placeholder="__('exams.filter_by_subject')" />
            </div>

            <div class="col-md-2 col-sm-12">
                <x-select-exam-type name="filter_by_exam_type_id" id="filter_by_exam_type_id" required="false"
                    :value="$filter_by_exam_type_id" :school="$school" :placeholder="__('exams.filter_by_exam_type')" />
            </div>

            <div class="col-md-2 col-sm-12">
                <x-select-exam-status name="filter_by_exam_status_id" id="filter_by_exam_status_id" required="false"
                    :value="$filter_by_exam_status_id" :placeholder="__('exams.filter_by_exam_status')" />
            </div>

            <div class="col-md-1 col-sm-12 d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary btn-sm btn-block" aria-label="Filter Exams"><i
                        class="bi bi-funnel" aria-hidden="true"></i></button>
            </div>

        </form>


    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="users list">
            <thead>
                <tr>
                    <th>@lang('exams.title')</th>
                    <th>@lang('exams.classroom')</th>
                    <th>@lang('exams.subject')</th>
                    <th>@lang('exams.type')</th>
                    <th>@lang('exams.status')</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                <tr class="align-middle">
                    <td class="text-truncate">
                        <a href="/schools/{{ $school->id }}/exams/{{ $exam->id }}/edit">{{ $exam->title }}</a>
                    </td>

                    <td>{{ $exam->classroom->name }}</td>
                    <td>{{ $exam->subject->short_name }}</td>
                    <td>{{ $exam->exam_type->short_name }}</td>
                    <td>{{ $exam->exam_status->short_name }}</td>


                </tr>
                @endforeach
            </tbody>

        </table>


        @if($exams->hasPages())
        <div class="d-flex justify-content-center">
            {{ $exams->withQueryString()->links() }}
        </div>
        @endif
    </div>



</div>


@endsection
