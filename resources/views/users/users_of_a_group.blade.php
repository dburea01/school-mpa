@extends('layouts.layout_with_menu_sidebar')

@section('content')


<h2 class="text-center mb-3">@if ($group->id) @lang('group.modify_group') @else @lang('group.create_group') @endif</h2>

<x-group-tabs activeTab="parents" schoolId="{{ $school->id }}" groupId="{{ $group->id }}" />

<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-header text-center">@lang('group.users_of_a_group')</div>
            <div class="card-body">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('group.user_name_of_a_group')</th>
                            <th>@lang('group.user_role_of_a_group')</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ $item->role->name }}</td>
                            <td><a class="btn btn-sm btn-primary"
                                    href="/schools/{{ $school->id }}/groups/{{$group->id}}/users/{{$item->id}}/edit"><i
                                        class="bi bi-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteUser"><i class="bi bi-trash"></i></button>
                                @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col">

        <div class="card">
            <div class="card-header text-center">@lang('group.add_user_of_a_group')</div>
            <div class="card-body">

                <div class="row">
                    <div class="col mx-auto">
                        @include('errors.session-values')
                    </div>
                </div>

                @if ($user->id)
                <form action="/schools/{{ $school->id }}/groups/{{ $group->id }}/users/{{ $user->id }}" method="POST">
                    @method('PUT')
                    @else
                    <form action="/schools/{{ $school->id }}/groups/{{ $group->id }}/users" method="POST">
                        @endif

                        @csrf
                        <div class="mb-3">
                            <label for="role_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('user.role_id')
                                : *</label>
                            <x-select-role name="role_id" id="role_id" required="true" :value="$user->role_id" />
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">@lang('user.last_name') : *</label>
                            <input type="text"
                                class="form-control form-control-sm @error('last_name') is-invalid @enderror text-uppercase"
                                name="last_name" id="last_name" maxlength="60"
                                value="{{ old('last_name', $user->last_name) }}" required>
                            @if ($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                        <div class=" mb-3">
                            <label for="first_name" class="form-label">@lang('user.first_name') : *</label>
                            <input type="text"
                                class="form-control form-control-sm @error('first_name') is-invalid @enderror text-capitalize"
                                name="first_name" id="first_name" maxlength="60"
                                value="{{ old('first_name', $user->first_name) }}" required>
                            @if ($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">@lang('user.birth_date') : *</label>
                            <input type="text"
                                class="form-control form-control-sm @error('birth_date') is-invalid @enderror"
                                name="birth_date" id="birth_date" maxlength="10"
                                value="{{ old('birth_date', $user->birth_date) }}" required>
                            @if ($errors->has('birth_date'))
                            <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('user.email') : </label>
                            <input type="email"
                                class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email', $user->email) }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">@lang('user.status') : </label>
                            <x-select-user-status name="status" id="status" required="true" :status="$user->status" />
                            @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('user.title_modal_delete', ['full_name' =>
                    $user->full_name])</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>@lang('user.warning_no_possible_rollback')</p>
            </div>
            <div class="modal-footer">
                <form class="form-inline" method="POST"
                    action="/schools/{{ $school->id }}/groups/{{ $group->id }}/users/{{ $user->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-chevron-left"></i> @lang('user.cancel_delete')</button>
                    <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"></i>
                        @lang('user.confirm_delete', ['full_name' => $user->full_name])</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection