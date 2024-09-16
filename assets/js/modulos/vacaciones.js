const formulario = document.querySelector("#formulario");

const selectEmpleado = document.querySelector("#num_empleado");
const selectReconocimiento = document.querySelector("#item_recon_reg");
const selectMedico = document.querySelector("#medico");
const selectDepartamento = document.querySelector("#item_departamento_reg");
const selectMunicipio = document.querySelector("#item_municipio_reg");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoConsulta, {
      consulta: 1,
      modulo: 10,
    })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });

  //Cargar empleados
  let url = "http://localhost/clinicaf/vacaciones/getEmpleados";
  axios
    .get(url)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.num_empleado;
        option.value = opcion.id_usu;
        selectEmpleado.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


    //Cargar municipios
    selectEmpleado.addEventListener("change", function() {
      console.log('funciona')
      let idEmpleado= selectEmpleado.options[selectEmpleado.selectedIndex].value
      let urlNombreEmpleado = "http://localhost/clinicaf/vacaciones/getNombreEmpleado/"+ idEmpleado;

      axios
      .get(urlNombreEmpleado)
      .then(function (response) {
        // Llenar Select
        console.log(response);
        document.getElementById('nombre_empleado').value = response.data.nombre_completo;
        
      })
      .catch(function (error) {
        // Maneja errores
        console.error("Ocurrió un error:", error);
      });
  
  });

    /* Mostrar Tabla */
  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListarVacaciones = "http://localhost/clinicaf/vacaciones/listarVacaciones";

  axios
    .get(urlListarVacaciones)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      //los datos a mostrar en la tabla se encuentran en response.data
      //se define una variable que pueda ser usada dentro del datatable
      let datos = response.data;

      //se inicializa el datatable usando el id de la tabla
      $('#tabla_vacaciones').DataTable({
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
        //se usa la variable definida arriba con los datos
        data: datos,
        paging: true,
        //las colunmas deben contener los datos recibidos desde la base de datos en la misma cantidad y orden de campos
        columns: [
            { data: 'id_vacaciones' },
            { data: 'num_empleado' },
            { data: 'nombre_completo' },
            { data: 'nom_estado' },
            { data: 'fecha_inicio' },
            { data: 'fecha_final' },
            { data: 'dias_vacaciones' },
            { data: 'observaciones' },
            //estas dos columnas contienen los botones para editar y eliminar
            //de ser necesario se pueden agregar más columnas con otros botones
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
        //estas dos funciones contienen las referencias a las funciones que realizan edicion y eliminacion
        //se usa una funcion find para encontrar un boton en especifico usando su clase y asi asignarle 
        //la función javascript que le corresponde
          createdRow: function(row, data, dataIndex) {
            // Agregar un evento onclick a los botones "Editar"
            $(row).find('.btn-success','btn').click(function() {
              editarVacacion(data.id_vacaciones);
            });
  
            $(row).find('.btn-warning').click(function() {
              eliminarVacacion(data.id_vacaciones);
          });
        },
  
      });

    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


  formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario

      const urlInsertar = "http://localhost/clinicaf/vacaciones/insertarVacaciones";
      const urlActualizar = "http://localhost/clinicaf/vacaciones/actualizarVacaciones";
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
function eliminarVacacion(id) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoEliminacion, {
      consulta: 4,
      modulo: 10,
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
          title: "¿Estas seguro de eliminar estas vacaciones?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/vacaciones/eliminarVacaciones/" + id;
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



// funcion para recuperar los datos 
function editarVacacion(id) {
  let permisoActualizacion =
  "http://localhost/clinicaf/permisos/validarPermisos";

axios
  .post(permisoActualizacion, {
    consulta: 3,
    modulo: 10,
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
      const url = "http://localhost/clinicaf/vacaciones/editarVacacion/" + id;
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
          document.getElementById('id').value = id;
    
          document.getElementById('nombre_empleado').value = res.nombre_completo;
          document.getElementById('fecha_inicio').value = res.fecha_inicio;
          document.getElementById('fecha_final').value = res.fecha_final;
          document.getElementById('observaciones').value = res.observaciones;
          document.getElementById('modal-title').textContent = "Editar Vacaciones"
          
          $("#num_empleado").val(res.id_usu).trigger('change'); 
          $("#item_estado option[value=" + res.estado + "]").attr({selected: true,});
    
         //Se abre el modal usando su id
         $('#ModalVacacion').modal('show'); 
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
    modulo: 10
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
      document.getElementById('num_empleado').selectedIndex = 0;
      document.getElementById('item_estado').selectedIndex = '';

      document.getElementById('modal-title').textContent = "Agregar Vacaciones"
      document.getElementById('id').value = '';
      $("#ModalVacacion").modal("show");
    }
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });
}

document.getElementById("btnModalVacacion").addEventListener("click", mostrarModal);


function exportarPDF() {
  let urlDescarga = "http://localhost/clinicaf/exportacionPDF/exportarVacaciones";
    
  window.location.href = urlDescarga;
}


function exportarExcel() {
  let urlDescarga = "http://localhost/clinicaf/exportacionExcel/exportarVacaciones";
    
  window.location.href = urlDescarga;
}