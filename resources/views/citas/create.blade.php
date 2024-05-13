@extends('layouts.panel')

@section('content')

    <style>
        .datepicker table tr td.disabled {
            color: red;

        }

        .datepicker table tr td:not(.disabled) {
            color: green;
        }
    </style>

    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="mb-0">Nueva cita</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ url('vercitas') }}" class="btn btn-sm btn-default">
                        Ir a mis citas
                    </a>
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <!-- Crear nuevo cleinte -->
            <div class="card-body">

                <div class="card-body" id="info">
                    @if (session('mensaje'))
                        <div class="card-body" id="ocultar">
                            <ul>
                                <li style="color: green">{{ session('mensaje') }}</li>
                            </ul>
                        </div>
                    @endif
                    <!-- MOSTRAMOS ERRORES PROCEDENTE DEL SERVER -->
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <form action="{{ url('citas') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for='tratamiento'> Tratamiento</label>
                        <select name="tratamiento_id" id="tratamiento" class="form-control" required>
                            <option value="" selected disabled>Selecione un tratamiento</option>
                            @foreach ($tratamientos as $tratamiento)
                                <option value="{{ "{$tratamiento->id}-{$tratamiento->tiempo}" }}">
                                    {{ "$tratamiento->tratamiento ($tratamiento->tiempo Minutos)" }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for='peluquero' required>Peluquero</label>
                        <select name="peluquero_id" id="peluquero" class="form-control">
                        </select>
                    </div>

                    <div class="form-group" id="datepiker">
                        {{-- <label for='fecha'>Fecha</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input type="text" id="fecha" name="fecha_cita" class="form-control datepicker"
                                value="{{ date('Y-m-d', strtotime(date(now()). ' +1 days')) }}" data-date-format="yyyy-mm-dd"
                                data-date-start-date="+1d"  data-date-end-date="+21d" required>
                        </div> --}}
                    </div>

                    <div class="form-group" id="div_horas" style="display: none">
                        <label for='hora'>Hora</label>
                        <div class="card-body pt-0 pb-0 pr-0" id="horas">

                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for='telefono'>Teléfono
                        </label>
                        <input type="text" name="telefono" class="form-control" placeholder="Ej: 696545884"
                            value="{{ old('telefono') }}" required>
                    </div> --}}
                    <div class="form-group">
                        <label for='descripcion'>Teléfono</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="Deje su telefono de contacto, Gracias" value="{{ old('descripcion') }}"
                            maxlength="9" required>
                        </input>
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
                    <button type="submit" class="btn btn-sm btn-primary">Coger cita</button>
                </form>
            </div>
        </div>

    </div>


@endsection

@section('scripts')
    {{-- <script src="{{ asset('vendor\bootstrap-datepicker\dist\js\bootstrap-datepicker.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script>




    <script src="{{ asset('/js/citas/create.js') }}"></script>
@endsection
