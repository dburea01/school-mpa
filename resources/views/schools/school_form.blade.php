@extends('layouts.app_layout')

@section('title', 'school')

@section('content')

@include('errors.session-values')


<h2 class="text-center">@lang('school.modify_school')</h2>



<form action="/schools" method="POST">

    @method('PUT')
    @csrf

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('school.name') :
            *</label>

        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" required
                name="name" id="name" maxlength="60" value="{{ old('name', $school->name) }}">
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <div class="row">
        <label for="address1" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('school.address') :
            *</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm @error('address1') is-invalid @enderror" required
                name="address1" id="address1" maxlength="60" value="{{ old('address1', $school->address1) }}">
            @if ($errors->has('address1'))
            <span class="text-danger">{{ $errors->first('address1') }}</span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 offset-sm-2">
            <input type="text" class="form-control form-control-sm @error('address2') is-invalid @enderror"
                name="address2" id="address2" maxlength="60" value="{{ old('address2', $school->address2) }}">
            @if ($errors->has('address2'))
            <span class="text-danger">{{ $errors->first('address2') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <input type="text" class="form-control form-control-sm @error('address3') is-invalid @enderror"
                name="address3" id="address3" maxlength="60" value="{{ old('address3', $school->address3) }}">
            @if ($errors->has('address3'))
            <span class="text-danger">{{ $errors->first('address3') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label for="country_id" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('school.country')
            : *</label>

        <div class="col-sm-2">
            <input type="text"
                class="form-control form-control-sm @error('country_id') is-invalid @enderror text-uppercase" required
                name="country_id" id="country_id" maxlength="2" value="{{ old('country_id', $school->country_id) }}">
            @if ($errors->has('country_id'))
            <span class="text-danger">{{ $errors->first('country_id') }}</span>
            @endif
        </div>
    </div>


    <div class="row mb-3">
        <label for="zip_code" class="col-sm-2 col-form-label col-form-label-sm text-truncate">
            @lang('school.zip_code') : *</label>

        <div class="col-sm-2">
            <input type="text" class="form-control form-control-sm @error('zip_code') is-invalid @enderror" required
                name="zip_code" id="zip_code" maxlength="10" value="{{ old('zip_code', $school->zip_code) }}">
            @if ($errors->has('zip_code'))
            <span class="text-danger">{{ $errors->first('zip_code') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <label for="city" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('school.city') :
            *</label>

        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" required
                name="city" id="city" maxlength="60" value="{{ old('city', $school->city) }}">
            @if ($errors->has('city'))
            <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
        </div>
    </div>



    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                OK</button>

        </div>
    </div>
</form>

@endsection
