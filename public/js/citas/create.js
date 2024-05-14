var iRadio;
var div_horas = document.getElementById('div_horas');
var datepiker = document.getElementById('datepiker');

document.addEventListener("DOMContentLoaded", () => {



    let tratamieto = document.getElementById('tratamiento');
    let peluquero = document.getElementById('peluquero');
    let fecha = document.getElementById('fecha');
    var tiempo
    tratamieto.addEventListener("change", (event) => {
        div_horas.style.display = 'none';
        let horas = document.getElementById('horas');
        horas.innerHTML = "";
        let info = document.getElementById('info');
        info.innerHTML = "";
        const tratamiento = tratamieto.value;
        const aux = tratamiento.split('-') // [ 'free', 'code', 'camp' ]
        const tratamientoId = aux[0]
        tiempo = aux[1];
        // debugger;
        const url = `/tratamientos/${tratamientoId}/peluqueros`;
        $.getJSON(url, getPeluqueros);

    });

    peluquero.addEventListener("change", (event) => {
        // console.log(peluquero.value);
        const url = `/tratamientos/getDiasDispo?id_peluquero=${peluquero.value}`;
        $.getJSON(url, insertDatepiker);

        // cargarHorasDeshabilitadas();
        // cargarHoras();
    });

    // $(fecha).datepicker({
    //     autoclose: true,
    //     language: 'es'
    // }).on('changeDate', function (e) {
    //     $(this).datepicker('hide');
    //     div_horas.style.display = 'none';
    //     var info = document.getElementById('info');
    //     if (peluquero.value == '') {
    //         info.innerHTML = "<ul><li style='color:blue;'>Debes seleccionar un pelquero, GRACIAS</li></ul>";
    //         // alert('Debes seleccionar un pelquero')
    //     } else {
    //         // cargarHorasDeshabilitadas();
    //         cargarHoras();
    //     }
    // });


});
function insertDatepiker(dias) {
 // Obtener los días disponibles
const diasDisponibles = dias.map(dia => (dia.dia + 1) % 7);
console.log(diasDisponibles);
// Todos los días de la semana
const todosLosDias = [0, 1, 2, 3, 4, 5, 6];

// Filtrar los días deshabilitados
const diasDesabilitados = todosLosDias.filter(dia => !diasDisponibles.includes(dia));

// Convertir el array en una cadena separada por comas para usarlo en el atributo data-days-of-week-disabled
const diasDesabilitadosString = diasDesabilitados.join(', ');

console.log(diasDesabilitadosString);
    // Convertir el array en una cadena separada por comas para usarlo en el atributo data-days-of-week-disabled
    // const diasHabilitadosString = diashabilitados.join(', ');

    const datePickerHTML = `
        <label for='fecha'>Fecha</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
            </div>
            <input type="text" id="fecha" name="fecha_cita" class="form-control datepicker"
                value="${new Date().toISOString().slice(0, 10)}" data-date-format="yyyy-mm-dd"
                data-date-start-date="+1d"  data-date-end-date="+14d" required>
        </div>
    `;
    // const diashabilitados = dias.map(dia => dia.dia);
    // console.log(diashabilitados);

    // div_horas.style.display = 'none';
    // datepiker.innerHTML = '';
    // const datePickerHTML = `
    //     <label for='fecha'>Fecha</label>
    //     <div class="input-group ">
    //         <div class="input-group-prepend">
    //             <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
    //         </div>
    //         <input type="text" id="fecha" name="fecha_cita" class="form-control datepicker"
    //             value="AAAA-MM-DD" data-date-format="yyyy-mm-dd"
    //             data-date-start-date="+1d"  data-date-end-date="+14d"
    //             data-days-of-week-disabled="${diashabilitados}" required>
    //     </div>
    //    `;

    datepiker.innerHTML = datePickerHTML;
    $(datepiker.querySelector('.datepicker')).datepicker({
        autoclose: true,
        language: 'es',
        daysOfWeekDisabled:diasDesabilitadosString
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
        div_horas.style.display = 'none';
        var info = document.getElementById('info');
        if (peluquero.value == '') {
            info.innerHTML = "<ul><li style='color:blue;'>Debes seleccionar un pelquero, GRACIAS</li></ul>";
            // alert('Debes seleccionar un pelquero')
        } else {
            // cargarHorasDeshabilitadas();
            cargarHoras();
        }
    });
}
function getPeluqueros(peluqueros) {
    let selectpeluquero = document.getElementById('peluquero');
    let htmla = '';
    htmla += "<option value='' selected disabled>Seleccione un peluquero</option>"
    peluqueros.forEach(peluquero => {
        htmla += "<option value='" + peluquero.id + "'>" + peluquero.name + "</option>"

    });
    selectpeluquero.innerHTML = htmla;

};

function cargarHoras() {
    let fecha = document.getElementById('fecha');
    let tratamieto = document.getElementById('tratamiento');
    let tratamiento = tratamieto.value;
    let aux = tratamiento.split('-')
    tiempo = aux[1];

    info.innerHTML = "";

    const url = `/horarios/horas?fecha=${fecha.value}&id_peluquero=${peluquero.value}&tiempo=${tiempo}`;
    $.getJSON(url, mostarHoras);
}

// function cargarHorasDeshabilitadas()
// {
//         info.innerHTML = "";
//         const url = `/horarios/horasDeshabilitadas?fecha=${fecha.value}&id_peluquero=${peluquero.value}`;
//         let a = $.getJSON(url);
//         console.log(a);
// }


function mostarHoras(data) {

    let horas = document.getElementById('horas');
    horas.innerHTML = "";
    div_horas.style.display = '';
    if (!data.TM && !data.TT) {
        horas.innerHTML = "<ul><li style='color:red;'>No se encontraron citas disponibles para el día y médico seleccionados</li></ul>";
        return;
    }

    let htmlHoras = `
    <div class="row">`;
    iRadio = 0;
    if (data.TM.length != 0) {
        const intervalosM = data.TM;
        // console.log(intervalosM);
        // debugger;
        intervalosM.forEach(ele => {
            htmlHoras += getHTMLRadio(ele);
        });
    };

    if (data.TT.length != 0) {
        const intervalosT = data.TT;
        intervalosT.forEach(ele => {
            htmlHoras += getHTMLRadio(ele);
        });
    };
    htmlHoras += `
    </div">`;
    horas.innerHTML = htmlHoras;
}

function getHTMLRadio(intervalo) {
    const text = `${intervalo.inicio} - ${intervalo.fin}`;

    return `<div class="custom-control custom-radio mb-3 col-sm-6 col-md-6 col-lg-3 col-xl-2">
    <input name="hora_cita" class="custom-control-input" id="hora_cita_${iRadio}" type="radio" value="${text}" required>
    <label class="custom-control-label" for="hora_cita_${iRadio++}">${text}</label>
    </div>`;
}
