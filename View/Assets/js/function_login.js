//capturar los datos
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('#formLogin')) {
        let formLogin = document.querySelector('#formLogin')
        formLogin.onsubmit = function (e) {
            e.preventDefault();

            let strEmail = document.querySelector('#Usuario').value;
            let strPassword = document.querySelector('#pass').value;

            if (strEmail == "" || strPassword == "") {
                swal(
                    'Por favor',
                    'Ingrese su usuario y contraseña.',
                    'error'
                )
                return false;
            } else {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');//identificar el navegador donde se esta ejecutando
                var ajaxUrl = base_url + 'Index/loginUser';//definir la ruta donde se encuentra el archivo ajax
                var formData = new FormData(formLogin);
                request.open("POST", ajaxUrl, true);//abrimos la conexion indicando que vamos a enviar los datos por POST
                request.send(formData);

                request.onreadystatechange = function () {

                    if (request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.estadoAdministrador == true) {
                            window.location = base_url + 'Principal';
                        }
                        else {
                            swal("Atención!", objData.msg, "error");
                            //document.querySelector('#Usuario').value = "";
                            document.querySelector('#pass').value = "";
                        }
                    } else {
                        swal("Atención!", "Error en el proceso", "error");
                    }
                    return false;
                }
            }
        }
    }
}, false);

//VALIDAR EL LOGIN

// Recorrer los elementos y hacer que onchange ejecute una funcion para comprobar el valor de ese input
(function () {
    var formulario = document.formulario_registro,
        elementos = formulario.elements;

    // Funcion que se ejecuta cuando el evento click es activado

    var validarInputs = function () {
        for (var i = 0; i < elementos.length; i++) {
            // Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
            if (
                elementos[i].type == "text" ||
                elementos[i].type == "email" ||
                elementos[i].type == "password"
            ) {
                // Si es tipo texto, email o password vamos a comprobar que esten completados los input
                if (elementos[i].value.length == 0) {
                    console.log("El campo " + elementos[i].name + " esta incompleto");
                    elementos[i].className = elementos[i].className + " error";
                    return false;
                } else {
                    elementos[i].className = elementos[i].className.replace(" error", "");
                }
            }
        }

        return true;
    };

    var enviar = function (e) {
        if (!validarInputs()) {
            console.log("Falto validar los Input");
            e.preventDefault();
        }
    };

    var focusInput = function () {
        this.parentElement.children[1].className = "label active";
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace(
            "error",
            ""
        );
    };

    var blurInput = function () {
        if (this.value <= 0) {
            this.parentElement.children[1].className = "label";
            this.parentElement.children[0].className =
                this.parentElement.children[0].className + " error";
        }
    };

    // --- Eventos ---
    formulario.addEventListener("submit", enviar);

    for (var i = 0; i < elementos.length; i++) {
        if (
            elementos[i].type == "text" ||
            elementos[i].type == "email" ||
            elementos[i].type == "password"
        ) {
            elementos[i].addEventListener("focus", focusInput);
            elementos[i].addEventListener("blur", blurInput);
        }
    }
})();