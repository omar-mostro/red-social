@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                @include('partials.validation-error')
                <div class="card border-0 bg-light px-4 py-2">
                    <div class="card-header">Registro</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">Username: </label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control border-0 @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name"
                                       class="col-md-4 col-form-label text-md-right">Nombre: </label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control border-0 @error('first_name') is-invalid @enderror"
                                           name="first_name"
                                           value="{{ old('first_name') }}">

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                       class="col-md-4 col-form-label text-md-right">Apellido: </label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                           class="form-control border-0 @error('last_name') is-invalid @enderror"
                                           name="last_name"
                                           value="{{ old('last_name') }}">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">Email: </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control border-0 @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">Contraseña: </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control border-0 @error('password') is-invalid @enderror"
                                           name="password"
                                           value="{{ old('password') }}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation"
                                       class="col-md-4 col-form-label text-md-right">Confirmar Contraseña: </label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password"
                                           class="form-control border-0 @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation"
                                           value="{{ old('password_confirmation') }}">

                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button dusk="register-btn" type="submit" id="login-btn"
                                            class="btn btn-primary btn-block">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
