@extends('layouts.panel')

@section('content')
    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="mb-0">Peluqueros</h3>
                </div>

                <div class="col text-right">
                    <a href="{{ url('peluqueros/create') }}" class="btn btn-sm btn-success">
                        Nuevo peluquero
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
            <!-- Peluquero -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peluqueros as $peluquero)
                        <tr>
                            <th scope="row">
                                {{ $peluquero->name }}
                            </th>
                            <td>
                                {{ $peluquero->email }}
                            </td>
                            <td>
                               {{ $peluquero->telefono }}
                            </td>
                            <td>

                                <form action="{{ url('/peluqueros/' . $peluquero->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('/peluqueros/' . $peluquero->id . '/edit') }}"
                                        class="btn btn-sm btn-primary">Editar</a>

                                    <button class="btn btn-sm btn-danger" type="submit"
                                        onclick="return confirm('¿Estas seguro de eliminar al peluquero?')">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $peluqueros->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
