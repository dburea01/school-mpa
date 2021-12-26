@extends('layouts.layout_with_menu_sidebar')

@section('title', 'school')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>



<h2 class="text-center">@if ($school->id) Modify school @else Create school @endif</h2>

@if ($school->id)
<form action="/schools/{{ $school->id }}" method="POST">
    @method('PUT')
    @else
    <form action="/schools" method="POST">
        @endif

        @csrf

        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label text-truncate">Name : *</label>

            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" required name="name"
                    id="name" maxlength="60" value="{{ old('name', $school->name) }}" />
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <label for="address1" class="col-sm-2 col-form-label text-truncate">Address : *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('address1') is-invalid @enderror" required name="address1"
                    id="address1" maxlength="60" value="{{ old('address1', $school->address1) }}" />
                @if ($errors->has('address1'))
                <span class="text-danger">{{ $errors->first('address1') }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 offset-sm-2">
                <input type="text" class="form-control @error('address2') is-invalid @enderror" name="address2"
                    id="address2" maxlength="60" value="{{ old('address2', $school->address2) }}" />
                @if ($errors->has('address2'))
                <span class="text-danger">{{ $errors->first('address2') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <input type="text" class="form-control @error('address3') is-invalid @enderror" name="address3"
                    id="address3" maxlength="60" value="{{ old('address3', $school->address3) }}" />
                @if ($errors->has('address3'))
                <span class="text-danger">{{ $errors->first('address3') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="country_id" class="col-sm-2 col-form-label text-truncate">Country : *</label>

            <div class="col-sm-2">
                <input type="text" class="form-control @error('country_id') is-invalid @enderror" required
                    name="country_id" id="country_id" maxlength="2"
                    value="{{ old('country_id', $school->country_id) }}" />
                @if ($errors->has('country_id'))
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                @endif
            </div>
        </div>


        <div class="row mb-3">
            <label for="zip_code" class="col-sm-2 col-form-label text-truncate">Postal code : *</label>

            <div class="col-sm-2">
                <input type="text" class="form-control @error('zip_code') is-invalid @enderror" required name="zip_code"
                    id="zip_code" maxlength="10" value="{{ old('zip_code', $school->zip_code) }}" />
                @if ($errors->has('zip_code'))
                <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label text-truncate">City : *</label>

            <div class="col-sm-10">
                <input type="text" class="form-control @error('city') is-invalid @enderror" required name="city"
                    id="city" maxlength="60" value="{{ old('city', $school->city) }}" />
                @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
        </div>

        @if(Auth::user()->isSuperAdmin())
        <div class="row mb-3">
            <label for="max_users" class="col-sm-2 col-form-label text-truncate">Max users : *</label>

            <div class="col-sm-2">
                <input type="number" class="form-control @error('max_users') is-invalid @enderror" required
                    name="max_users" min="0" id="max_users" value="{{ old('max_users', $school->max_users) }}" />
                @if ($errors->has('max_users'))
                <span class="text-danger">{{ $errors->first('max_users') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label text-truncate">Comment :</label>

            <div class="col-sm-10">
                <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment"
                    rows="4" maxlength="500">{{ old('comment', $school->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>
        @endif

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-success">OK</button>
                @if ($school->id)
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteSchool">Delete</button>
                @endif
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalDeleteSchool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete this school</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>WARNING : NO POSSIBLE ROLLBACK. Please confirm.</p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" method="POST" action="/schools/{{$school->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection