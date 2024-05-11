@extends('layouts.panel')

@section('content')
    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <button id="dia_anterior" class="btn btn-sm btn-danger">Dia Anterior</button>
                </div>

                <div class="col text-center">

                    <h4 id="fecha">{{ $fecha }}</h4>
                    {{-- {{$fecha}} --}}

                </div>

                <div class="col text-right">
                    <button id="dia_siguiente" class="btn btn-sm btn-success">Dia Siguiente</button>


                </div>

            </div>
        </div>


        @if (session('mensaje'))
            <div class="card-body">
                <ul>
                    <li style="color: green">{{ session('mensaje') }}</li>
                </ul>
            </div>
        @endif

        <div class="table-responsive" id="table_resp">
            <!-- Tratamiento -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Tratamiento</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Asistencia</th>
                    </tr>
                </thead>
                <tbody id="tbody_tabla">
                    @if ($data == [])
                        <ul id="ul_a_borrar">
                            <li style="color: rgb(163, 0, 0)">SIN CITA PARA EL DIA SELECCIONADO.</li>
                        </ul>
                    @endif
                    @foreach ($data as $cita)
                        <tr>
                            <th scope="row">
                                {{ $cita['cliente'] }}
                            </th>
                            <td>
                                {{ $cita['fecha_cita'] }}
                            </td>
                            <td>
                                {{ $cita['hora_cita'] }}
                            </td>
                            <td>
                                {{ $cita['tratamiento'] }}
                            </td>
                            <td>
                                {{ $cita['precio'] }}€
                            </td>
                            <td>
                                {{ $cita['tiempo'] }} Minutos
                            </td>
                            <td>
                                {{ $cita['descripcion'] }}
                            </td>

                            <td>
                                @if ($cita['asistencia'] == 0)
                                    <a onclick="citaCompletada({{ $cita['id'] }})" class="btn btn-sm btn-success" style="color: white">OK</a>
                                @else
                                    <button class="btn btn-sm btn-success" disabled>OK</button>
                                @endif

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ secure_asset('/js/citas/citas_pelu.js') }}"></script>
@endsection
