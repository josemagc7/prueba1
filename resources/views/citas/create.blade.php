@extends('layouts.panel')

@section('content')



    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="mb-0">Nueva cita</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ url('clientes') }}" class="btn btn-sm btn-default">
                        Volver
                    </a>
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <!-- Crear nuevo cleinte -->
            <div class="card-body">

                <!-- MOSTRAMOS ERRORES PROCEDENTE DEL SERVER -->
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif


                <form action="{{ url('clientes') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for='tratamiento'> Tratamiento</label>
                        <select name="tratamiento_id" id="tratamiento" class="form-control" required>
                            <option value="" selected disabled>Selecione un tratamiento</option>
                            @foreach ($tratamientos as $tratamiento)
                                <option value="{{ $tratamiento->id }}">{{ $tratamiento->tratamiento }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for='peluquero'>Peluquero</label>
                        <select name="peluquero_id" id="peluquero" class="form-control">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for='fecha'>Fecha</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input type="text" name="fecha" class="form-control datepicker" value="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}" data-date-end-date="+21d">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for='hora'>Hora</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>

                    {{-- <div class="form-group">
            <label for='telefono'>Telf.
            </label>
            <input type="text" name="telefono" class="form-control" placeholder="Ej: 696545884" value="{{ old('telefono') }}">
          </div>
          <div class="form-group">
            <label for='password'>Contraseña
            </label>
            <input type="text" name="password" class="form-control" value="{{str_random(8)}}">
          </div> --}}


                    <!--      <div class="form-group">
                        <label for='descripcion'>Descripcion</label>
                        <input type="" name=""> type="text" name="descripcion" class="form-control">
                      </div> -->
                    <button type="submit" class="btn btn-sm btn-primary">Añadir cliente</button>
                </form>
            </div>
        </div>

    </div>


@endsection

@section('scripts')
    <script src="{{ asset('vendor\bootstrap-datepicker\dist\js\bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/citas/create.js') }}"></script>
@endsection
