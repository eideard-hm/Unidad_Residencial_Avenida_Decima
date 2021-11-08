let tableEmpleado;
document.addEventListener('DOMContentLoaded', function () {
    tableEmpleado = $('#example').DataTable({
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
            "url": "" + base_url + "Empleado/getEmpleado",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idEmpleado" },
            { "data": "nombresEmpleado" },
            { "data": "apellidosEmpleado" },
            { "data": "tipoDocumentoEmpleado" },
            { "data": "numDocumentoEmpleado" },
            { "data": "telefonoEmpleado" },
            { "data": "cargoEmpleado" },
            { "data": "ARLEmpleado" },
            { "data": "estadoEmpleado" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });
    let formEmp = document.querySelector("#formEmp");
    formEmp.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo        
        let strNombresEmpleado = document.querySelector("#nombreEmpleado").value;
        let strApellidosEmpleado = document.querySelector("#apellidosEmpleado").value;
        let strDocEmpleado = document.querySelector("#tipoDocEmpleado").value;
        let intNumDocEmpleado = document.querySelector("#numDocEmpleado").value;
        let intTelefonoEmpleado = document.querySelector("#numTelEmpleado").value;
        let strCargoEmpleado = document.querySelector("#cargoEmpleado").value;
        let strARLEmpleado = document.querySelector("#ARLEmpleado").value;
        let strEstadoEmpleado = document.querySelector("#estadoEmpleado").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strNombresEmpleado == '' || strApellidosEmpleado == '' || strDocEmpleado == '' ||
            intNumDocEmpleado == '' || intTelefonoEmpleado == '' || strCargoEmpleado == '' ||
            strARLEmpleado == '' || strEstadoEmpleado == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Empleado/setEmp';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formEmp);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estadoEmpleado) {
                    $('#agregarEmpleado').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formEmp.reset();//para reseterar o limpiar los campos del formulario
                    swal("Empleado", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableEmpleado.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditEmp(idEmp) {
    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Empleado";
    document.querySelector('#btnInsertEm').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idEmpleado = idEmp;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Empleado/getOneEmpleado/' + idEmpleado;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estadoEmpleado) {
                //mostrar los datos en el formulario
                document.querySelector("#idEmpleado").value = objData.data.idEmpleado;
                document.querySelector("#nombreEmpleado").value = objData.data.nombresEmpleado;
                document.querySelector("#apellidosEmpleado").value = objData.data.apellidosEmpleado;
                document.querySelector("#tipoDocEmpleado").value = objData.data.tipoDocumentoEmpleado;
                document.querySelector("#numDocEmpleado").value = objData.data.numDocumentoEmpleado;
                document.querySelector("#numTelEmpleado").value = objData.data.telefonoEmpleado;
                document.querySelector("#cargoEmpleado").value = objData.data.cargoEmpleado;
                document.querySelector("#ARLEmpleado").value = objData.data.ARLEmpleado;
                document.querySelector("#estadoEmpleado").value = objData.data.estadoEmpleado;
            }
        }
    }

    $('#agregarEmpleado').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteEmp(idEmpleado) {

    let idEmp = idEmpleado;

    swal({
        title: 'Inhabilitar Empleado',
        text: "¿Realmente quieres inhabilitar el Empleado? " + idEmp,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Empleado/delEmpleado/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idEmpleado=" + idEmp;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoEmpleado) {
                            swal("Inhabilitar Empleado", objData.msg, "success");
                            tableEmpleado.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Anuncio", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {
    document.querySelector("#idEmpleado").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Empleado";
    document.querySelector('#btnInsertEm').classList.replace("Modificar", "Registar");
    document.querySelector('#textTittle').innerHTML = "Registrar";
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formEmp').reset();
    //mostar la modal
    $('#agregarEmpleado').modal('show');
}

