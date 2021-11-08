let tableGuarda;
document.addEventListener('DOMContentLoaded', function () {
    tableGuarda = $('#example').DataTable({
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
            "url": "" + base_url + "Guarda_seguridad/getGuarda",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "correo" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "tipoDocumento" },
            { "data": "numDocumento" },
            { "data": "telefono" },
            { "data": "estado" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });

    //NUEVO guarda
    let formGuarda = document.querySelector("#formGuarda");
    formGuarda.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo
        let strEmail = document.querySelector("#correoGuarda").value;
        let strPass = document.querySelector("#pass").value;
        let strNombres = document.querySelector("#nombreGuarda").value;
        let strApellidos = document.querySelector("#apellidosGuarda").value;
        let strTipoDoc = document.querySelector("#TipoDocumentoGuarda").value;
        let intNumDoc = document.querySelector("#numDocGuarda").value;
        let intTel = document.querySelector("#NumTelGuarda").value;
        let strEstado = document.querySelector("#estadoGuarda").value;

        //condicional para evitar que los campos esten vacion
        if (strEmail == '' || strPass == '' || strNombres == '' || strApellidos == '' || strTipoDoc == '' || intNumDoc == ''
            || intTel == '' || strEstado == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Guarda_seguridad/setGuarda';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formGuarda);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estado) {
                    $('#agregarGuarda').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formGuarda.reset();//para reseterar o limpiar los campos del formulario
                    swal("Guarda de seguridad", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableGuarda.ajax.reload(function () {

                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditGuarda(idGuardaS) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Guarda";
    document.querySelector('#btnInsertGuarda').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idGuarda = idGuardaS;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Guarda_seguridad/getOneGuarda/' + idGuarda;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estado) {
                //mostrar los datos en el formulario
                document.querySelector('#idGuarda').value = objData.data.id;
                document.querySelector("#correoGuarda").value = objData.data.correo;
                document.querySelector("#pass").value = objData.data.passwordU;
                document.querySelector("#nombreGuarda").value= objData.data.nombres;
                document.querySelector("#apellidosGuarda").value= objData.data.apellidos;
                document.querySelector("#TipoDocumentoGuarda").value= objData.data.tipoDocumento;
                document.querySelector("#numDocGuarda").value = objData.data.numDocumento;
                document.querySelector("#NumTelGuarda").value= objData.data.telefono;
                document.querySelector("#estadoGuarda").value= objData.data.estado;
            }
        }
    }

    $('#agregarGuarda').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteGuarda(idGuarda) {

    let idGuard = idGuarda;

    swal({
        title: 'Inhabilitar Guarda',
        text: "¿Realmente quieres inhabilitar el Guarda? " + idGuard,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Guarda_seguridad/delGuarda/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idGuarda=" + idGuard;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estado) {
                            swal("Inhabilitar!", objData.msg, "success");
                            tableGuarda.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Guarda", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {
    document.querySelector("#idGuarda").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Guarda de seguridad";
    document.querySelector('#btnInsertGuarda').classList.replace("Modificar", "Registar");
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formGuarda').reset();
    //mostar la modal
    $('#agregarGuarda').modal('show');
}



