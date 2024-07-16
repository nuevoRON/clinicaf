const formulario = document.querySelector('#formulario');
const usuario = document.querySelector('#usuario');
const clave = document.querySelector('#clave');

const errorCorreo = document.querySelector('#errorCorreo');
const errorClave = document.querySelector('#errorClave');

document.addEventListener('DOMContentLoaded', function () {
  formulario.addEventListener('submit', function (e) {
    e.preventDefault();
    //errorCorreo.textContent = '';
    //errorClave.textContent = '';
    if (usuario.value == '') {
      //errorCorreo.textContent = 'EL USUARIO ES REQUERIDO';
      console.log('Ingrese un usuario')
    } else if (clave.value == '') {
      console.log('Ingrese una clave')
      //errorClave.textContent = 'LA CONTRASEÑA ES REQUERIDO';
    }else {
      let url = 'http://localhost/clinicaf/login/iniciarSesion';
      const data = new FormData(this);
      const http = new XMLHttpRequest();
      http.open('POST', url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText)
          const res = JSON.parse(this.responseText);
          console.log(res)
          
          if (res.type == 'success') {
            /* let data = {
              idUser: res.id_usuario,
              idObjeto: 1,
              accion: "INGRESO",
              descripcion: "HA INICIADO SESIÓN EN EL SISTEMA",
            };
            url = base_url + "Bitacora/CrearEvento";
            axios.post(url, data).then((res) => {console.log(res)}); */

            window.location = 'http://localhost/clinicaf/inicio/';
          } else {
            Swal.fire(
              'Error',
              res.msg,
              res.type
            )
          } 
        }
      }
    } 

  });
})