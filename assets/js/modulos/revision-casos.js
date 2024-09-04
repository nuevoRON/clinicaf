const formulario = document.querySelector("#formulario");

const selectMedico = document.querySelector("#medico");
const selectReconocimiento = document.querySelector("#tipo_reconocimiento");
const selectSede = document.querySelector("#sede_clinica");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoConsulta, {
    consulta: 1,
    modulo: 7
  })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });


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

  ///Cargar reconocimientos
  let urlReconocimiento =
    "http://localhost/clinicaf/reconocimiento/listarReconocimientos";
  axios
    .get(urlReconocimiento)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.forEach((opcion) => {
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
});

//Cargar sedes
let urlSede = "http://localhost/clinicaf/sedes/listarSedes";
axios
  .get(urlSede)
  .then(function (response) {
    // Llenar Select
    console.log(response);
    response.data.forEach((opcion) => {
      let option = document.createElement("option");

      option.text = opcion.ubicacion;
      option.value = opcion.id_sede;
      selectSede.appendChild(option);
    });
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });

/* Mostrar Tabla */
//Se extraen los datos de la base de datos para llenar el datatable
let urlListarRevisiones = "http://localhost/clinicaf/casos/listarRevisiones";

axios
  .get(urlListarRevisiones)
  //si no hay problemas con la consulta se reciben los datos y se construye la tabla
  .then(function (response) {
    //se muestran los datos obtenidos
    console.log(response.data);
    //los datos a mostrar en la tabla se encuentran en response.data
    //se define una variable que pueda ser usada dentro del datatable
    let datos = response.data;

    //se inicializa el datatable usando el id de la tabla
    $("#tabla_revisiones").DataTable({
      language: {
        decimal: ",",
        thousands: ".",
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron resultados",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        infoFiltered: "(filtrado de un total de _MAX_ registros)",
        sSearch: "Buscar:",
        "No data available in table": "No hay datos disponibles",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        sProcessing: "Cargando...",
      },
      //se usa la variable definida arriba con los datos
      data: datos,
      paging: true,
      //las colunmas deben contener los datos recibidos desde la base de datos en la misma cantidad y orden de campos
      columns: [
        { data: "id_revision" },
        { data: "nombre_completo" },
        { data: "enviado_para" },
        { data: "fecha_revision" },
        { data: "tipo_dictamen" },
        { data: "numero_dictamen" },
        { data: "nombre_evaluado" },
        { data: "fecha_evaluacion" },
        { data: "nom_reconocimiento" },
        { data: "obs_reconocimiento" },
        { data: "estado_dictamen" },
        { data: "obs_dictamen" },
        { data: "sede_medico" },
        { data: "ubicacion" },
        //estas dos columnas contienen los botones para editar y eliminar
        //de ser necesario se pueden agregar más columnas con otros botones
        {
          render: function (data, type, row) {
            // Agregar botones "Editar" y "Eliminar"
            return `<button class="btn btn-success">
                    <i class="fas fa-sync-alt"></i></button>`;
          },
        },
        {
          render: function (data, type, row) {
            // Agregar botones "Editar" y "Eliminar"
            return `<button class="btn btn-warning">
                    <i class="fas fa-trash-alt"></i></button>`;
          },
        },
      ],
      //estas dos funciones contienen las referencias a las funciones que realizan edicion y eliminacion
      //se usa una funcion find para encontrar un boton en especifico usando su clase y asi asignarle
      //la función javascript que le corresponde
      createdRow: function (row, data, dataIndex) {
        // Agregar un evento onclick a los botones "Editar"
        $(row)
          .find(".btn-success", "btn")
          .click(function () {
            editarRevision(data.id_revision);
          });

        $(row)
          .find(".btn-warning")
          .click(function () {
            eliminarRevision(data.id_revision);
          });
      },
    });
  })
  .catch(function (error) {
    // Maneja errores
    console.error("Ocurrió un error:", error);
  });

formulario.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevenir la acción por defecto del formulario

  const urlInsertar = "http://localhost/clinicaf/casos/insertarRevision";
  const urlActualizar = "http://localhost/clinicaf/casos/actualizarRevision";
  const data = new FormData(this);

  // Verificar si el campo 'id' está presente en los datos del formulario
  const id = data.get("id"); // Asume que el campo 'id' tiene el nombre 'id'

  const url = id ? urlActualizar : urlInsertar;
  const method = id ? "PUT" : "POST";

  const http = new XMLHttpRequest();
  http.open(method, url, true);

  // Si se usa PUT, hay que enviar los datos como JSON
  if (method === "PUT") {
    // Convertir FormData a JSON
    const object = {};
    data.forEach((value, key) => {
      object[key] = value;
    });
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
        icon: res.type,
      }).then((result) => {
        if (this.responseText.includes('"type":"success"')) {
          location.reload();
        }
      });
    }
  };
});

