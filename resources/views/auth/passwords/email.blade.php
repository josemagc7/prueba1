@extends('layouts.form')

@section('titulo', 'Cambiar Contraseña')
@section('subtitulo', 'La contraseña podrá ser modificada a traves de tu correo electronico.')


@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            {{-- <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enviar nueva contraseña al correo') }}
                        </button>
                    </div>
                </div> --}}

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>

                                    <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 text-center"> <!-- Alinea el contenido al centro -->
                                    <button type="submit" class="btn btn-primary">{{ __('Enviar Mail') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{ route('login') }}" class="text-light"><small>Inciar sesión</small></a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-light">
                            <small>Crear nueva cuenta</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
