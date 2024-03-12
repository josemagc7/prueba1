@extends('layouts.panel')

@section('content')
    <form action="{{ url('/horario') }}" method="post">
        @csrf
        <div class="card shadow">

            <div class="card-header border-0">
                <div class="row align-items-center">

                    <div class="col">
                        <h3 class="mb-0">Gestionar horario</h3>
                    </div>

                    <div class="col text-right">
                        <button type="submit" class="btn btn-sm btn-success">
                            Guardar cambios
                        </button>
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
                            <th scope="col">Día</th>
                            <th scope="col">Activo</th>
                            <th scope="col">T. Mañana</th>
                            <th scope="col">T. Tarde</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dias as $key => $dia)
                            <tr>
                                <th scope="col">{{ $dia }}</th>

                                <td>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name='activo[]' value='{{$key}}'>
                                        <span class="custom-toggle-slider rounded-circle" ></span>
                                    </label>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <select name="tm_inicio[]" id="" class="form-control">
                                                <option value="00:00" >Desde:</option>

                                                @for ($i = 7; $i <= 15; $i++)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                    @if ($i != 15)
                                                        <option value="{{ $i }}:30">{{ $i }}:30
                                                        </option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="tm_fin[]" id="" class="form-control">
                                                <option value="00:00" >Hasta:</option>
                                                @for ($i = 7; $i <= 15; $i++)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                    @if ($i != 15)
                                                        <option value="{{ $i }}:30">{{ $i }}:30
                                                        </option>
                                                    @endif
                                                @endfor
                                            </select>

                                        </div>
                                    </div>

                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <select name="tt_inicio[]" id="" class="form-control">
                                                <option value="00:00" >Desde:</option>

                                                @for ($i = 15; $i <= 22; $i++)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                    @if ($i != 22)
                                                        <option value="{{ $i }}:30">{{ $i }}:30
                                                        </option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="tt_fin[]" id="" class="form-control">
                                                <option value="00:00" >Hasta:</option>
                                                @for ($i = 15; $i <= 22; $i++)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                    @if ($i != 22)
                                                        <option value="{{ $i }}:30">{{ $i }}:30
                                                        </option>
                                                    @endif
                                                @endfor
                                            </select>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </form>
@endsection
