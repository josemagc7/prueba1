@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Frecuencia de citas</h3>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form id="buscar-form">
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="selector-frecuencia">Frecuencia</label>
                        <select id="selector-frecuencia" class="form-control">
                            <option value="diaria" selected>Diario</option>
                            <option value="semanal">Semanal</option>
                            <option value="mensual">Mensual</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="fecha-inicio">Fecha de Inicio</label>
                        <input type="date" id="fecha-inicio" class="form-control">
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="fecha-fin">Fecha de Fin</label>
                        <input type="date" id="fecha-fin" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="contenedor">
            <canvas id="grafica-linea"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectorFrecuencia = document.getElementById('selector-frecuencia');
            const inputFechaInicio = document.getElementById('fecha-inicio');
            const inputFechaFin = document.getElementById('fecha-fin');
            const formularioBuscar = document.getElementById('buscar-form');

            selectorFrecuencia.addEventListener('change', function() {
                const frecuencia = selectorFrecuencia.value;
                actualizarTipos(frecuencia);
            });

            function actualizarTipos(frecuencia) {
                if (frecuencia === 'diaria') {
                    inputFechaInicio.type = 'date';
                    inputFechaFin.type = 'date';
                } else if (frecuencia === 'semanal') {
                    inputFechaInicio.type = 'week';
                    inputFechaFin.type = 'week';
                } else if (frecuencia === 'mensual') {
                    inputFechaInicio.type = 'month';
                    inputFechaFin.type = 'month';
                }
            }

            formularioBuscar.addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario

                const frecuencia = selectorFrecuencia.value;
                const fechaInicio = inputFechaInicio.value;
                const fechaFin = inputFechaFin.value;

                if (fechaInicio && fechaFin) {
                    // mostrarGrafica()
                    const url =
                        `/chartsCitasFecha?frecuencia=${frecuencia}&fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
                    $.getJSON(url, mostrarGrafica);
                } else {
                    console.log('Por favor, seleccione ambas fechas.');
                }
            });

            // Inicializar con la frecuencia diaria
            actualizarTipos(selectorFrecuencia.value);
        });

        function mostrarGrafica(datos) {
    console.log(datos);
    const ctx = document.getElementById('grafica-linea').getContext('2d');

    // Destruir la gráfica anterior si existe
    if (window.myChart !== undefined) {
        window.myChart.destroy();
    }

    // Crear una nueva instancia de Chart
    window.myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: datos.labels,
            datasets: [{
                    label: 'Citas Totales',
                    data: datos.total,
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Citas Completadas',
                    data: datos.completadas,
                    borderColor: 'green',
                    borderWidth: 5,
                    fill: false
                },
                {
                    label: 'Citas Canceladas',
                    data: datos.canceladas,
                    borderColor: 'red',
                    borderWidth: 5,
                    fill: false
                }
            ]
        }
    });
}
    </script>
@endsection
