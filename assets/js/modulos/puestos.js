let tblPuesto;
const formulario = document.querySelector("#formulario");
const nombres = document.querySelector("#nombres");
const descripcion = document.querySelector("#descripcion");
const salario = document.querySelector("#salario");
const id = document.querySelector("#id");

//elementos para mostrar errores
const errorNombre = document.querySelector("#errorNombre");
const errorDescripcion = document.querySelector("#errorDescripcion");
const errorSalario = document.querySelector("#errorSalario");

const btnAccion = document.querySelector("#btnAccion");
const btnNuevo = document.querySelector("#btnNuevo");

document.addEventListener("DOMContentLoaded", function () {
  //Exportación PDF
const buttons = [
  //Botón para PDF
  {
    text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
    action: function () {
      window.location.href = '../views/pdf/pdfPuestos.php';
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
  permisosPantalla = obtenerPermisos("Puestos", permisosUsuario);

  if (!permisosPantalla.consultar) {
    window.location.replace(base_url + "admin");
  }
  //final permisos & roles
  
  //cargar datos con el plugin datatable
  tblPuesto = $("#tblPuesto").DataTable({
    ajax: {
      url: base_url + "puestos/listarPuestos",
      dataSrc: "",
    },
    columns: [
      { data: "NOMBRE" },
      { data: "DESCRIPCION" },
      { data: "SALARIO" },
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
    idObjeto: 26,
    accion: "INGRESO",
    descripcion: "SE INGRESÓ A LA PANTALLA DE PUESTOS",
  };
  url = base_url + "Bitacora/CrearEvento";
  axios.post(url, data).then((res) => {console.log(res)});

  //limpiar campos
  btnNuevo.addEventListener("click", function () {
    limpiarCampos();
  });

  //registar usuarios
  formulario.addEventListener("submit", function (e) {
    e.preventDefault();

    errorNombre.textContent = "";
    errorDescripcion.textContent = "";
    errorSalario.textContent = "";
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
    } else
    if (nombres.value == "") {
      errorNombre.textContent = "EL NOMBRE ES REQUERIDO";
    } else if (descripcion.value == "") {
      errorDescripcion.textContent = "LA DESCRIPCIÓN ES REQUERIDA";
    }else if (salario.value < 0) {
      errorSalario.textContent = "EL SALARIO NO PUEDE SER NEGATIVO";
    } else {
      const url = base_url + "puestos/registrarPuesto";
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
              '"msg":"PUESTO REGISTRADO","type":"success"'
            )
          ) {
            Swal.fire({
              toast: true,
              position: "top-right",
              icon: "success",
              title: "PUESTO REGISTRADO",
              showConfirmButton: false,
              timer: 1500,
            });
          }
          const res = JSON.parse(this.responseText);
          if (res.msg.includes("SQLSTATE[23000]")) {
            res.msg = "EL PUESTO DEBE SER UNICO";
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
function eliminarPuesto(idPuesto) {
  
  Swal.fire({
    title: "Estas seguro de eliminar este puesto?",
    text: "Esta acción no se puede revertir!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let url = base_url + "puestos/eliminarPuesto/" + idPuesto;
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
            tblPuesto.ajax.reload();
            let data = {
                idUser: idUsuario,
                idObjeto: 1,
                accion: "ELIMINACION",
                descripcion: "SE ELIMINO UN PUESTO ",
              };
            url = base_url + "Bitacora/CrearEvento";
            axios.post(url, data).then((res) => {console.log(res)});
          }
        }
      };
    }
  });
}


// funcion para recuperar los datos del usuario
function editarPuesto(idPuesto) {

  const url = base_url + "puestos/editarPuesto/" + idPuesto;
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
      id.value = res.ID_PUESTO;
      nombres.value = res.NOMBRE;
      descripcion.value = res.DESCRIPCION;
      salario.value = res.SALARIO;
      btnAccion.textContent = "Actualizar";
      const firstTabEl = document.querySelector("#nav-tab button:last-child");
      const firstTab = new bootstrap.Tab(firstTabEl);
      firstTab.show();
    }
  };
}


function limpiarCampos() {
  id.value = "";
  btnAccion.textContent = "Registrar";
  formulario.reset();
  nombres.focus();
  descripcion.focus(); 
  setTimeout(function() {
    location.reload();
  }, 1000);
}
