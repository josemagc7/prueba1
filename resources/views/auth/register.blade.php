@extends('layouts.form')

@section('titulo','Registro')
@section('subtitulo','Introduzca datos para registrarte.')


@section('content')
<div class="container mt--8 pb-5">
      <!-- Table -->
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">


            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first()}}
                </div>

                @endif


          <form role="form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
              <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" min="3" autofocus>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
              </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                  </div>
                  <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ old('dni') }}" required minlength="9" maxlength="9">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-building"></i></span>
                  </div>
                  <input type="text" name="direccion" class="form-control" placeholder="Municipio" value="{{ old('direccion') }}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                  </div>
                  <input type="text" name="telefono" class="form-control" placeholder="Telefono" value="{{ old('telefono') }}" required minlength="9" maxlength="9">
                </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Contraseña" type="password" name="password" required autocomplete="new-password">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Confirmar contraseña" type="password" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>


            <div class="text-center">
              <button type="submit" class="btn btn-primary mt-4">Crear cuenta</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