/*Eliminar registros*/
//esta funcion recibe el id del registro para realizar la eliminación
function eliminarRevision(id) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoEliminacion, {
    consulta: 4,
    modulo: 7
  })
    .then(function (response) {
      if (response.data.eliminacion == 0 || response.data == false) {
        Swal.fire({
          title: "Error",
          text: "No tiene los permisos para eliminar datos",
          icon: "error",
        });
      } else {
        Swal.fire({
          title: "¿Estas seguro de eliminar esta revisión?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/casos/eliminarRevision/" + id;
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
                  title: res.titulo,
                  text: res.desc,
                  icon: res.type,
                }).then((result) => {
                  if (this.responseText.includes('"type":"success"')) {
                    location.reload();
                  }
                });
              }
            };
          }
        });
      }
    })
 
}

// funcion para recuperar los datos de revision
function editarRevision(id) {
  let permisoActualizacion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoActualizacion, {
    consulta: 3,
    modulo: 7
  })
    .then(function (response) {
      console.log(response.data)
      if (response.data.actualizacion == 0 || response.data == false) {
        Swal.fire({
          title: "Error",
          text: "No cuenta con los permisos para actualizar datos",
          icon: "error",
        });
      } else {
        const url = "http://localhost/clinicaf/casos/obtenerRevision/" + id;
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
            document.getElementById("id").value = id;
      
            document.getElementById("fecha_revision").value = res.fecha_revision;
            document.getElementById("num_dictamen").value = res.numero_dictamen;
            document.getElementById("nombre_evaluado").value = res.nombre_evaluado;
            document.getElementById("fecha_realizacion").value = res.fecha_evaluacion;
            document.getElementById("observaciones_rec").value =
              res.obs_reconocimiento;
            document.getElementById("obs_dictamen").value = res.obs_dictamen;
            document.getElementById('modal-title').textContent = "Editar Caso"
      
            $("#medico option[value=" + res.medico + "]").attr({ selected: true });
            $("#enviado_para option[value='" + res.enviado_para + "']").attr({
              selected: true,
            });
            $("#tipo_dictamen option[value='" + res.tipo_dictamen + "']").attr({
              selected: true,
            });
            $(
              "#tipo_reconocimiento option[value=" + res.tipo_reconocimiento + "]"
            ).attr({ selected: true });
            $("#estado_dictamen option[value='" + res.estado_dictamen + "']").attr({
              selected: true,
            });
            $("#sede_medico option[value='" + res.sede_medico + "']").attr({
              selected: true,
            });
            $("#sede_clinica option[value=" + res.sede_clinica + "]").attr({
              selected: true,
            });
      
            //Se abre el modal usando su id
            $("#ModalCaso").modal("show");
          }
        };
      }
    })
  
}


/* Funcion que valida si el puesto al que pertenece el usuario conectado cuenta con
permisos para insertar datos */
function mostrarModal(){
  let permisoInsercion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoInsercion, {
    consulta: 2,
    modulo: 7
  })
  .then(function (response) {
    if (response.data.insercion == 0 || response.data == false) {
      Swal.fire({
        title: "Error",
        text: "No cuenta con los permisos para guardar datos",
        icon: "error",
      });
    } else {
      document.getElementById('formulario').reset();
      document.getElementById('enviado_para').selectedIndex = 0;
      document.getElementById('tipo_dictamen').selectedIndex = 0;
      document.getElementById('medico').selectedIndex = 0;
      document.getElementById('tipo_reconocimiento').selectedIndex = 0;
      document.getElementById('estado_dictamen').selectedIndex = 0;
      document.getElementById('sede_medico').selectedIndex = 0;
      document.getElementById('sede_clinica').selectedIndex = 0;

      document.getElementById('modal-title').textContent = "Agregar Caso"
      $("#ModalCaso").modal("show");
    }
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });
}

document.getElementById("btnModalCaso").addEventListener("click", mostrarModal);


function exportarPDF() {
  let urlDescarga = "http://localhost/clinicaf/exportacionPDF/exportarRevisionCasos";
    
  window.location.href = urlDescarga;
}


function exportarExcel() {
  let urlDescarga = "http://localhost/clinicaf/exportacionExcel/exportarRevisionCasos";
    
  window.location.href = urlDescarga;
}
