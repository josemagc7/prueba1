@extends('layouts.panel')

@section('content')



<div class="card shadow">

  <div class="card-header border-0">
    <div class="row align-items-center">

      <div class="col">
        <h3 class="mb-0">Editar cliente</h3>
      </div>

      <div class="col text-right">
        <a href="{{ url('clientes')}}" class="btn btn-sm btn-default">
          Volver
        </a>
      </div>

    </div>
  </div>

  <div class="table-responsive">
    <!-- Crear nuevo cliente -->
    <div class="card-body">

<!-- MOSTRAMOS ERRORES PROCEDENTE DEL SERVER -->
      @if ($errors->any())
        <ul>
          @foreach($errors->all() as $error)
            <li style="color: red">{{$error}}</li>
          @endforeach
        </ul>
      @endif


       <form action="{{ url('clientes/'.$cliente->id) }}" method="post">
        @csrf
        @method('PUT')
          <div class="form-group">
            <label for='name'> Nombre</label>
            <input type="text" name="name" class="form-control" placeholder="Ej: José Manuel" value="{{ old('name', $cliente->name) }}" autofocus>
          </div>
          <div class="form-group">
            <label for='email'>E-mail</label>
            <input type="text" name="email" class="form-control" placeholder="Ej: josemanuelgarcia@gmail.com" value="{{ old('email',$cliente->email) }}">
          </div>
          <div class="form-group">
            <label for='dni'>DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="Ej: 12345678Y" value="{{ old('dni',$cliente->dni) }}">
          </div>
          <div class="form-group">
            <label for='direccion'>Municipio
            </label>
            <input type="text" name="direccion" class="form-control" placeholder="Ej: Aznalcóllar" value="{{ old('direccion',$cliente->direccion) }}">
          </div>
          <div class="form-group">
            <label for='telefono'>Telf.
            </label>
            <input type="text" name="telefono" class="form-control" placeholder="Ej: 696545884" value="{{ old('telefono',$cliente->telefono) }}">
          </div>
          <div class="form-group">
            <label for='password'>Contraseña
            </label>
            <input type="text" name="password" class="form-control" value="">
            <p>Intruzca contraseña unicamente si deseas modificarla.</p>
          </div>




         <button type="submit" class="btn btn-sm btn-primary">Editar cliente</button>
       </form>
    </div>
  </div>

</div>


@endsection
