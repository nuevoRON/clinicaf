/* let tblUsuarios; */

//Datos generales del Proveido
const formulario = document.querySelector("#formulario");
const numeroSolicitud = document.querySelector("#numero_solicitud_reg");
const numeroExterno = document.querySelector("#numero_externo_reg");
const fechaEmision = document.querySelector("#fecha_emision");
const fechaRecepcion = document.querySelector("#fecha_recepcion");
const fiscalia = document.querySelector("#item_dependencia_reg");

const selectDependencias = document.querySelector("#item_dependencia_reg");
const selectReconocimiento = document.querySelector("#item_recon_reg");
const selectMedico = document.querySelector("#item_estado_reg");
const selectDepartamento = document.querySelector("#item_departamento_reg");
const selectMunicipio = document.querySelector("#item_municipio_reg");

//elementos para mostrar errores
/* const errorUsuario = document.querySelector("#errorUsuario");
const errorNombre = document.querySelector("#errorNombre");
const errorApellido = document.querySelector("#errorApellido");
const errorCorreo = document.querySelector("#errorCorreo");
const errorIdentidad = document.querySelector("#errorIdentidad");
const errorDireccion = document.querySelector("#errorDireccion");
const errorContraseña = document.querySelector("#errorContraseña");
const errorRol = document.querySelector("#errorRol");
const errorEstado = document.querySelector("#errorEstado"); */

/* const btnAccion = document.querySelector("#btnAccion"); */
/* const btnNuevo = document.querySelector("#btnNuevo"); */
/* const sino = 1; const permi = 0 */


document.addEventListener("DOMContentLoaded", function () {
  //permisosPantalla = obtenerPermisos("Usuarios", permisosUsuario);

  /* if (!permisosPantalla.consultar) {
    window.location.replace(base_url + "admin");
  } */
  // cargar roles del usuario
 /* console.log(permisosUsuario);
  let permisosPantalla = obtenerPermisos("Usuarios", permisosUsuario);

  console.log(permisosPantalla);
  if (!permisosPantalla.consultar) {
    window.location.replace(base_url + "admin");
  }*/

  //Cargar médicos
  let url = "http://localhost/clinicaf/usuarios/getMedicos";
  axios
    .get(url)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.medicos.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = `${opcion.nombre} ${opcion.apellido}`;
        option.value = opcion.id_usu;
        selectMedico.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


  //Cargar reconocimientos
  let urlReconocimiento = "http://localhost/clinicaf/reconocimientos/getReconocimientos";
  axios
    .get(urlReconocimiento)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.reconocimientos.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.nom_reconocimiento;
        option.value = opcion.id_reconocimiento;
        selectReconocimiento.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


  //Cargar dependencias
  let urlDependencias = "http://localhost/clinicaf/dependencias/getDependencias";
  axios
    .get(urlDependencias)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.dependencias.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.nom_dependencia;
        option.value = opcion.id_dependencia;
        selectDependencias.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


  //Cargar departamentos
  let urlDepartamento = "http://localhost/clinicaf/dependencias/getDepartamentos";
  axios
    .get(urlDepartamento)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.departamentos.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.nombre_departamento;
        option.value = opcion.id_departamento;
        selectDepartamento.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


    //Cargar municipios
    selectDepartamento.addEventListener("change", function() {
      let idDepartamento= selectDepartamento.options[selectDepartamento.selectedIndex].value
      let urlMunicipio = "http://localhost/clinicaf/dependencias/getMunicipios/"+ idDepartamento;
  
      // Eliminar opciones existentes del select de municipios
      while (selectMunicipio.firstChild) {
          selectMunicipio.removeChild(selectMunicipio.firstChild);
      }

      axios
      .get(urlMunicipio)
      .then(function (response) {
        // Llenar Select
        console.log(response);
        response.data.forEach((opcion) => {
          let option = document.createElement("option");

          option.text = opcion.nombre_municipio;
          option.value = opcion.id_municipio;
          selectMunicipio.appendChild(option);
        });
      })
      .catch(function (error) {
        // Maneja errores
        console.error("Ocurrió un error:", error);
      });
  
  });


  formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario

    if (numeroSolicitud.value == "" || numeroExterno.value == "" || fechaEmision.value == ""
      || fechaRecepcion.value == "" || fiscalia.value == "") {
        console.log('No puede enviar el formulario vacio')
    } else {
      const urlInsertar = "http://localhost/clinicaf/proveidos/insertarProveido";
      const urlActualizar = "http://localhost/clinicaf/proveidos/actualizarProveido";
      const data = new FormData(this);
    
      // Verificar si el campo 'id' está presente en los datos del formulario
      const id = data.get('id'); // Asume que el campo 'id' tiene el nombre 'id'
      
      const url = id ? urlActualizar : urlInsertar;
      const method = id ? "PUT" : "POST";
    
      const http = new XMLHttpRequest();
      http.open(method, url, true);
      
      // Si se usa PUT, hay que enviar los datos como JSON
      if (method === "PUT") {
          // Convertir FormData a JSON
          const object = {};
          data.forEach((value, key) => { object[key] = value });
          const jsonData = JSON.stringify(object);
          http.setRequestHeader("Content-Type", "application/json");
          http.send(jsonData);
      } else {
          // Para POST, se envía directamente el FormData
          http.send(data);
      }
    
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);

          Swal.fire({
            title: res.titulo,
            text: res.desc,
            icon: res.type
          });

          if (this.responseText.includes('"type":"success"')) {
            console.log('si se insertó')
          }
    
        }
      };
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
