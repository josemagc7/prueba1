@extends('layouts.panel')

@section('content')
    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="mb-0">Citas</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ url('citas/create') }}" class="btn btn-sm btn-success">
                        Nueva Cita
                    </a>
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

        <div class="table-responsive">
            <!-- Tratamiento -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Peluquero</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Tratamiento</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $cita)
                    @php
                    $id=$cita['id'];
                    $fechacita=date('Y-m-d',strtotime($cita['fecha_cita']));
                    $dosDiasAntes=date('Y-m-d',strtotime($cita['fecha_cita']. ' -2 days'));
                    $hoy=date('Y-m-d',strtotime(date(now())));
                    // dd($dosDiasAntes);
                    $color='style="color: green"';
                    $disabled='';
                    if ($hoy >= $dosDiasAntes) {
                        $disabled='disabled';
                    };
                    if ($hoy >= $fechacita) {
                        $color='style="color: rgb(250, 185, 185)"';
                    };
                    if ($hoy == $fechacita) {
                        $color='style="color: rgb(200, 226, 53)"';
                    };
                @endphp
                    <tr>
                        <th scope="row" @php echo $color @endphp style="color: rgb(200, 226, 53)">
                            {{ $cita['peluquero'] }}
                        </th>
                        <td @php echo $color @endphp>
                            {{ $cita['fecha_cita'] }}
                        </td>
                        <td @php echo $color @endphp>
                            {{ $cita['hora_cita'] }}
                        </td>
                        <td @php echo $color @endphp>
                            {{ $cita['tratamiento'] }}
                        </td>
                        <td @php echo $color @endphp>
                            {{ $cita['precio'] }}€
                        </td>
                        <td @php echo $color @endphp>
                            {{ $cita['tiempo'] }} Minutos
                        </td>

                        <td>
                            {{-- @php
                                dd('citas/'.$cita["id"]);
                            @endphp --}}
                            <form action="{{ url('/citas/'. $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('¿Estás seguro de cancelar la cita?')" @php echo $disabled @endphp>Cancelar Cita
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>

    </div>
@endsection
