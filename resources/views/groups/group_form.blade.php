@extends('layouts.layout_with_horizontal_menu')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h2 class="text-center mb-3">@if ($group->id) @lang('group.modify_group', ['group_name' => $group->name]) @else @lang('group.create_group') @endif</h2>

<x-group-tabs activeTab="address" schoolId="{{ $school->id }}" groupId="{{ $group->id }}" newGroup="{{ $group->id ? false : true }}" />


@if ($group->id)
<form action=" /schools/{{ $school->id }}/groups/{{ $group->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/schools/{{ $school->id }}/groups" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('group.name') :
                *</label>

            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror text-uppercase" required name="name" id="name" maxlength="60" value="{{ old('name', $group->name) }}" />
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="row">
            <label for="address1" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('group.address')
                : *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('address1') is-invalid @enderror" required name="address1" id="address1" maxlength="60" value="{{ old('address1', $group->address1) }}" />
                @if ($errors->has('address1'))
                <span class="text-danger">{{ $errors->first('address1') }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 offset-sm-2">
                <input type="text" class="form-control form-control-sm @error('address2') is-invalid @enderror" name="address2" id="address2" maxlength="60" value="{{ old('address2', $group->address2) }}" />
                @if ($errors->has('address2'))
                <span class="text-danger">{{ $errors->first('address2') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <input type="text" class="form-control form-control-sm @error('address3') is-invalid @enderror" name="address3" id="address3" maxlength="60" value="{{ old('address3', $group->address3) }}" />
                @if ($errors->has('address3'))
                <span class="text-danger">{{ $errors->first('address3') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="country_id" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('group.country') : *</label>

            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm @error('country_id') is-invalid @enderror text-uppercase" required name="country_id" id="country_id" maxlength="2" value="{{ old('country_id', $group->country_id) }}" />
                @if ($errors->has('country_id'))
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="zip_code" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('group.zip_code') : *</label>

            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm @error('zip_code') is-invalid @enderror" required name="zip_code" id="zip_code" maxlength="10" value="{{ old('zip_code', $group->zip_code) }}" />
                @if ($errors->has('zip_code'))
                <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('group.city') :
                *</label>

            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" required name="city" id="city" maxlength="60" value="{{ old('city', $group->city) }}" />
                @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label col-form-label-sm">@lang('group.status') : *</label>

            <div class="col-sm-2">
                <x-select-school-status name="status" id="status" required="true" :status="$group->status" />
                @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('group.comment')
                :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment" id="comment" rows="4" maxlength="500">{{ old('comment', $group->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2"></i>
                    @lang('group.save')</button>
                @if ($group->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteGroup"><i class="bi bi-trash"></i> @lang('group.delete', ['name' =>
                    $group->name])</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('group.modal_title_delete_group', ['name' =>
                        $group->name])</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang('group.modal_warning_no_possible_rollback', ['name' => $group->name])</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/schools/{{$school->id}}/groups/{{ $group->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-chevron-left"></i> @lang('group.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"></i>@lang('group.confirm_delete', ['name' => $group->name])</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection