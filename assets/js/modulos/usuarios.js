let tblUsuarios;
const formulario = document.querySelector("#formulario");
const usuario = document.querySelector("#usuario");
const nombres = document.querySelector("#nombres");
const apellido = document.querySelector("#apellido");
const correo = document.querySelector("#correo");
const identidad = document.querySelector("#identidad");
const direccion = document.querySelector("#direccion");
const contraseña = document.querySelector("#contraseña");
const rol = document.querySelector("#rol");
const id = document.querySelector("#id");
const vencimiento = document.querySelector("#vencimiento");
const tipo = document.querySelector("#tipo");
const estado = document.querySelector("#estado");
const verCandidatos = document.querySelector("#verCandidatos");

//elementos para mostrar errores
const errorUsuario = document.querySelector("#errorUsuario");
const errorNombre = document.querySelector("#errorNombre");
const errorApellido = document.querySelector("#errorApellido");
const errorCorreo = document.querySelector("#errorCorreo");
const errorIdentidad = document.querySelector("#errorIdentidad");
const errorDireccion = document.querySelector("#errorDireccion");
const errorContraseña = document.querySelector("#errorContraseña");
const errorRol = document.querySelector("#errorRol");
const errorEstado = document.querySelector("#errorEstado");

const btnAccion = document.querySelector("#btnAccion");
const btnNuevo = document.querySelector("#btnNuevo");
const sino = 1; const permi = 0

document.addEventListener("DOMContentLoaded", function () {
  const buttons = [
    //Botón para PDF
    {
      text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
      action: function () {
        window.location.href = base_url+'views/pdf/pdfUsuarios.php';
      }
    },
  
    //Botón para print
    {
      extend: "print",
      footer: true,
      text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
  
    },
  ];

  permisosPantalla = obtenerPermisos("Usuarios", permisosUsuario);

  if (!permisosPantalla.consultar) {
    window.location.replace(base_url + "admin");
  }
  // cargar roles del usuario
 /* console.log(permisosUsuario);
  let permisosPantalla = obtenerPermisos("Usuarios", permisosUsuario);

  console.log(permisosPantalla);
  if (!permisosPantalla.consultar) {
    window.location.replace(base_url + "admin");
  }*/

  //Cargar roles
  let url = base_url + "usuarios/getRoles/500000000";
  axios
    .get(url)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.roles.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.ROL;
        option.value = opcion.id;
        rol.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });
  //cargar datos con el plugin datatable
  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "usuarios/listarEmpleadoCandidato/false",
      dataSrc: "",
    },
    columns: [
      { data: "NOMBRE_USUARIO" },
      { data: "CORREO_ELECTRONICO" },
      { data: "NUM_IDENTIDAD" },
      { data: "DIRECCION" },
      { data: "id" },
      { data: "DESCRIPCION" },
      { data: "acciones" },
    ],
    language: {
      url: base_url + "assets/js/espanol.json",
    },
    dom,
    buttons,
    responsive: true,
    order: [[0, "asc"]],
  });

  let data = {
    idUser: idUsuario,
    idObjeto: 1,
    accion: "INGRESO",
    descripcion: "SE INGRESÓ A LA PANTALLA DE USUARIOS",
  };
  url = base_url + "Bitacora/CrearEvento";
  axios.post(url, data).then((res) => {
    console.log(res);
  });

  verCandidatos.addEventListener("change", function () {

    tblUsuarios.ajax.url("usuarios/listarEmpleadoCandidato/"+verCandidatos.checked).load();
  })

  //limpiar campos
  btnNuevo.addEventListener("click", function () {
    limpiarCampos();
  });
  //registar usuarios
  formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    errorUsuario.textContent = "";
    errorNombre.textContent = "";
    errorApellido.textContent = "";
    errorCorreo.textContent = "";
    errorIdentidad.textContent = "";
    errorDireccion.textContent = "";
    errorContraseña.textContent = "";
    errorRol.textContent = "";

if (id.value == ""){
    if (!permisosPantalla.crear) {
      //sino = 1
      Swal.fire({
        toast: true,
        position: "top-right",
        icon: "info",
        title: "NO TIENE PERMISO DE CREAR",
        showConfirmButton: false,
        timer: 1500,
      }); 
    } 
}
    //sino = 1
    if (id.value != ""){    
    if (usuario.value == "") {
      errorUsuario.textContent = "EL USUARIO ES REQUERIDO";
    } else if (nombres.value == "") {
      errorNombre.textContent = "EL NOMBRE ES REQUERIDO";
    } else if (apellido.value == "") {
      errorApellido.textContent = "EL APELLIDO ES REQUERIDO";
    } else if (correo.value == "") {
      errorCorreo.textContent = "EL CORREO ES REQUERIDO";
    } else if (identidad.value == "") {
      errorIdentidad.textContent = "LA IDENTIDAD ES REQUERIDO";
    } else if (direccion.value == "") {
      errorDireccion.textContent = "LA DIRECCION ES REQUERIDO";
    } else if (contraseña.value == "") {
      errorContraseña.textContent = "LA CONTRASEÑA ES REQUERIDO";
    } else if (rol.value == "") {
      errorRol.textContent = "EL ROL ES REQUERIDO";
    } else if (estado.value === "") {
      errorEstado.textContent = "EL ESTADO ES REQUERIDO";
    } else if (identidad.value.includes("0000000000000")) {
      Swal.fire({
        toast: true,
        position: "top-right",
        icon: "warning",
        title: "NO SE PERMITEN SOLO 0 EN LA IDENTIDAD",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      const url = base_url + "usuarios/registrar";
      //crear formData
      const data = new FormData(this);
      //hacer una instancia del objeto CMLHttoRequest
      const http = new XMLHttpRequest();
      //Abrir una Conexion - POST - GET
      http.open("POST", url, true);
      //Enviar Datos
      http.send(data);
      //Verificar estados
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          if (
            this.responseText.includes(
              '"msg":"USUARIO REGISTRADO","type":"success"'
            )
          ) {
            Swal.fire({
              toast: true,
              position: "top-right",
              icon: "success",
              title: "USUARIO REGISTRADO",
              showConfirmButton: false,
              timer: 1500,
            });
          }
          const res = JSON.parse(this.responseText);
          if (res.msg.includes("SQLSTATE[23000]")) {
            res.msg = "EL USUARIO DEBE SER UNICO";
          }

          Swal.fire({
            toast: true,
            position: "top-right",
            icon: res.type,
            title: res.msg,
            showConfirmButton: false,
            timer: 1500,
          });
          if (res.type == "success") {
            limpiarCampos();
            tblUsuarios.ajax.reload();
          }
        }
      };
    }}
    else if (!permisosPantalla.crear == false){
          
    if (usuario.value == "") {
      errorUsuario.textContent = "EL USUARIO ES REQUERIDO";
    } else if (nombres.value == "") {
      errorNombre.textContent = "EL NOMBRE ES REQUERIDO";
    } else if (apellido.value == "") {
      errorApellido.textContent = "EL APELLIDO ES REQUERIDO";
    } else if (correo.value == "") {
      errorCorreo.textContent = "EL CORREO ES REQUERIDO";
    } else if (identidad.value == "") {
      errorIdentidad.textContent = "LA IDENTIDAD ES REQUERIDO";
    } else if (direccion.value == "") {
      errorDireccion.textContent = "LA DIRECCION ES REQUERIDO";
    } else if (contraseña.value == "") {
      errorContraseña.textContent = "LA CONTRASEÑA ES REQUERIDO";
    } else if (rol.value == "") {
      errorRol.textContent = "EL ROL ES REQUERIDO";
    } else if (estado.value === "") {
      errorEstado.textContent = "EL ESTADO ES REQUERIDO";
    } else if (identidad.value.includes("0000000000000")) {
      Swal.fire({
        toast: true,
        position: "top-right",
        icon: "warning",
        title: "NO SE PERMITEN SOLO 0 EN LA IDENTIDAD",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      const url = base_url + "usuarios/registrar";
      //crear formData
      const data = new FormData(this);
      //hacer una instancia del objeto CMLHttoRequest
      const http = new XMLHttpRequest();
      //Abrir una Conexion - POST - GET
      http.open("POST", url, true);
      //Enviar Datos
      http.send(data);
      //Verificar estados
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          if (
            this.responseText.includes(
              '"msg":"USUARIO REGISTRADO","type":"success"'
            )
          ) {
            Swal.fire({
              toast: true,
              position: "top-right",
              icon: "success",
              title: "USUARIO REGISTRADO",
              showConfirmButton: false,
              timer: 1500,
            });
          }
          const res = JSON.parse(this.responseText);
          if (res.msg.includes("SQLSTATE[23000]")) {
            res.msg = "EL USUARIO DEBE SER UNICO";
          }

          Swal.fire({
            toast: true,
            position: "top-right",
            icon: res.type,
            title: res.msg,
            showConfirmButton: false,
            timer: 1500,
          });
          if (res.type == "success") {
            limpiarCampos();
            tblUsuarios.ajax.reload();
          }
        }
      };
    }

    } 


  });
});
//funcion para eliminar usuario
function eliminarUsuario(idUsuarioParam) {
  if (!permisosPantalla.eliminar) {
    Swal.fire({
      toast: true,
      position: "top-right",
      icon: "info",
      title: "NO TIENE PERMISO DE ELIMINAR",
      showConfirmButton: false,
      timer: 1500,
    }); 
  } else 
  if (idUsuarioParam === 1) {
    Swal.fire({
      icon: "warning",
      title: "Acción no permitida",
      text: "El usuario administrador no puede ser eliminado.",
      confirmButtonColor: "#3085d6",
    });
    return; // No se permite eliminar el usuario con ID 1
  }

  Swal.fire({
    title: "Estas seguro de inhabilitar este usuario?",
    text: "El registro no se eliminara de forma permanente, solo cambiara el estado!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Inhabilitar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let url = base_url + "usuarios/eliminar/" + idUsuarioParam;
      //hacer una instancia del objeto CMLHttoRequest
      const http = new XMLHttpRequest();
      //Abrir una Conexion - POST - GET
      http.open("GET", url, true);
      //Enviar Datos
      http.send();
      //Verificar estados
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire({
            toast: true,
            position: "top-right",
            icon: res.type,
            title: res.msg,
            showConfirmButton: false,
            timer: 2000,
          });
          if (res.type == "success") {
            tblUsuarios.ajax.reload();
            let data = {
              idUser: idUsuario,
              idObjeto: 1,
              accion: "DESACTIVAR",
              descripcion: "SE DESACTIVÓ AL USUARIO DEL ID " + idUsuarioParam,
            };
            url = base_url + "Bitacora/CrearEvento";
            axios.post(url, data).then((res) => {
              console.log(res);
            });
          }
        }
      };
    }
  });
}
// funcion para recuperar los datos del usuario
function editarUsuario(idUsuario) {
  if (!permisosPantalla.actualizar) {
    Swal.fire({
      toast: true,
      position: "top-right",
      icon: "info",
      title: "NO TIENE PERMISO DE ACTUALIZAR",
      showConfirmButton: false,
      timer: 1500,
    }); 
  } else{
  
  const url = base_url + "usuarios/editar/" + idUsuario;
  //hacer una instancia del objeto CMLHttoRequest
  const http = new XMLHttpRequest();
  //Abrir una Conexion - POST - GET
  http.open("GET", url, true);
  //Enviar Datos
  http.send();
  //Verificar estados
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      id.value = res.ID_USUARIO;
      usuario.value = res.USUARIO;
      nombres.value = res.NOMBRE_USUARIO;
      apellido.value = res.APELLIDO_USUARIO;
      correo.value = res.CORREO_ELECTRONICO;
      identidad.value = res.NUM_IDENTIDAD;
      direccion.value = res.DIRECCION_1;
      estado.value = res.ESTADO_USUARIO;
      vencimiento.value = res.FECHA_VENCIMIENTO;
      rol.value = res.id;
      if (estado.value == 1) {
        estado.disabled = true;
        tipo.value = 1;
      } else {
        estado.disabled = false;
        tipo.value = 2;
      }
      contraseña.value = "0000000";
      usuario.setAttribute("readonly", "readonly");
      contraseña.setAttribute("readonly", "readonly");
      btnAccion.textContent = "Actualizar";
      const firstTabEl = document.querySelector("#nav-tab button:last-child");
      const firstTab = new bootstrap.Tab(firstTabEl);
      firstTab.show();
    }
  };
  }
  //sino = 1
  //const permi = 1
}
function limpiarCampos() {
  id.value = "";
  btnAccion.textContent = "Registrar";
  contraseña.removeAttribute("readonly");
  formulario.reset();
  tipo.value = 1;
  nombres.focus();
  usuario.removeAttribute("readonly");
  estado.disabled = true;
}
