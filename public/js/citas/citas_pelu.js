// var iRadio;
// var div_horas = document.getElementById('div_horas');

document.addEventListener("DOMContentLoaded", () => {



    let fecha = document.getElementById('fecha');
    let dia_anterior = document.getElementById('dia_anterior');
    let dia_siguiente = document.getElementById('dia_siguiente');

    dia_anterior.addEventListener("click", (event) => {
        let fechaInicial = new Date(fecha.textContent);
        fechaInicial.setDate(fechaInicial.getDate() - 1);
        let nuevaFecha = fechaInicial.toISOString().slice(0, 10);

        const url = `/citasPeluquero?fecha=${nuevaFecha}`;
        $.getJSON(url, citasPeluquero);
        console.log(nuevaFecha);

    });

    dia_siguiente.addEventListener("click", (event) => {
        let fechaInicial = new Date(fecha.textContent);
        fechaInicial.setDate(fechaInicial.getDate() + 1);
        let nuevaFecha = fechaInicial.toISOString().slice(0, 10);

        const url = `/citasPeluquero?fecha=${nuevaFecha}`;
        $.getJSON(url, citasPeluquero);
        console.log(nuevaFecha);

    });





});

function citaCompletada(id_cita) {


    const url = `/citaCompletada?id_cita=${id_cita}`;
    $.getJSON(url, citasPeluquero);
}
function citasPeluquero(datos) {
    let fecha = document.getElementById('fecha');
    let tabla = document.getElementById('tbody_tabla');
    let table_resp = document.getElementById('table_resp');
    let ulElemento = document.getElementById("ul_a_borrar");
    console.log(ulElemento);
    if (ulElemento != null) {
        ulElemento.innerHTML = "";
    }
    // table_resp
    let tablaHTML = '';
    tabla.innerHTML = tablaHTML;
    // table_resp.innerHTML = '';
    fecha.innerHTML = datos['fecha'];
    console.log();
    if (datos['data'].length === 0) {
        tablaHTML += '<ul id="ul_a_borrar">';
        tablaHTML += '<li style="color: rgb(155, 39, 39)">SIN CITA PARA EL DIA SELECCIONADO.</li>';
        tablaHTML += '</ul>';
        tablaHTML += '<table class="table align-items-center table-flush">';
        tablaHTML += '<thead class="thead-light">';
        tablaHTML += '<tr>';
        tablaHTML += '<th scope="col">Cliente</th>';
        tablaHTML += '<th scope="col">Fecha</th>';
        tablaHTML += '<th scope="col">Hora</th>';
        tablaHTML += '<th scope="col">Tratamiento</th>';
        tablaHTML += '<th scope="col">Precio</th>';
        tablaHTML += '<th scope="col">Tiempo</th>';
        tablaHTML += '<th scope="col">Descripción</th>';
        tablaHTML += '<th scope="col">Asistencia</th>';
        tablaHTML += '</tr>';
        tablaHTML += '</thead>';
        tablaHTML += '<tbody id="tbody_tabla">';
        tablaHTML += '</tbody>';
        tablaHTML += '</table>';
        table_resp.innerHTML = tablaHTML;

    } else {
        let fechahoy = new Date('2024-5-7');
        let año = fechahoy.getFullYear();
        let mes = ('0' + (fechahoy.getMonth() + 1)).slice(-2);
        let dia = ('0' + fechahoy.getDate()).slice(-2);
        let fechaFormateada = año + '-' + mes + '-' + dia;
        // let disabled = "disabled"

        datos['data'].forEach(function (cita) {
            var aux = '<button class="btn btn-sm btn-success" disabled>OK</button>'
            console.log(cita.fecha_cita);
            console.log(fechaFormateada);

            if (cita.fecha_cita == fechaFormateada && cita.asistencia == 0) {
                aux = '<a onclick="citaCompletada(' + cita.id + ')" class="btn btn-sm btn-success" style="color:white;" disabled>OK</a>'
            }

            tablaHTML += '<tr>';
            tablaHTML += '<td>' + cita.cliente + '</td>';
            tablaHTML += '<td>' + cita.fecha_cita + '</td>';
            tablaHTML += '<td>' + cita.hora_cita + '</td>';
            tablaHTML += '<td>' + cita.tratamiento + '</td>';
            tablaHTML += '<td>' + cita.precio + '€</td>';
            tablaHTML += '<td>' + cita.tiempo + ' Minutos</td>';
            tablaHTML += '<td>' + cita.descripcion + '</td>';
            tablaHTML += '<td>';
            // tablaHTML += '<form action="/cancelar_cita/' + cita.id + '" method="POST">';
            // tablaHTML += '<input type="hidden" name="_token" value="{{ csrf_token() }}">'; // Agregar el token CSRF
            // tablaHTML += '<input type="hidden" name="_method" value="DELETE">'; // Agregar el método DELETE
            // tablaHTML += '<button class="btn btn-sm btn-success" type="submit" onclick="return confirm(\'¿Estás seguro de cancelar la cita?\')" disabled>OK</button>';
            // tablaHTML += '</form>';
            // href="/citas/{'+ cita.id +'}/edit"
            tablaHTML += aux;
            tablaHTML += '</td>';
            tablaHTML += '</tr>';
        });

        // tablaHTML += '</tbody>';
        // tablaHTML += '</table>';
        tabla.innerHTML = tablaHTML;
    }

}
