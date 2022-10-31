@extends('layouts.layout_without_menu_sidebar')


@section('content')


<div class="col-md-4 offset-md-4 mt-5">


    @if(Session::has('error'))

    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ Session::get('error') }}
    </div>

    @php
    Session::forget('error');
    @endphp
    @endif

    <form action="/login" method="POST">
        @csrf
        <h1 class="h3 mb-3 text-center">@lang('auth.title')</h1>

        <input type="email" id="email" name="email" class="form-control" placeholder="@lang('auth.email')"
            value="{{ old('email') }}" required>
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif


        <input type="password" id="password" name="password" class="form-control" placeholder="@lang('auth.password')"
            required>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember_me">
            <label class="form-check-label" for="remember_me">@lang('auth.stay_connected')</label>
        </div>

        <div class="d-grid gap-2 mt-3">
            <button class="btn btn-success" type="submit" id="submit">@lang('auth.login')</button>
        </div>

    </form>

    <a href="password-lost">@lang('auth.password_lost')</a><br><br>

    <p>
        Admin : {{ App\Models\User::where('role_id', 'ADMIN')->first()->email }}
    </p>
    <p>
        Director : {{ App\Models\User::where('role_id', 'DIRECTOR')->where('status', 'ACTIVE')->first()->email }}<br>
        Parent : {{ App\Models\User::where('role_id', 'PARENT')->where('status', 'ACTIVE')->first()->email }}<br>
        Teacher : {{ App\Models\User::where('role_id', 'TEACHER')->where('status', 'ACTIVE')->first()->email }}<br>
        Student : {{ App\Models\User::where('role_id', 'STUDENT')->where('status', 'ACTIVE')->first()->email }}<br>
    </p>

</div>

@endsection
