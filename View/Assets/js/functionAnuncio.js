let tableAnuncio;
document.addEventListener('DOMContentLoaded', function () {

    if (document.querySelector("#foto")) {
        let foto = document.querySelector("#foto");
        foto.onchange = function (e) {
            let uploadFoto = document.querySelector("#foto").value;
            let fileimg = document.querySelector("#foto").files;
            let nav = window.URL || window.webkitURL;
            let contactAlert = document.querySelector('#form_alert');
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");
                    foto.value = "";
                    return false;
                } else {
                    contactAlert.innerHTML = '';
                    if (document.querySelector('#img')) {
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";
                }
            } else {
                alert("No selecciono foto");
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
            }
        }
    }

    if (document.querySelector(".delPhoto")) {
        let delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function (e) {
            removePhoto();
        }
    }

    tableAnuncio = $('#example').DataTable({
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
            "url": "" + base_url + "Anuncio/getAnuncio",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idAnuncio" },
            { "data": "tituloAnuncio" },
            { "data": "cuerpoAnuncio" },
            { "data": "fechaInicioAnuncio" },
            { "data": "fechaFinAnuncio" },
            { "data": "imagenAnuncio" },
            { "data": "estadoAnuncio" },
            { "data": "options" }
        ],
        "order": [[0, "desc"]]
    });
    //NUEVO ANUNCIO
    let formAnuncio = document.querySelector("#formAnuncio");
    formAnuncio.onsubmit = function (e) {
        e.preventDefault(); //evita el comportamiento normal del submit, es decir, recarga total de la página
        //selecccionar los campo        
        let strTitulo = document.querySelector("#tituloAnuncio").value;
        let strCuerpo = document.querySelector("#cuerpoAnuncio").value;
        let strInicio = document.querySelector("#fechaInicioAnuncio").value;
        let strFin = document.querySelector("#fechaFinAnuncio").value;
        let strImagen = document.querySelector("#foto").value;
        let strEstadoA = document.querySelector("#estadoAnuncio").value;

        //condicional para evitar que los campos esten vacios
        // || es el operado o
        if (strTitulo == '' || strCuerpo == '' || strInicio == '' || strFin == '' || strImagen == ''
            || strEstadoA == '') {
            //alerta de sweet alert
            swal(
                'Ha ocurrido un error',
                'Todos los campos son obligatorios.',
                'error'
            )
            return false;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
        let ajaxUrl = base_url + 'Anuncio/setAnuncio';//definir la ruta donde se encuentra el archivo ajax
        let formData = new FormData(formAnuncio);
        request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);//convertir a un objeto lo que estamos obteniendo

                //si lo que viene por estado administrador es verdadero entonces
                if (objData.estadoAnuncio) {
                    $('#agregarAnuncio').modal("hide");//nos derigimos a la modal y lo ocultamos
                    formAnuncio.reset();//para reseterar o limpiar los campos del formulario
                    swal("Anuncio", objData.msg, "success");//mostrar la alerta
                    //refrescar el datatables
                    tableAnuncio.ajax.reload(function () {
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false);

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    document.querySelector('#img').remove();
}

// ftn (function)
function ftnEditAnuncio(idAnun) {

    //configurar algunos elementos que se van a cambiar dentro de la modal
    document.querySelector('#modal-title').innerHTML = "Actualizar Anuncio";
    document.querySelector('#btnInsertAnun').classList.replace("Registar", "Modificar");
    document.querySelector('#btnText').innerHTML = "Actualizar"
    document.querySelector('#btnText').innerHTML = "Actualizar"

    let idAnuncio = idAnun;
    let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
    let ajaxUrl = base_url + 'Anuncio/getOneAnuncio/' + idAnuncio;//definir la ruta donde se encuentra el archivo ajax
    request.open("GET", ajaxUrl, true);//abrir la conexión
    request.send();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);//convierte a un objeto la respuesta

            if (objData.estadoAnuncio) {
                //mostrar los datos en el formulario
                document.querySelector("#idAnuncio").value = objData.data.idAnuncio;
                document.querySelector("#tituloAnuncio").value = objData.data.tituloAnuncio;
                document.querySelector("#cuerpoAnuncio").value = objData.data.cuerpoAnuncio;
                document.querySelector("#fechaInicioAnuncio").value = objData.data.fechaInicioAnuncio;
                document.querySelector("#fechaFinAnuncio").value = objData.data.fechaFinAnuncio;
                document.querySelector("#foto").value = objData.data.imagenAnuncio;
                document.querySelector("#estadoAnuncio").value = objData.data.estadoAnuncio;

            }
        }
    }

    $('#agregarAnuncio').modal('show'); //para abrir el modal o mostrarlo
}

//funcón para eliminar administradores
function fntDeleteAnuncio(idAnuncio) {

    let idAnun = idAnuncio;

    swal({
        title: 'Inhabilitar Anuncio',
        text: "¿Realmente quieres inhabilitar el Anuncio? " + idAnun,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let request = (window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'));
                let ajaxUrl = base_url + 'Anuncio/delAnuncio/';//definir la ruta donde se encuentra el archivo ajax
                let strData = "idAnuncio=" + idAnun;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoAnuncio) {
                            swal("Inhabilitar!", objData.msg, "success");
                            tableAnuncio.ajax.reload(function () {
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
    document.querySelector("#idAnuncio").value = "";
    //configurar algunos elementos que se van a cambiar
    document.querySelector('#modal-title').innerHTML = "Registrar Anuncio";
    document.querySelector('#btnInsertAnun').classList.replace("Modificar", "Registar");
    document.querySelector('#btnText').innerHTML = "Registrar";
    document.querySelector('#formAnuncio').reset();
    //mostar la modal
    $('#agregarAnuncio').modal('show');
}

