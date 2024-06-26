@extends('layouts.panel')

@section('content')



<div class="card shadow">

  <div class="card-header border-0">
    <div class="row align-items-center">

      <div class="col">
        <h3 class="mb-0">Editar tratamiento</h3>
      </div>

      <div class="col text-right">
        <a href="{{ url('tratamientos')}}" class="btn btn-sm btn-default">
          Volver
        </a>
      </div>

    </div>
  </div>

  <div class="table-responsive">
    <!-- Crear nuevo Tratamiento -->
    <div class="card-body">

<!-- MOSTRAMOS ERRORES PROCEDENTE DEL SERVER -->
      @if ($errors->any())
        <ul>
          @foreach($errors->all() as $error)
            <li style="color: red">{{$error}}</li>
          @endforeach
        </ul>
      @endif


       <form action="{{ url('/tratamientos/'.$tratamiento->id) }}" method="post">
        @csrf
        @method('PUT')
          <div class="form-group">
            <label for='tratamiento'> Nombre de tratamiento</label>
            <input type="text" name="tratamiento" class="form-control" placeholder="Ej: Corte de cabello" value="{{ old('tratamiento' , $tratamiento->tratamiento) }}" autofocus>
          </div>
          <div class="form-group">
            <label for='precio'>Precio</label>
            <input type="text" name="precio" class="form-control" placeholder="Ej: 10.00" value="{{ old('precio' , $tratamiento->precio) }}">
          </div>

          <div class="form-group">
            <label for="tiempo">Tiempo del tratamiento</label>
            <select class="form-control" name="tiempo" required>
              <option value =''disabled selected>Seleccione una opción</option>
              <option value ='15'>15 Minutos</option>
              <option value ='30'>30 Minutos</option>
              <option value ='45'>45 Minutos</option>
              <option value ='60'>1 Hora</option>
              <option value ='75'>1 Hora y 15 Minutos</option>
              <option value ='90'>1 Hora y 30 Minutos</option>
            </select>
          </div>

          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <select class="form-control" name="descripcion" required>
              <option value =''disabled selected>Seleccione una opción</option>
              <option value ='Mujer'>Mujer</option>
              <option value ='Hombre'>Hombre</option>
              <option value ='Hombre/Mujer'>Hombre/Mujer</option>
            </select>
          </div>
     <!--      <div class="form-group">
            <label for='descripcion'>Descripcion</label>
            <input type="" name=""> type="text" name="descripcion" class="form-control">
          </div> -->
         <button type="submit" class="btn btn-sm btn-primary">Guardar tratamiento</button>
       </form>
    </div>
  </div>

</div>


@endsection
