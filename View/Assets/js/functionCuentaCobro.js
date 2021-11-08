let tableCuenta;
document.addEventListener('DOMContentLoaded', function () {
    tableCuenta = $('#example').DataTable({
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
            "url": "" + base_url + "Cuenta_cobro/getCuenta",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idCuenta" },
            { "data": "fechaExpideCuenta" },
            { "data": "fechaVencimientoPago" },
            { "data": "estadoCuenta" },
            { "data": "periodoCuenta" },
            { "data": "fechaPagoOportuno" },
            { "data": "fechaConsignacion" },
            { "data": "valorPagoCuenta" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });


    //NUEVA CUENTA DE COBRO
    let formCuenta = document.querySelector("#formCuenta");
    formCuenta.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo
        let intIdCuenta = document.querySelector("#idCuenta").value;
        let strFechaExpideCuenta = document.querySelector("#fechaExpideCuenta").value;
        let strFechaVencimientoPago = document.querySelector("#fechaVencimientoPago").value;
        let strEstadoCuenta = document.querySelector("#estadoCuenta").value;
        let strPeriodoCuenta = document.querySelector("#periodoCuenta").value;
        let strFechaPagoOportuno = document.querySelector("#fechaPagoOportuno").value;
        let strFechaConsignación = document.querySelector("#fechaConsignacion").value;
        let strValorPagoCuenta = document.querySelector("#inlineFormInputGroup").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strFechaExpideCuenta == '' || strFechaVencimientoPago == '' || strEstadoCuenta == '' || strPeriodoCuenta == '' || strFechaPagoOportuno == ''
            || strFechaConsignación == '' || strValorPagoCuenta == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Cuenta_cobro/setCuenta';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formCuenta);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado cuenta es verdadero entonces
                if (objData.estadoCuenta) {
                    $('#agregarCuenta').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formCuenta.reset();//para reseterar o limpiar los campos del formulario
                    swal("Cuenta cobro", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableCuenta.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditCuenta(idCuen) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Cuenta Cobro";
    document.querySelector('#btnInsertCuenta').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idCuenta = idCuen;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Cuenta_cobro/getOneCuenta/' + idCuenta;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estadoCuenta) {
                //mostrar los datos en el formulario
                document.querySelector("#idCuenta").value = objData.data.idCuenta;
                document.querySelector("#fechaExpideCuenta").value = objData.data.fechaExpideCuenta;
                document.querySelector("#fechaVencimientoPago").value = objData.data.fechaVencimientoPago;
                document.querySelector("#estadoCuenta").value = objData.data.estadoCuenta;
                document.querySelector("#periodoCuenta").value = objData.data.periodoCuenta;
                document.querySelector("#fechaPagoOportuno").value = objData.data.fechaPagoOportuno;
                document.querySelector("#fechaConsignacion").value = objData.data.fechaConsignacion;
                document.querySelector("#inlineFormInputGroup").value = objData.data.valorPagoCuenta;               
            }
        }
    }

    $('#agregarCuenta').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteCuenta(idCuenta) {

    let idCuent = idCuenta;

    swal({
        title: 'Inhabilitar Cuenta',
        text: "¿Realmente quieres inhabilitar esta cuenta?" + ' ' + idCuent,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Cuenta_cobro/delCuenta/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idCuenta=" + idCuent;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoCuenta) {
                            swal("Cuentas de cobro", objData.msg, "success");
                            tableCuenta.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Cuentas de cobro", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {
    document.querySelector("#idCuenta").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Cuenta";
    document.querySelector('#btnInsertCuenta').classList.replace("Modificar", "Registar");
    document.querySelector('#textTittle').innerHTML = "Registrar"
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formCuenta').reset();
    //mostar la modal
    $('#agregarCuenta').modal('show');
}
