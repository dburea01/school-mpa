@extends('layouts.app_layout')
@section('title', __('titles.user_form'))
@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h2 class="text-center">@if ($user->id) @lang('user.modify_user') @else @lang('user.create_user') @endif</h2>




@if ($user->id)
<form action="/schools/{{ $school->id }}/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @else
    <form action="/schools/{{ $school->id }}/users" method="POST" enctype="multipart/form-data">
        @endif


        @csrf



        <div class="row mb-3">
            <label for="role_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('user.role') :
                *</label>

            <div class="col-sm-4">
                <x-select-role name="role_id" id="role_id" required="false" :value="$user->role_id" />
                @if ($errors->has('role_id'))
                <span class="text-danger">{{ $errors->first('role_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3 civility">
            <label for="civility_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('user.civility') :
                *</label>

            <div class="col-sm-4">
                <x-select-civility name="civility_id" id="civility_id" required="false" :value="$user->civility_id" />
                @if ($errors->has('civility_id'))
                <span class="text-danger">{{ $errors->first('civility_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="last_name"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.last_name') :
                *</label>

            <div class="col-sm-10">
                <input type="text"
                    class="form-control form-control-sm @error('last_name') is-invalid @enderror text-uppercase"
                    required name="last_name" id="last_name" maxlength="60"
                    value="{{ old('last_name', $user->last_name) }}">
                @if ($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="first_name"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.first_name') :
                *</label>

            <div class="col-sm-10">
                <input type="text"
                    class="form-control form-control-sm @error('first_name') is-invalid @enderror text-capitalize"
                    required name="first_name" id="first_name" maxlength="60"
                    value="{{ old('first_name', $user->first_name) }}">
                @if ($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3 student">
            <label for="birth_date"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.birth_date') :
                *</label>

            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm @error('birth_date') is-invalid @enderror"
                    name="birth_date" id="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
                <div class="col-sm-2 form-text">dd/mm/yyyy</div>

            </div>
            @if ($errors->has('birth_date'))
            <div class="col-sm-10 offset-sm-2">
                <span class="text-danger">{{ $errors->first('birth_date') }}</span>
            </div>
            @endif
        </div>

        <div class="row mb-3 student">
            <label for="gender_id" class="col-sm-2 col-form-label col-form-label-sm">@lang('user.gender') :
                *</label>

            <div class="col-sm-2">
                <x-select-user-gender name="gender_id" id="gender_id" required="false"
                    :value="old('gender_id', $user->gender_id)" />
                @if ($errors->has('gender_id'))
                <span class="text-danger">{{ $errors->first('gender_id') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.email') :
            </label>

            <div class="col-sm-10">
                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                    name="email" id="email" value="{{ old('email', $user->email) }}">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="address1" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.address1')
                :
            </label>

            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('address1') is-invalid @enderror"
                    name="address1" id="address1" value="{{ old('address1', $user->address1) }}">
                @if ($errors->has('address1'))
                <span class="text-danger">{{ $errors->first('address1') }}</span>
                @endif
            </div>
            <div class="col-sm-10 offset-md-2">
                <input type="text" class="form-control form-control-sm @error('address2') is-invalid @enderror"
                    name="address2" id="address2" value="{{ old('address2', $user->address2) }}" aria-label="address2">
                @if ($errors->has('address2'))
                <span class="text-danger">{{ $errors->first('address2') }}</span>
                @endif
            </div>
            <div class="col-sm-10 offset-md-2">
                <input type="text" class="form-control form-control-sm @error('address3') is-invalid @enderror"
                    name="address3" id="address3" value="{{ old('address3', $user->address3) }}" aria-label="address3">
                @if ($errors->has('address3'))
                <span class="text-danger">{{ $errors->first('address3') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.city') :
            </label>

            <div class="col-sm-2">
                <input type="text"
                    class="form-control form-control-sm @error('city') is-invalid @enderror text-uppercase" name="city"
                    id="city" value="{{ old('city', $user->city) }}">
                @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <label for="country_id"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.country') :
            </label>
            <div class="col-sm-2">
                <x-select-country name="country_id" id="country_id" required="false"
                    :value="old('country_id', $user->country_id)" />
                @if ($errors->has('country_id'))
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <label for="zip_code" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.zip_code')
                :
            </label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm @error('zip_code') is-invalid @enderror"
                    name="zip_code" id="zip_code" value="{{ old('zip_code', $user->zip_code) }}">
                @if ($errors->has('zip_code'))
                <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                @endif
            </div>
        </div>

        {{-- phone number --}}
        <div class="row mb-3">
            <label for="phone_number"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.phone_number') :
            </label>

            <div class="col-sm-4">
                <input type="text"
                    class="form-control form-control-sm @error('phone_number') is-invalid @enderror text-uppercase"
                    name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                @if ($errors->has('phone_number'))
                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
            </div>
        </div>


        <div class="row mb-3">
            <label class="col-sm-2 col-form-label col-form-label-sm">@lang('user.status') :
                *</label>

            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="active_user" value="ACTIVE"
                        @if($user->isActive()) checked @endif>
                    <label class="form-check-label" for="active_user">Active user</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactive_user" value="INACTIVE" @if(!
                        $user->isActive()) checked @endif>
                    <label class="form-check-label" for="inactive_user">Inactive user</label>
                </div>

                @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>


        </div>

        <div class="row mb-3">
            <label for="comment" class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.comment')
                :</label>

            <div class="col-sm-10">
                <textarea class="form-control form-control-sm @error('comment') is-invalid @enderror" name="comment"
                    id="comment" rows="4" maxlength="500">{{ old('comment', $user->comment) }}</textarea>
                @if ($errors->has('comment'))
                <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="image_user"
                class="col-sm-2 col-form-label col-form-label-sm text-truncate">@lang('user.image_user')
                :</label>

            <div class="col-sm-10">
                @if ($user->getFirstMedia('images_user'))
                <img id="uploadPreview" style="width: 200px;" src="{{ $user->getFirstMedia('images_user')->getUrl() }}"
                    alt="image not found">
                @else

                <img id="uploadPreview" style="width: 142px;height:142px" src="{{ asset('img/image_avatar.png') }}"
                    alt="image not found">
                @endif


                <input id="image_user" type="file" name="image_user" onchange="PreviewImage();">
                @if ($errors->has('image_user'))
                <span class="text-danger">{{ $errors->first('image_user') }}</span>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2  d-grid gap-2 d-block">
                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check2" aria-hidden="true"></i>
                    @lang('user.save')</button>
                @if ($user->id)
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modalDeleteUser"><i class="bi bi-trash" aria-hidden="true"></i>
                    @lang('user.delete')</button>
                @endif
            </div>
        </div>

    </form>



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
                    <form class="form-inline" method="POST" action="/schools/{{ $school->id }}/users/{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i
                                class="bi bi-chevron-left" aria-hidden="true"></i> @lang('user.cancel_delete')</button>
                        <button type="submit" class="btn btn-sm btn-danger ml-3"><i class="bi bi-trash"
                                aria-hidden="true"></i>
                            @lang('user.confirm_delete', ['full_name' => $user->full_name])</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection

    @section('extra_js')
    <script>
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image_user").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };

        $(document).ready(function(){

            displayHiddeElement()

            $("#role_id").change(function(){
                displayHiddeElement();
            })

            function displayHiddeElement() {
                if ($("#role_id").val() == 'STUDENT'){
                    $(".student").show()
                    $(".civility").hide()
                } else {
                    $(".student").hide()
                    $(".civility").show()
                }
            }

        })

        
   
    </script>
    @endsection
