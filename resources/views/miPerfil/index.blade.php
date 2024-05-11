@extends('layouts.panel')

@section('content')
    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="mb-0">Mi Perfil</h3>
                </div>

                {{-- <div class="col text-right">
                    <a href="{{ url('clientes/create') }}" class="btn btn-sm btn-success">
                        Nuevo cliente
                    </a>
                </div> --}}

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
            <!-- cliente -->
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
                    @foreach ($clientes as $cliente)
                        <tr>
                            <th scope="row">
                                {{ $cliente->name }}
                            </th>
                            <td>
                                {{ $cliente->email }}
                            </td>
                            <td>
                               {{ $cliente->telefono }}
                            </td>
                            <td>

                                <form action="{{ url('/miPerfil/' . $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('/miPerfil/' . $cliente->id . '/edit') }}"
                                        class="btn btn-sm btn-primary">Editar</a>
                                    @if (auth()->user()->rol == 'cliente')
                                    <button class="btn btn-sm btn-danger" type="submit"
                                        onclick="return confirm('¿Estas seguro de desactivar la cuenta?')">Desactivar</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        {{-- <div class="card-body">
            {{ $clientes->links('pagination::bootstrap-5') }}
        </div> --}}
    </div>
@endsection
