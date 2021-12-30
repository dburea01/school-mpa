@extends('layouts.layout_with_menu_sidebar')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h2 class="text-center">@if ($user->id) @lang('user.modify_user') @else @lang('user.create_user') @endif</h2>

@if ($user->id)
<form action="/schools/{{ $school->id }}/users/{{ $user->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/schools/{{ $school->id }}/users" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="last_name" class="col-sm-2 col-form-label text-truncate">@lang('user.last_name') : *</label>

            <div class="col-sm-10">
                <input type="text" class="form-control @error('last_name') is-invalid @enderror text-uppercase" required
                    name="last_name" id="last_name" maxlength="60" value="{{ old('last_name', $user->last_name) }}" />
                @if ($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="first_name" class="col-sm-2 col-form-label text-truncate">@lang('user.first_name') : *</label>

            <div class="col-sm-10">
                <input type="text" class="form-control @error('first_name') is-invalid @enderror text-capitalize"
                    required name="first_name" id="first_name" maxlength="60"
                    value="{{ old('first_name', $user->first_name) }}" />
                @if ($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="birth_date" class="col-sm-2 col-form-label text-truncate">@lang('user.birth_date') : *</label>

            <div class="col-sm-4">
                <input type="text" class="form-control @error('birth_date') is-invalid @enderror" required
                    name="birth_date" id="birth_date" value="{{ old('birth_date', $user->birth_date) }}"
                    placeholder="@lang('user.placeholder_birth_date')" />
                <div class="col-sm-2 form-text">dd/mm/yyyy</div>

            </div>
            @if ($errors->has('birth_date'))
            <div class="col-sm-8">
                <span class="text-danger">{{ $errors->first('birth_date') }}</span>
            </div>
            @endif
        </div>


        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label text-truncate">@lang('user.email') : </label>

            <div class="col-sm-10">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                    value="{{ old('email', $user->email) }}" />
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>

        {{--
        <div class="row mb-3">
            <label for="genre_id" class="col-sm-2 col-form-label">@lang('user.genre_id') : *</label>

            <div class="col-sm-2">
                <x-select-user-genre name="genre_id" id="genre_id" required="true" :genre_id="$user->genre_id" />
                @if ($errors->has('genre_id'))
                <span class="text-danger">{{ $errors->first('genre_id') }}</span>
                @endif
            </div>
        </div>
        --}}
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">@lang('user.status') : *</label>

            <div class="col-sm-2">
                <x-select-user-status name="status" id="status" required="true" :status="$user->status" />
                @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label text-truncate">@lang('user.comment') :</label>

            <div class="col-sm-10">
                <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment"
                    rows="4" maxlength="500">{{ old('comment', $user->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-success">@lang('user.save')</button>
                @if ($user->id)
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteUser">@lang('user.delete')</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('user.title_modal_delete')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('user.warning_no_possible_rollback')</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/schools/{{ $school->id }}/users/{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary"
                            data-bs-dismiss="modal">@lang('user.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3">@lang('user.confirm_delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection