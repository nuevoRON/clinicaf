//Datos generales del Sexo
const formulario = document.querySelector("#formulario");
const nombre = document.querySelector("#reconocimiento");
const id = document.querySelector("#id");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoConsulta, {
      consulta: 1,
      modulo: 12,
    })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });


  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListarReconocimiento = "http://localhost/clinicaf/Reconocimiento/listarReconocimientos";

  axios
    .get(urlListarReconocimiento)
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      let datos = response.data;

      $('#tabla_reconocimiento').DataTable({
        language: {
          "decimal": ",",
          "thousands": ".",
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "No data available in table" : "No hay datos disponibles",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
          },
          "sProcessing":"Cargando..."
      },
        data: datos,
        paging: true,
        columns: [
            { data: 'id_reconocimiento' },
            { data: 'nom_reconocimiento' },
            {
                render: function(data, type, row) {
                    // Agregar botones "Editar" y "Eliminar"
                    return `<button class="btn btn-success">
                    <i class="fas fa-sync-alt"></i></button>`;
                }
            },
            {
                render: function(data, type, row) {
                    // Agregar botones "Editar" y "Eliminar"
                    return `<button class="btn btn-warning">
                    <i class="fas fa-trash-alt"></i></button>`;
                }
            }, 
        ],
          createdRow: function(row, data, dataIndex) {
            // Agregar un evento onclick a los botones "Editar"
            $(row).find('.btn-success','btn').click(function() {
                editarReconocimientos(data.id_reconocimiento);
            });
  
            $(row).find('.btn-warning').click(function() {
              eliminarReconocimientos(data.id_reconocimiento);
          });
        },
  
      });

    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


//Funciones del formulario para agregar o actualizar un registro
formulario.addEventListener('submit', function(e) {
    console.log(nombre)
    e.preventDefault(); 

    if (nombre.value == "") {
        console.log('No puede enviar el formulario vacio')
    } else {
      //Rutas a las funciones para crear y actualizar registros
      const urlInsertar = "http://localhost/clinicaf/reconocimiento/insertarReconocimientos";
      const urlActualizar = "http://localhost/clinicaf/reconocimiento/actualizarReconocimientos";
      const data = new FormData(this);
    
      // Verificar si el campo 'id' está presente en los datos del formulario
      const id = data.get('id');
      
      //Se valida por medio de un operador ternario si se recibe un id del formulario
      //Si existe un dato de id se usa urlActualizar, sino se usa urlInsertar
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
          }).then((result) => {
            if (this.responseText.includes('"type":"success"')) {
              location.reload();
            }
        });

          
        }
      };
    }
  });
});


//funcion para eliminar usuario
function eliminarReconocimientos(idreconocimiento) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoEliminacion, {
      consulta: 4,
      modulo: 12,
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
          title: "¿Estas seguro de eliminar este reconocimiento?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/Reconocimiento/eliminarReconocimientos/" + idreconocimiento;
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
                  icon: res.type
                });
              }
            };
          }
        });
      }
    })  
 
}


// funcion para recuperar los datos del sexo
function editarReconocimientos(idreconocimiento) {
  let permisoActualizacion =
  "http://localhost/clinicaf/permisos/validarPermisos";

axios
  .post(permisoActualizacion, {
    consulta: 3,
    modulo: 12,
  })
  .then(function (response) {
    console.log(response.data);
    if (response.data.actualizacion == 0 || response.data == false) {
      Swal.fire({
        title: "Error",
        text: "No cuenta con los permisos para actualizar datos",
        icon: "error",
      });
    } else {
      const url = "http://localhost/clinicaf/Reconocimiento/obtenerReconocimientos/" + idreconocimiento;
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
          id.value = res.id_reconocimiento;
          nombre.value = res.nom_reconocimiento;
          document.getElementById('modal-title').textContent = "Editar Reconocimiento"
    
          $('#ModalReconocimiento').modal('show'); 
          
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
    modulo: 11
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

      document.getElementById('modal-title').textContent = "Agregar Nuevo Reconocimiento"
      $("#ModalReconocimiento").modal("show");
    }
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });
}

document.getElementById("btnModalReconocimiento").addEventListener("click", mostrarModal);