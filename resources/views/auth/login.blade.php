@extends('layouts.layout_without_menu_sidebar')


@section('content')


<div class="col-md-4 offset-md-4 mt-5">


    @include('errors.session-values')

    <form action="/login" method="POST">
        @csrf
        <h1 class="h3 mb-3 text-center">Connectez-vous</h1>

        <input type="email" id="email" name="email" class="form-control" placeholder="email" value="{{ old('email') }}"
            required>
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif


        <input type="password" id="password" name="password" class="form-control" placeholder="Mot passe" required>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember_me">
            <label class="form-check-label" for="remember_me">Rester connecté sur cet ordinateur</label>
        </div>

        <div class="d-grid gap-2 mt-3">
            <button class="btn btn-success" type="submit" id="submit"><i
                    class="fa fa-sign-in-alt">&nbsp;</i>Connexion</button>
        </div>

    </form>

    <a href="password-lost">Mot de passe perdu ?</a><br />

</div>


@endsection