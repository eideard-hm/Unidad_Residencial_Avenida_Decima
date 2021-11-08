let tableAdmin;
document.addEventListener('DOMContentLoaded', function () {
    tableAdmin = $('#example').DataTable({
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
            "url": "" + base_url + "Administrador/getAdmin",
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

    //NUEVO ADMIN
    let formAdmin = document.querySelector("#formAdmin");
    formAdmin.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo
        let strEmail = document.querySelector("#correoAdmin").value;
        let strPass = document.querySelector("#pass").value;
        let strNombres = document.querySelector("#nombreAdmin").value;
        let strApellidos = document.querySelector("#apellidosAdmin").value;
        let strTipoDoc = document.querySelector("#TipoDocumentoAdmin").value;
        let intNumDoc = document.querySelector("#numDocAdmin").value;
        let intTel = document.querySelector("#NumTelAdmin").value;
        let strEstado = document.querySelector("#estadoAdmin").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
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
        let ajaxUrl = base_url + 'Administrador/setAdmin';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formAdmin);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estadoAdministrador) {
                    $('#agregarnuevosdatosmodal').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formAdmin.reset();//para reseterar o limpiar los campos del formulario
                    swal("Administrador", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableAdmin.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditAdmin(idAdmin) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Administrador";
    document.querySelector('#btnInsertAdmin').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idAdministrador = idAdmin;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Administrador/getOneAdmin/' + idAdministrador;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estadoAdministrador) {
                //mostrar los datos en el formulario
                document.querySelector("#idAdmin").value = objData.data.id;
                document.querySelector("#correoAdmin").value = objData.data.correo;
                document.querySelector("#pass").value = objData.data.passwordU;
                document.querySelector("#nombreAdmin").value = objData.data.nombres;
                document.querySelector("#apellidosAdmin").value = objData.data.apellidos;
                document.querySelector("#TipoDocumentoAdmin").value = objData.data.tipoDocumento;
                document.querySelector("#numDocAdmin").value = objData.data.numDocumento;
                document.querySelector("#NumTelAdmin").value = objData.data.telefono;
                document.querySelector("#estadoAdmin").value = objData.data.estado;               
            }
        }
    }

    $('#agregarnuevosdatosmodal').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteAdmin(idAdministrador) {

    let idAdmin = idAdministrador;

    swal({
        title: 'Inhabilitar Administrador',
        text: "¿Realmente quieres inhabilitar el Administrador?" + idAdmin,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Administrador/delAdmin/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idAdministrador=" + idAdmin;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoAdministrador) {
                            swal("Inhabilitar!", objData.msg, "success");
                            tableAdmin.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Administrador", "Los datos estan salvos :)", "success");
            }
        });
}

//función para abrir la ventana modal
function openModal() {
    document.querySelector("#idAdmin").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Administrador";
    document.querySelector('#btnInsertAdmin').classList.replace("Modificar", "Registar");
    document.querySelector('#textTittle').innerHTML = "Registrar"
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formAdmin').reset();
    //mostar la modal
    $('#agregarnuevosdatosmodal').modal('show');
}