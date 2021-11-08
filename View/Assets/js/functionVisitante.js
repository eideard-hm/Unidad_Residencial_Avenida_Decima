let tableVisit;
document.addEventListener('DOMContentLoaded', function () {
    tableVisit = $('#example').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info'
            },
        ],
        "ajax": {
            "url": "" + base_url + "Visitante/getVisit",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idVisitante" },
            { "data": "nombreVisitante" },
            { "data": "apellidoVisitante" },
            { "data": "tipoDocumentoVisitante" },
            { "data": "numeroDocumentoVisitante" },
            { "data": "numTorreDirige" },
            { "data": "numBloqueDirige" },
            { "data": "numApartamentoDirige" },
            { "data": "fechaIngresoVisitante" },
            { "data": "horaIngresoVisitante" },
            { "data": "fechaSalidaVisitante" },
            { "data": "horaSalidaVisitante" },
            { "data": "estadoVisitante" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });

    //NUEVO VISITANTE
    let formVisit = document.querySelector("#formVisitante");
    formVisit.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo
        let strNombres = document.querySelector("#nombreVisitante").value;
        let strApellidos = document.querySelector("#apellidosVisitante").value;
        let strTipoDoc = document.querySelector("#tipoDocVisitante").value;
        let intNumDoc = document.querySelector("#numeroDocVisitante").value;
        let intTorre = document.querySelector("#numTorreVisitante").value;
        let intInte = document.querySelector("#numInteriorVisitante").value;
        let intApto = document.querySelector("#numAptoVisitante").value;
        let fchaIngreso = document.querySelector("#fechaIngresoVisitante").value;
        let hrIngreso = document.querySelector("#horaIngresoVisitante").value;
        let fchaSalida = document.querySelector("#fechaSalidaVisitante").value;
        let hrSalida = document.querySelector("#horaSalidaVisitante").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strNombres == '' || strApellidos == '' || strTipoDoc == '' || intNumDoc == '' || intTorre == ''
            || intInte == '' || intApto == '' || fchaIngreso == '' || hrIngreso == '' || fchaSalida == ''
            || hrSalida == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Visitante/setVisit';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formVisit);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estadoVisitante) {
                    $('#agregarVisitante').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formVisit.reset();//para reseterar o limpiar los campos del formulario
                    swal("Visitante", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableVisit.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditVisit(idVisit) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Visitante";
    document.querySelector('#btnInsertVisi').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idVisitante = idVisit;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Visitante/getOneVisit/' + idVisitante;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estadoVisitante) {
                //mostrar los datos en el formulario
                document.querySelector("#idVisitante").value = objData.data.idVisitante;
                document.querySelector("#nombreVisitante").value = objData.data.nombreVisitante;
                document.querySelector("#apellidosVisitante").value = objData.data.apellidoVisitante;
                document.querySelector("#tipoDocVisitante").value = objData.data.tipoDocumentoVisitante;
                document.querySelector("#numeroDocVisitante").value = objData.data.numeroDocumentoVisitante;
                document.querySelector("#numTorreVisitante").value = objData.data.numTorreDirige;
                document.querySelector("#numInteriorVisitante").value = objData.data.numBloqueDirige;
                document.querySelector("#numAptoVisitante").value = objData.data.numApartamentoDirige;
                document.querySelector("#fechaIngresoVisitante").value = objData.data.fechaIngresoVisitante;
                document.querySelector("#horaIngresoVisitante").value = objData.data.horaIngresoVisitante;
                document.querySelector("#fechaSalidaVisitante").value = objData.data.fechaSalidaVisitante;
                document.querySelector("#horaSalidaVisitante").value = objData.data.horaSalidaVisitante;
                document.querySelector("#estadoVisitante").value = objData.data.estadoVisitante;
            }
        }
    }

    $('#agregarVisitante').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar visitantes
function fntDeleteVist(idVisitante) {

    let idVisit = idVisitante;

    swal({
        title: 'Inhabilitar Visitante',
        text: "¿Realmente quieres inhabilitar el Visitante? " + idVisit,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Visitante/delVisit/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idVisitante=" + idVisit;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoVisitante) {
                            swal("Inhabilitar!", objData.msg, "success");
                            tableVisit.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Visitante", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {
    document.querySelector("#idVisitante").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Visitante";
    document.querySelector('#btnInsertVisi').classList.replace("Modificar", "Registar");
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formVisitante').reset();
    //mostar la modal
    $('#agregarVisitante').modal('show');
}
