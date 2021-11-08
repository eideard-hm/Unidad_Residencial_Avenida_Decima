let tableParq;
document.addEventListener('DOMContentLoaded', function () {
    tableParq = $('#example').DataTable({
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
            "url": "" + base_url + "Parqueadero/getParq",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idParqueadero" },
            { "data": "usoParqueadero" },
            { "data": "estadoParqueadero" },
            { "data": "tipoParqueadero" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });
    //NUEVO PARQUEADERO
    let formParq = document.querySelector("#formParq");
    formParq.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo        
        let strUsoParq = document.querySelector("#usuParqueadero").value;
        let strEstadoParq = document.querySelector("#estadoParquadero").value;
        let strTipoParq = document.querySelector("#tipoParquadero").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strUsoParq == '' || strEstadoParq == '' || strTipoParq == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Parqueadero/setParq';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formParq);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estado) {
                    $('#agregarParqueadero').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formParq.reset();//para reseterar o limpiar los campos del formulario
                    swal("Parqueadero", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableParq.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditParq(idParq) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Parqueadero";
    document.querySelector('#btnInsertParq').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idParqueadero = idParq;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Parqueadero/getOneParq/' + idParqueadero;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estado) {
                //mostrar los datos en el formulario
                document.querySelector("#idParqueadero").value = objData.data.idParqueadero;
                document.querySelector("#usuParqueadero").value = objData.data.usoParqueadero;
                document.querySelector("#estadoParquadero").value = objData.data.estadoParqueadero;
                document.querySelector("#tipoParquadero").value = objData.data.tipoParqueadero;
            }
        }
    }

    $('#agregarParqueadero').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteParq(idParqueadero) {

    let idParq = idParqueadero;

    swal({
        title: 'Inhabilitar Parqueadero',
        text: "¿Realmente quieres inhabilitar el Parquadero? " + idParq,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Parqueadero/delParq/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idParqueadero=" + idParq;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estado) {
                            swal("Parqueadero", objData.msg, "success");
                            tableParq.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Parqueadero", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {
    document.querySelector("#idParqueadero").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Parqueadero";
    document.querySelector('#btnInsertParq').classList.replace("Modificar", "Registar");
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formParq').reset();
    //mostar la modal
    $('#agregarParqueadero').modal('show');
}
