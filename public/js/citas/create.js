document.addEventListener("DOMContentLoaded",() => {



    let tratamieto = document.getElementById('tratamiento');

    tratamieto.addEventListener("change", (event) => {
        const tratamientoId = tratamieto.value;
        const url = `/tratamientos/${tratamientoId}/peluqueros`;
        $.getJSON(url, getPeluqueros);

    });
});

function getPeluqueros(peluqueros) {
    let selectpeluquero = document.getElementById('peluquero');
    let htmla='';

    peluqueros.forEach(peluquero => {
        htmla += "<option value='"+peluquero.id+"'>"+peluquero.name+"</option>"

    });
    selectpeluquero.innerHTML=htmla;

};
