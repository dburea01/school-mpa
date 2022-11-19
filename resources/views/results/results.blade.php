@extends('layouts.app_layout')
@section('title', __('titles.results'))
@section('content')

@include('errors.session-values')




<div class="row">
    <div class="col-md-8">
        <h1 class="text-center text-primary">@lang('results.title')</h1>
        @foreach ($students as $student)
        <div class="row border p-1">
            <div class="col-md-4">
                {{ $student->last_name.' '.$student->first_name }}
            </div>
            <div class="col-md-8">
                <form action="/exams/{{ $exam->id }}/results" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ $student->id }}">
                        <div class="col-3">
                            <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror"
                                required name="note_num"
                                value="@if($student->result) {{ $student->result->note_num }} @endif">
                        </div>

                        <div class="col-3">
                            <x-select-appreciation name="appreciation_id" required="false" placeholder="appreciation"
                                :studentResult="$student->result" :appreciations="$appreciations" />
                        </div>

                        <div class="col-3">
                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2"
                                    aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror"
                                name="comment" rows="2"
                                maxlength="500">@if($student->result) {{ $student->result->comment }} @endif</textarea>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        @endforeach

    </div>
    <div class="col-md-4">
        <h1 class="text-center text-primary">@lang('results.summary')</h1>
        <x-table-exam-summary :exam="$exam" />
    </div>

</div>



@endsection
