@extends('layouts.panel')

@section('content')
    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="mb-0">Tratamientos</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ url('tratamientos/create') }}" class="btn btn-sm btn-success">
                        Nuevo Tratamiento
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tratamientos as $tratamiento)
                        <tr>
                            <th scope="row">
                                {{ $tratamiento->tratamiento }}
                            </th>
                            <td>
                                {{ $tratamiento->precio }} €
                            </td>
                            <td>
                                {{ $tratamiento->tiempo }} Minutos
                            </td>
                            <td>
                                Tratamiento para {{ $tratamiento->descripcion }}
                            </td>
                            <td>

                                <form action="{{ url('/tratamientos/' . $tratamiento->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('/tratamientos/' . $tratamiento->id . '/edit') }}"
                                        class="btn btn-sm btn-primary">Editar</a>

                                    @if ($tratamiento->activo == 1)
                                        <button class="btn btn-sm btn-danger" type="submit"
                                            onclick="return confirm('¿Estas seguro de desactivar al tratamiento?')">Desactivar</button>
                                    @else
                                        <button class="btn btn-sm btn-success" type="submit"
                                            onclick="return confirm('¿Estas seguro de activar al tratamiento?')">Activar</button>
                                    @endif

                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>
@endsection
