@extends('layouts.layout_with_horizontal_menu')

@section('content')

@include('errors.session-values')


<h1 class="text-center">@lang('subjects.title') ({{$subjects->count()}})&nbsp;<a href="/schools/{{ $school->id }}/subjects/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i>
        @lang('subjects.add')</a></h1>


<div class="row">
    <div class="col">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>@lang('subjects.short_name')</th>
                    <th>@lang('subject.name')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                <tr>
                    <td>
                        <a href="/schools/{{ $school->id }}/subjects/{{ $subject->id }}/edit">{{
                            $subject->short_name }}</a>
                        @if ($subject->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" title="@lang('subjects.subject_inactive')"></i>
                        @endif
                    </td>
                    <td>{{ $subject->name }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>



@endsection