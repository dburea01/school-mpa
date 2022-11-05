@extends('layouts.app_layout')
@section('title', __('titles.results'))
@section('content')

@include('errors.session-values')


<h1 class="text-center">@lang('results.title')</h1>

<div class="row">
    <div class="col-md-8">

        @foreach ($students as $student)
        <div class="row border">
            <div class="col-md-4">
                {{ $student->last_name.' '.$student->first_name }}
            </div>
            <div class="col-md-8">
                <form class="row" action="/exams/{{ $exam->id }}/results" method="POST">
                    @csrf
                    <input type="text" name="user_id" value="{{ $student->id }}">
                    <div class="col-3">
                        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror"
                            required name="note_num"
                            value="@if($student->result) {{ $student->result->note_num }} @endif">
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror"
                            required name="note_alpha"
                            value="@if($student->result) {{ $student->result->note_alpha }} @endif">
                    </div>
                    <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror"
                        required name="comment" value="@if($student->result) {{ $student->result->comment }} @endif">

                    <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach

    </div>
    <div class="col-md-4">
        <h3 class="text-center">Summary to do</h3>
    </div>

</div>



@endsection
