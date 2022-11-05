@extends('layouts.app_layout')
@section('title', __('titles.appreciations'))
@section('content')

@include('errors.session-values')


<h2 class="text-center">@if ($appreciation->id) @lang('appreciation.modify_appreciation') @else
    @lang('appreciation.create_appreciation') @endif
</h2>

@if ($appreciation->id)
<form action="/appreciations/{{ $appreciation->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/appreciations" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="short_name"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('appreciation.short_name') :
                *</label>
            <div class="col-sm-2">
                <input type="text"
                    class="form-control form-control-sm @error('short_name') is-invalid @enderror text-uppercase"
                    required name="short_name" id="short_name" maxlength="10"
                    value="{{ old('short_name', $appreciation->short_name) }}">
                @if ($errors->has('short_name'))
                <span class="text-danger">{{ $errors->first('short_name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="name_fr" class="col-sm-2 col-form-label col-form-label-sm text-truncate">
                @lang('appreciation.name_fr') :
                *</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm @error('name_fr') is-invalid @enderror" required
                    name="name_fr" id="name_fr" maxlength="30"
                    value="{{ old('name_fr', $appreciation->getTranslation('name', 'fr')) }}">
                @if ($errors->has('name_fr'))
                <span class="text-danger">{{ $errors->first('name_fr') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="name_en" class="col-sm-2 col-form-label col-form-label-sm text-truncate">
                @lang('appreciation.name_en') :
            </label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm @error('name_en') is-invalid @enderror"
                    name="name_en" id="name_en" maxlength="30"
                    value="{{ old('name_en', $appreciation->getTranslation('name','en')) }}">
                @if ($errors->has('name_en'))
                <span class="text-danger">{{ $errors->first('name_en') }}</span>
                @endif
            </div>
        </div>



        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label col-form-label-sm">@lang('appreciation.status') :
                *</label>

            <div class="col-sm-2">
                <x-select-appreciation-status name="status" id="status" required="true"
                    :status="$appreciation->status" />
                @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('appreciation.comment') :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment"
                    id="comment" rows="4" maxlength="500">{{ old('comment', $appreciation->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>





        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    @lang('appreciation.save')</button>
                @if ($appreciation->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteAppreciation"><i class="bi bi-trash" aria-hidden="true"></i>
                    @lang('appreciation.delete')</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteAppreciation" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('appreciation.title_modal_delete')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('appreciation.p_warning_delete_appreciation')</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/appreciations/{{$appreciation->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left" aria-hidden="true"></i>
                            @lang('appreciation.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"
                                aria-hidden="true"></i> @lang('appreciation.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
