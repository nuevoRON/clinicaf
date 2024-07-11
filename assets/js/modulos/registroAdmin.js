const formulario = document.querySelector('#formulario');
const usuario = document.querySelector('#usuario');
const nombres = document.querySelector('#nombres');
const apellido = document.querySelector('#apellido');
const correo = document.querySelector('#correo');
const identidad = document.querySelector('#identidad');
const direccion = document.querySelector('#direccion');
const contraseña = document.querySelector('#contraseña');
const confcontraseña = document.querySelector('#confcontraseña');
const id = document.querySelector('#id');

//elementos para mostrar errores
const errorUsuario = document.querySelector('#errorUsuario');
const errorNombre = document.querySelector('#errorNombre');
const errorApellido = document.querySelector('#errorApellido');
const errorCorreo = document.querySelector('#errorCorreo');
const errorIdentidad = document.querySelector('#errorIdentidad');
const errorDireccion = document.querySelector('#errorDireccion');
const errorContraseña = document.querySelector('#errorContraseña');
const errorConfContraseña = document.querySelector('#errorConfContraseña');

const btnAccion = document.querySelector('#btnAccion');

document.addEventListener('DOMContentLoaded', function () {

    //registar usuarios
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorUsuario.textContent = '';
        errorNombre.textContent = '';
        errorApellido.textContent= '';
        errorCorreo.textContent = '';
        errorIdentidad.textContent = '';
        errorDireccion.textContent = '';
        errorContraseña.textContent = '';
        errorConfContraseña.textContent = '';
        if (usuario.value == '') {
            errorUsuario.textContent = 'EL USUARIO ES REQUERIDO';
        }else if (nombres.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES REQUERIDO';
        }else if (apellido.value == '') {
            errorApellido.textContent = 'EL APELLIDO ES REQUERIDO';
        }else if (correo.value == '') {
            errorCorreo.textContent = 'EL CORREO ES REQUERIDO';
        }else if (identidad.value == '') {
            errorIdentidad.textContent = 'LA IDENTIDAD ES REQUERIDA';
        }else if (direccion.value == '') {
            errorDireccion.textContent = 'LA DIRECCIÓN ES REQUERIDA';
        } else if (contraseña.value == '') {
            errorContraseña.textContent = 'LA CONTRASEÑA ES REQUERIDA';
        } else if (confcontraseña == ''){
            errorConfContraseña.textContent = 'LA CONFIRMACIÓN ES REQUERIDA'
        } else if (confcontraseña.value !== contraseña.value){

            Swal.fire({
                toast : true,
                position: 'top-right',
                icon: 'error',
                title: 'LA CONTRASEÑA DEBE COINCIDIR',
                showConfirmButton: false,
                timer: 1500
            })
        } else if (identidad.value.includes('0000000000000')) {
            Swal.fire({
                toast : true,
                position: 'top-right',
                icon: 'warning',
                title: 'NO SE PERMITEN SOLO 0 EN LA IDENTIDAD',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            const url = base_url + 'usuarios/autoregistrarAdmin';
            //crear formData
            const data = new FormData(this);
            //hacer una instancia del objeto CMLHttoRequest
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open('POST', url, true);
            //Enviar Datos
            http.send(data);
            //Verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText)
                    const res = JSON.parse(this.responseText);
                    console.log(res)
                    if(res.msg.includes("SQLSTATE[23000]")) {
                        res.msg = "EL USUARIO DEBE SER UNICO"
                    }
                    Swal.fire({
                        toast : true,
                        position: 'top-right',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    if (res.type == 'success') {
                        limpiarCampos();
                    }
                }
            }
        }
    })
})
function limpiarCampos(){
    formulario.reset();
}

