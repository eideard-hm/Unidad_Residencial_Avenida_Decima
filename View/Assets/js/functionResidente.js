let tableResid;
document.addEventListener('DOMContentLoaded', function () {
    tableResid = $('#example').DataTable({
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
            "url": "" + base_url + "Residente/getResid",
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
            { "data": "telFijo" },
            { "data": "numTorre" },
            { "data": "numBloque" },
            { "data": "numApartamento" },
            { "data": "estado" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });

    //NUEVO RESIDENTE
    let formResid = document.querySelector("#formResid");
    formResid.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo
        let strEmail = document.querySelector("#correoResid").value;
        let strPass = document.querySelector("#pass").value;
        let strNombres = document.querySelector("#nombre").value;
        let strApellidos = document.querySelector("#apellidos").value;
        let strTipoDoc = document.querySelector("#TipoDocumento").value;
        let intNumDoc = document.querySelector("#numDoc").value;
        let intTel = document.querySelector("#NumTel").value;
        let intTelFij = document.querySelector("#NumTelFijo").value;
        let intTorre = document.querySelector("#numTorre").value;
        let intInterior = document.querySelector("#numInterior").value;
        let intAptp = document.querySelector("#numApartamento").value;
        let strEstado = document.querySelector("#estadoResidente").value;

        //condicional para evitar que los campos esten vacion
        if (strEmail == '' || strPass == '' || strNombres == '' || strApellidos == '' || strTipoDoc == ''
            || intNumDoc == '' || intTel == '' || intTelFij == '' || intTorre == '' || intInterior == ''
            || intAptp == '' || strEstado == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Residente/setResid';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formResid);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estado) {
                    $('#agregarResidente').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formResid.reset();//para reseterar o limpiar los campos del formulario
                    swal("Residente", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableResid.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

//función paraeditar residente

// ftn (function)
function ftnEditResid(idResid) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Residente";
    document.querySelector('#btnInsertResid').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idResidente = idResid;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Residente/getOneResid/' + idResidente;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estado) {
                //mostrar los datos en el formulario
                document.querySelector("#idResidente").value = objData.data.id;
                document.querySelector("#correoResid").value = objData.data.correo;
                document.querySelector("#pass").value = objData.data.passwordU;
                document.querySelector("#nombre").value = objData.data.nombres;
                document.querySelector("#apellidos").value = objData.data.apellidos;
                document.querySelector("#TipoDocumento").value = objData.data.tipoDocumento;
                document.querySelector("#numDoc").value = objData.data.numDocumento;
                document.querySelector("#NumTel").value = objData.data.telefono;
                document.querySelector("#NumTelFijo").value = objData.data.telFijo;
                document.querySelector("#numTorre").value = objData.data.numTorre;
                document.querySelector("#numInterior").value = objData.data.numBloque;
                document.querySelector("#numApartamento").value = objData.data.numApartamento;
                document.querySelector("#estadoResidente").value = objData.data.estado;
            }
        }
    }

    $('#agregarResidente').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteResid(idResidente) {

    let idResid = idResidente;

    swal({
        title: 'Inhabilitar Residente',
        text: "¿Realmente quieres inhabilitar el Residente? " + idResid,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Residente/delResid/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idResidente=" + idResid;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estado) {
                            swal("Inhabilitar!", objData.msg, "success");
                            tableResid.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Residente", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {
    document.querySelector("#idResidente").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Residente";
    document.querySelector('#btnInsertResid').classList.replace("Modificar", "Registar");
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formResid').reset();
    //mostar la modal
    $('#agregarResidente').modal('show');
}


