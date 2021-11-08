let tableRubro;
document.addEventListener('DOMContentLoaded', function () {
    tableRubro = $('#example').DataTable({
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
            "url": "" + base_url + "Rubro/getRubro",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idRubro" },
            { "data": "nombreRubro" },
            { "data": "descripcionRubro" },
            { "data": "valorRubro" },
            { "data": "estadoRubro" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });

    //NUEVO RUBRO
    let formRubro = document.querySelector("#formRubro");
    formRubro.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo        
        let strNombreRubro = document.querySelector("#nombreRubro").value;
        let strDescripcionRubro = document.querySelector("#descripcionRubro").value;
        let strValorRubro = document.querySelector("#inlineFormInputGroup").value;
        let strEstadoRubro = document.querySelector("#estadoRubro").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strNombreRubro == '' || strDescripcionRubro == '' || strValorRubro == '' || strEstadoRubro == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Rubro/setRubro';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formRubro);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estadoRubro) {
                    $('#agregarRubro').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formRubro.reset();//para reseterar o limpiar los campos del formulario
                    swal("Rubro", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableRubro.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

// ftn (function)
function ftnEditRubro(idRubro) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Rubro";
    document.querySelector('#btnInsertRubro').classList.replace("Registar", "Modificar");
    document.querySelector('#btnText').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idRub = idRubro;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Rubro/getOneRubro/' + idRub;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estadoRubro) {
                //mostrar los datos en el formulario
                document.querySelector("#idRubro").value = objData.data.idRubro;
                document.querySelector("#nombreRubro").value = objData.data.nombreRubro;
                document.querySelector("#descripcionRubro").value = objData.data.descripcionRubro;
                document.querySelector(".valor-rubro").value = objData.valorRubro;
                document.querySelector("#estadoRubro").value = objData.data.estadoRubro;
            }
        }
    }

    $('#agregarRubro').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteRubro(idRubro) {

    let idRubros = idRubro;

    swal({
        title: 'Inhabilitar Rubro',
        text: "¿Realmente quieres inhabilitar el Rubro? " + idRubros,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Rubro/delRubro/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idRubro=" + idRubros;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoRubro) {
                            swal("Rubro", objData.msg, "success");
                            tableRubro.ajax.reload(function () {
                            });
                        } else {
                            swal("Atención!", objData, "error");
                        }
                    }
                }
            } else {
                swal("Rubro", "Los datos estan salvos :)", "success");
            }
        });
}

//función para abrir la ventana modal
function openModal() {
    document.querySelector("#idRubro").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Rubro";
    document.querySelector('#btnInsertRubro').classList.replace("Modificar", "Registar");
    document.querySelector('#textTittle').innerHTML = "Registrar"
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formRubro').reset();
    //mostar la modal
    $('#agregarRubro').modal('show');
}



