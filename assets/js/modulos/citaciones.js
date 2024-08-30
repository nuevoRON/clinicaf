//Datos generales del Proveido
const formulario = document.querySelector("#formulario");

const selectCasos = document.querySelector("#num_caso");
const selectMedico = document.querySelector("#medico");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoConsulta, {
    consulta: 1,
    modulo: 5
  })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });

  //Inicializar Select2 para select de casos
  /* $(document).ready(function() {
    $('#num_caso').select2({
      language:"SpanishTranslation"
    });
  });  */

  //Cargar casos
  let url = "http://localhost/clinicaf/citaciones/getNumerosCasos";
  axios
    .get(url)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.num_caso;
        option.value = opcion.id_proveidos;
        selectCasos.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


  //Cargar médicos
  let urlMedico = "http://localhost/clinicaf/usuarios/getMedicos";
  axios
    .get(urlMedico)
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



/* Mostrar Tabla */
//Se extraen los datos de la base de datos para llenar el datatable
  let urlListarCitaciones = "http://localhost/clinicaf/citaciones/getCitaciones";

  axios
    .get(urlListarCitaciones)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      //los datos a mostrar en la tabla se encuentran en response.data
      //se define una variable que pueda ser usada dentro del datatable
      let datos = response.data;

      //se inicializa el datatable usando el id de la tabla
      $('#tabla_citaciones').DataTable({
        language: {
          "decimal": ",",
          "thousands": ".",
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "No data available in table": "No hay datos disponibles",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "sProcessing": "Cargando..."
        },
        data: datos, // datos desde el backend o variable predefinida
        paging: true,
        columns: [
          { data: 'id_citacion' },
          { data: 'num_caso' },
          { data: 'tipo_citacion' },
          { data: 'fecha_recep_citacion' },
          { data: 'fecha_citacion' },
          { data: 'nombre' },
          { data: 'apellido' },
          { data: 'lugar_citacion' },
          {
            render: function(data, type, row) {
              return `<button class="btn btn-success"><i class="fas fa-sync-alt"></i></button>`;
            }
          },
          {
            render: function(data, type, row) {
              return `<button class="btn btn-warning"><i class="fas fa-trash-alt"></i></button>`;
            }
          }
        ],
        createdRow: function(row, data, dataIndex) {
          // Agregar eventos a los botones en cada fila
          $(row).find('.btn-success').click(function() {
            editarCitacion(data.id_citacion);
          });
    
          $(row).find('.btn-warning').click(function() {
            eliminarCitacion(data.id_citacion);
          });
        }
      });
      

    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });



 formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario

      const urlInsertar = "http://localhost/clinicaf/citaciones/insertarCitacion";
      const urlActualizar = "http://localhost/clinicaf/citaciones/actualizarCitacion";
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
          }).then((result) => {
            if (this.responseText.includes('"type":"success"')) {
              location.reload();
            }
        });
    
        }
      };
  }); 

});


/*Eliminar registros*/
//esta funcion recibe el id del registro para realizar la eliminación
function eliminarCitacion(idCitacion) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoEliminacion, {
    consulta: 4,
    modulo: 5
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
          title: "¿Estas seguro de eliminar esta citación?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/citaciones/eliminarCitacion/" + idCitacion;
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



// funcion para recuperar los datos del proveido
function editarCitacion(idCitacion) {
  let permisoActualizacion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoActualizacion, {
    consulta: 3,
    modulo: 5
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
        const url = "http://localhost/clinicaf/citaciones/obtenerCitacion/" + idCitacion;
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
            document.getElementById('id').value = idCitacion;
            
            document.getElementById('fecha_rec_citacion').value = res.fecha_recep_citacion;
            document.getElementById('fecha_citacion').value = res.fecha_citacion;
            document.getElementById('lugar_citacion').value = res.lugar_citacion;
            document.getElementById('modal-title').textContent = "Editar Citación"
      
            $("#num_caso option[value=" + res.numero_caso + "]").attr({selected: true,});
            $("#tipo_citacion option[value=" + res.tipo_citacion + "]").attr({selected: true,});
            $("#medico option[value=" + res.medico + "]").attr({selected: true,});
      
           //Se abre el modal usando su id
           $('#ModalCitacion').modal('show'); 
          }
        }
      }
    })
}


/* Funcion que valida si el puesto al que pertenece el usuario conectado cuenta con
permisos para insertar datos */
function mostrarModal(){
  let permisoInsercion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoInsercion, {
    consulta: 2,
    modulo: 5
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
      document.getElementById('num_caso').selectedIndex = 0;
      document.getElementById('tipo_citacion').selectedIndex = 0;
      document.getElementById('medico').selectedIndex = 0;

      document.getElementById('modal-title').textContent = "Agregar Citación"
      $("#ModalCitacion").modal("show");
    }
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });
}

document.getElementById("btnModalCitacion").addEventListener("click", mostrarModal);