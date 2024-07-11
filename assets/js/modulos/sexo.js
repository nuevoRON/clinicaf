let tblSexo;
const formulario = document.querySelector("#formulario");
const nombres = document.querySelector("#nombres");
const id = document.querySelector("#id");

//elementos para mostrar errores
const errorNombre = document.querySelector("#errorNombre");

const btnAccion = document.querySelector("#btnAccion");
const btnNuevo = document.querySelector("#btnNuevo");

document.addEventListener("DOMContentLoaded", function () {
  //Exportación PDF
const buttons = [
  //Botón para PDF
  {
    text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
    action: function () {
      window.location.href = '../views/pdf/pdfSexo.php';
    }
  },

  //Botón para print
  {
    extend: "print",
    footer: true,
    text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',

  },
];


  //inicio permisos & roles
  permisosPantalla = obtenerPermisos("Sexo", permisosUsuario);

  if (!permisosPantalla.consultar) {
    window.location.replace(base_url + "admin");
  }
  //cargar datos con el plugin datatable
  tblSexo = $("#tblSexo").DataTable({
    ajax: {
      url: base_url + "sexo/listarSexos",
      dataSrc: "",
    },
    columns: [{ data: "NOMBRE" }, { data: "acciones" }],
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
    idObjeto: 16,
    accion: "INGRESO",
    descripcion: "SE INGRESÓ A LA PANTALLA DE SEXOS",
  };
  url = base_url + "Bitacora/CrearEvento";
  axios.post(url, data).then((res) => {
    console.log(res);
  });

  //limpiar campos
  btnNuevo.addEventListener("click", function () {
    limpiarCampos();
  });

  //registar usuarios
  formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    errorNombre.textContent = "";
    //icio de permisos && roles✅
    if (!permisosPantalla.crear) {
      Swal.fire({
        toast: true,
        position: "top-right",
        icon: "info",
        title: "NO TIENE PERMISO DE CREAR",
        showConfirmButton: false,
        timer: 1500,
      });
    } else if (nombres.value == "") {
      errorNombre.textContent = "EL NOMBRE ES REQUERIDO";
    } else {
      const url = base_url + "sexo/registrarSexo";
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
              '"msg":"GENERO REGISTRADO","type":"success"'
            )
          ) {
            Swal.fire({
              toast: true,
              position: "top-right",
              icon: "success",
              title: "GENERO REGISTRADO",
              showConfirmButton: false,
              timer: 1500,
            });
          }
          const res = JSON.parse(this.responseText);
          if (res.msg.includes("SQLSTATE[23000]")) {
            res.msg = "EL GENERO DEBE SER UNICO";
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
          }
        }
      };
    }
  });
});
//funcion para eliminar usuario
function eliminarSexo(idSexo) {
  //icio de permisos && roles✅
  if (!permisosPantalla.eliminar) {
    Swal.fire({
      toast: true,
      position: "top-right",
      icon: "info",
      title: "NO TIENE PERMISO DE ELIMINAR",
      showConfirmButton: false,
      timer: 1500,
    });
  } else {
    Swal.fire({
      title: "Estas seguro de eliminar el género seleccionado?",
      text: "Esta acción no se puede revertir",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let url = base_url + "sexo/eliminarSexo/" + idSexo;
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
              tblSexo.ajax.reload();
              let data = {
                idUser: idUsuario,
                idObjeto: 1,
                accion: "ELIMINAR",
                descripcion: "SE ELIMINÓ AL GENERO CON ID " + idUsuarioParam,
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
}

// funcion para recuperar los datos del usuario
function editarSexo(idSexo) {
  //icio de permisos && roles✅
  if (!permisosPantalla.actualizar) {
    Swal.fire({
      toast: true,
      position: "top-right",
      icon: "info",
      title: "NO TIENE PERMISO DE ACTUALIZAR",
      showConfirmButton: false,
      timer: 1500,
    });
  } else {
    const url = base_url + "sexo/editarSexo/" + idSexo;
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
        id.value = res.ID_SEXO;
        nombres.value = res.NOMBRE;
        btnAccion.textContent = "Actualizar";
        const firstTabEl = document.querySelector("#nav-tab button:last-child");
        const firstTab = new bootstrap.Tab(firstTabEl);
        firstTab.show();
      }
    };
  }
}

function limpiarCampos() {
  id.value = "";
  btnAccion.textContent = "Registrar";
  setTimeout(function () {
    location.reload();
  }, 1000);
}
