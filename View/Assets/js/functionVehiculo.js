let tableVehi;
document.addEventListener('DOMContentLoaded', function () {
    tableVehi = $('#example').DataTable({
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
            "url": "" + base_url + "Vehiculo/getVehi",
            "dataSrc": ""
        },
        "columns": [
            { "data": "placaVehiculo" },
            { "data": "modeloVehiculo" },
            { "data": "marcaVehiculo" },
            { "data": "colorVehiculo" },
            { "data": "tipoVehiculo" },            
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });//NUEVO VEHICULO
    let formVehi = document.querySelector("#formVehiculo");
    formVehi.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo
        let strPlaca = document.querySelector("#placaVehiculo").value;
        let intModelo = document.querySelector("#modeloVehiculo").value;
        let strMarca = document.querySelector("#marcaVehiculo").value;
        let stColor = document.querySelector("#colorVehiculo").value;
        let strTipo = document.querySelector("#tipoVehiculo").value;        

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strPlaca == '' || intModelo == '' || strMarca == '' || stColor == '' || strTipo == '' ) {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Vehiculo/setVehi';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formVehi);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estado) {
                    $('#agregarVehiculo').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formVehi.reset();//para reseterar o limpiar los campos del formulario
                    swal("Vehículo", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableVehi.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditVehi(idVehi) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Vehículo";
    document.querySelector('#btnInsertVeh').classList.replace("Registar", "Modificar");
    document.querySelector('#textTittle').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idVehiculo = idVehi;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Vehiculo/getOneVehi/' + idVehiculo;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estado) {
                //mostrar los datos en el formulario
                document.querySelector("#idVehiculo").value = objData.data.idVehiculo ;
                document.querySelector("#placaVehiculo").value = objData.data.placaVehiculo;
                document.querySelector("#modeloVehiculo").value = objData.data.modeloVehiculo;
                document.querySelector("#marcaVehiculo").value = objData.data.marcaVehiculo;
                document.querySelector("#colorVehiculo").value = objData.data.colorVehiculo;
                document.querySelector("#tipoVehiculo").value = objData.data.tipoVehiculo;                               
            }
        }
    }

    $('#agregarVehiculo').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteVehi(idVehiculo) {

    let idVehi = idVehiculo;

    swal({
        title: 'Eliminar Vehículo',
        text: "¿Realmente quieres eliminar el Vehículo? " + idVehi,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Vehiculo/delVehi/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idVehiculo=" + idVehi;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estado) {
                            swal("Vehículo!", objData.msg, "success");
                            tableVehi.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Vehículo", "Los datos estan salvos :)", "success");
            }
        });
}

function openModal() {  
    document.querySelector("#idVehiculo").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Vehículo";
    document.querySelector('#btnInsertVeh').classList.replace("Modificar", "Registar");
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formVehiculo').reset();
    //mostar la modal
    $('#agregarVehiculo').modal('show');
}
