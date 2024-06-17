@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection




@section('content')



<div class="card shadow">

  <div class="card-header border-0">
    <div class="row align-items-center">

      <div class="col">
        <h3 class="mb-0">Nuevo peluquero</h3>
      </div>

      <div class="col text-right">
        <a href="{{ url('peluqueros')}}" class="btn btn-sm btn-default">
          Volver
        </a>
      </div>

    </div>
  </div>

  <div class="table-responsive">
    <!-- Crear nuevo peluquero -->
    <div class="card-body">

<!-- MOSTRAMOS ERRORES PROCEDENTE DEL SERVER -->
      @if ($errors->any())
        <ul>
          @foreach($errors->all() as $error)
            <li style="color: red">{{$error}}</li>
          @endforeach
        </ul>
      @endif


       <form action="{{ url('peluqueros') }}" method="post">
        @csrf
          <div class="form-group">
            <label for='name'> Nombre</label>
            <input type="text" name="name" class="form-control" placeholder="Ej: José Manuel" value="{{ old('name') }}" autofocus>
          </div>
          <div class="form-group">
            <label for='email'>E-mail</label>
            <input type="text" name="email" class="form-control" placeholder="Ej: josemanuelgarcia@gmail.com" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for='dni'>DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="Ej: 12345678Y" value="{{ old('dni') }}">
          </div>
          <div class="form-group">
            <label for='direccion'>Municipio
            </label>
            <input type="text" name="direccion" class="form-control" placeholder="Ej: Aznalcóllar" value="{{ old('direccion') }}">
          </div>
          <div class="form-group">
            <label for='telefono'>Telf.
            </label>
            <input type="text" name="telefono" class="form-control" placeholder="Ej: 696545884" value="{{ old('telefono') }}" minlength="9" maxlength="9">
          </div>
          <div class="form-group">
            <label for='password'>Contraseña
            </label>
            <input type="text" name="password" class="form-control" value="{{str_random(8)}}">
          </div>



          <div class="form-group">
            <label for="tratamientos">Tratamientos</label>
            <select name="tratamientos[]" id="tratamientos" class="form-control selectpicker" multiple data-style="btn-outline-secondary" title="Selecione tratamiento">
                @foreach ($tratamientos as $tratamiento )
                    <option value="{{$tratamiento->id}}">{{$tratamiento->tratamiento}} ({{$tratamiento->descripcion}})</option>
                @endforeach
            </select>
          </div>
          {{-- <div class="form-group" style="display: none">
            <input type="text" name="rol" class="form-control" value="peluquero">
          </div> --}}


     <!--      <div class="form-group">
            <label for='descripcion'>Descripcion</label>
            <input type="" name=""> type="text" name="descripcion" class="form-control">
          </div> -->
         <button type="submit" class="btn btn-sm btn-primary">Añadir peluquero</button>
       </form>
    </div>
  </div>

</div>


@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
