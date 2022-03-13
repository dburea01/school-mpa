@extends('layouts.layout_with_horizontal_menu')

@section('content')

@include('errors.session-values')

<h1 class="text-center">@lang('potential_duplicated_user.title')</h1>

<p>@lang('potential_duplicated_user.explanation')</p>

<div class="row mt-3 mb-3">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">@lang('potential_duplicated_user.user_to_create')</div>
            <div class="card-body">
                <form action="/schools/{{ $school->id }}/users/potential-duplicated-user" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="role_id" class="col-sm-4 col-form-label">@lang('user.role') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="role_id" name="role_id" value="{{ session('userToCreate.role_id') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="last_name" class="col-sm-4 col-form-label">@lang('user.last_name') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="last_name" name="last_name" value="{{ session('userToCreate.last_name') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="first_name" class="col-sm-4 col-form-label">@lang('user.first_name') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="first_name" name="first_name" value="{{ session('userToCreate.first_name') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="birth_date" class="col-sm-4 col-form-label">@lang('user.birth_date') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="birth_date" name="birth_date" value="{{ session('userToCreate.birth_date') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gender_id" class="col-sm-4 col-form-label">@lang('user.gender_id') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="gender_id" name="gender_id" value="{{ session('userToCreate.gender_id') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-4 col-form-label">@lang('user.email') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="email" name="email" value="{{ session('userToCreate.email') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-sm-4 col-form-label">@lang('user.status') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="status" name="status" value="{{ session('userToCreate.status') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-sm-4 col-form-label">@lang('user.comment') :</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="comment" name="comment" value="{{ session('userToCreate.comment') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col d-grid gap-2 d-block">
                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                                @lang('potential_duplicated_user.confirm_duplicated_user')</button>

                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">
                                <i class="bi bi-chevron-left" aria-hidden="true"></i>
                                @lang('potential_duplicated_user.cancel_duplicated_user')
                            </a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">@lang('potential_duplicated_user.existing_users')</div>
            <div class="card-body">
                @if(session('existingUsers'))
                <table class="table table-bordered table-sm table-striped" aria-label="existing users">
                    <thead>
                        <tr>
                            <th>@lang('user.full_name')</th>
                            <th>@lang('user.role_name')</th>
                            <th>@lang('user.birth_date')</th>
                        </tr>
                        @foreach (session('existingUsers') as $existingUser)
                        <tr>
                            <td>{{ $existingUser->full_name }}</td>
                            <td>{{ $existingUser->role->name }}</td>
                            <td>{{ $existingUser->birth_date }}</td>
                        </tr>
                        @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection