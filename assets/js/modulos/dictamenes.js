//Datos generales del Proveido
const formulario = document.querySelector("#formulario");

const selectCasos = document.querySelector("#num_caso");
const selectMedico = document.querySelector("#medico");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoConsulta, {
    consulta: 1,
    modulo: 6
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
  let urlListarDictamenes = "http://localhost/clinicaf/dictamenes/getDictamenes";

  axios
    .get(urlListarDictamenes)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      //los datos a mostrar en la tabla se encuentran en response.data
      //se define una variable que pueda ser usada dentro del datatable
      let datos = response.data;

      //se inicializa el datatable usando el id de la tabla
      $('#tabla-dictamenes').DataTable({
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
          { data: 'id_dictamen' },
          { data: 'num_caso' },
          { data: 'tipo_documento' },
          { data: 'nombre_completo' },
          { data: 'fecha_evaluacion' },
          { data: 'autoridad_solicitante' },
          { data: 'fecha_entrega' },
          { data: 'datos_extra' },
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
            editarDictamen(data.id_dictamen);
          });
    
          $(row).find('.btn-warning').click(function() {
            eliminarDictamen(data.id_dictamen);
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

      const urlInsertar = "http://localhost/clinicaf/dictamenes/insertarDictamen";
      const urlActualizar = "http://localhost/clinicaf/dictamenes/actualizarDictamen";
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
function eliminarDictamen(idDictamem) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoEliminacion, {
    consulta: 4,
    modulo: 6
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
          title: "¿Estas seguro de eliminar este dictamen?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/dictamenes/eliminarDictamen/" + idDictamem;
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



// funcion para recuperar los datos del registro
function editarDictamen(idDictamen) {
  let permisoActualizacion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoActualizacion, {
    consulta: 3,
    modulo: 6
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
        const url = "http://localhost/clinicaf/dictamenes/obtenerDictamen/" + idDictamen;
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
            document.getElementById('id').value = idDictamen;
            
            document.getElementById('fecha_evaluacion').value = res.fecha_evaluacion;
            document.getElementById('autoridad_soli').value = res.autoridad_solicitante;
            document.getElementById('fecha_entrega').value = res.fecha_entrega;
            document.getElementById('datos_extra').value = res.datos_extra;
            document.getElementById('modal-title').textContent = "Editar Dictamen"
            $("#num_caso option[value=" + res.numero_caso + "]").attr({selected: true,});
            $("#tipo_documento option[value='" + res.tipo_documento + "']").attr({selected: true,});
            $("#medico option[value=" + res.medico + "]").attr({selected: true,});
      
           //Se abre el modal usando su id
           $('#ModalDictamen').modal('show'); 
          }
        }
      }
    })
  
}