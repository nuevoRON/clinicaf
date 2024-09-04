const formulario = document.querySelector("#formulario");

const selectJornada = document.querySelector("#jornada");
const selectEstado = document.querySelector("#item_estado");
const selectPuestos = document.querySelector("#puesto");
const selectSede = document.querySelector("#sede");
const selectClinica = document.querySelector("#clinica");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoConsulta, {
      consulta: 1,
      modulo: 9,
    })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });



    function cargarOpcionesSelect(url, selectElement, optionText, optionValue) {
      axios
        .get(url)
        .then(function (response) {
          // Recorrer los datos y agregar las opciones al select
          response.data.forEach((opcion) => {
            let option = document.createElement("option");
    
            option.text = opcion[optionText];
            option.value = opcion[optionValue]; 
            selectElement.appendChild(option);
          });
        })
        .catch(function (error) {
          // Manejar errores
          console.error("Ocurrió un error:", error);
        });
    }

  cargarOpcionesSelect("http://localhost/clinicaf/personal/getJornadas",selectJornada, "nom_jornada", "id_jornada");
  cargarOpcionesSelect("http://localhost/clinicaf/personal/getEstados",selectEstado, "nom_estado", "id_estado");
  cargarOpcionesSelect("http://localhost/clinicaf/personal/getPuestos",selectPuestos, "nom_puesto", "id_puesto");
  cargarOpcionesSelect("http://localhost/clinicaf/sedes/listarSedes",selectSede, "ubicacion", "id_sede");
  cargarOpcionesSelect("http://localhost/clinicaf/personal/getClinicas",selectClinica, "nombre", "id_clinica");
})


  /* Mostrar Tabla */
  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListarEmpleados = "http://localhost/clinicaf/personal/listarEmpleados";

  axios
    .get(urlListarEmpleados)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //los datos a mostrar en la tabla se encuentran en response.data
      //se define una variable que pueda ser usada dentro del datatable
      let datos = response.data;

      //se inicializa el datatable usando el id de la tabla
      $('#tabla_empleados').DataTable({
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
            { data: 'nombre_completo' },
            { data: 'num_colegiacion' },
            { data: 'num_empleado' },
            { data: 'correo' },
            { data: 'telefono' },
            { data: 'nom_jornada' },
            { data: 'nom_estado' },
            { data: 'nom_puesto' },
            { data: 'ubicacion' },
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
            {
              render: function(data, type, row) {
                  return `<button class="btn btn-primary">
                  <i class="fas fa-user-lock"></i></button>`;
                }
            },  
        ],
        //estas dos funciones contienen las referencias a las funciones que realizan edicion y eliminacion
        //se usa una funcion find para encontrar un boton en especifico usando su clase y asi asignarle 
        //la función javascript que le corresponde
          createdRow: function(row, data, dataIndex) {
            // Agregar un evento onclick a los botones "Editar"
            $(row).find('.btn-success','btn').click(function() {
              editarEmpleado(data.id_usu);
            });
  
            $(row).find('.btn-warning').click(function() {
              eliminarEmpleado(data.id_usu);
            });

            $(row).find('.btn-primary').click(function() {
              resetearClaveUsuario(data.id_usu);
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

      const urlInsertar = "http://localhost/clinicaf/personal/insertarPersonal";
      const urlActualizar = "http://localhost/clinicaf/personal/actualizarPersonal";
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



/*Eliminar registros*/
//esta funcion recibe el id del registro para realizar la eliminación
function eliminarEmpleado(id) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoEliminacion, {
      consulta: 4,
      modulo: 9,
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
          title: "¿Estas seguro de eliminar este empleado?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/personal/eliminarEmpleado/" + id;
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



// funcion para recuperar los datos del empleado
function editarEmpleado(idEmpleado) {
  let permisoActualizacion =
    "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoActualizacion, {
      consulta: 3,
      modulo: 9,
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
        document.getElementById('clinica').selectedIndex = -1;

        const url = "http://localhost/clinicaf/personal/obtenerEmpleado/" + idEmpleado;
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
            document.getElementById('id').value = idEmpleado;
            document.getElementById('nombre').value = res.nombre;
            document.getElementById('apellido').value = res.apellido;
            document.getElementById('numero_colegiacion').value = res.num_colegiacion;
            document.getElementById('numero_empleado').value = res.num_empleado;
            document.getElementById('email').value = res.correo;
            document.getElementById('usuario').value = res.usuario;
            document.getElementById('telefono').value = res.telefono;
             document.getElementById('modal-title').textContent = "Editar Información de Personal"
            
            $("#password").hide();
            $("#label-password").hide();
      
            document.getElementById('jornada').value = res.jornada;
            document.getElementById('item_estado').value = res.estado;
            document.getElementById('puesto').value = res.puesto;
            document.getElementById('sede').value = res.sede;
      
            if(res.laboratorio != null){
              document.getElementById('clinica').value = res.laboratorio;
            }
            
           //Se abre el modal usando su id
           $('#Modalmedico').modal('show'); 
          }
        }
      } 
    })
}


function resetearClaveUsuario(id) {
  let url = "http://localhost/clinicaf/personal/resetearClave/" + id;
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


/* Funcion que valida si el puesto al que pertenece el usuario conectado cuenta con
permisos para insertar datos */
function mostrarModal(){
  let permisoInsercion = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoInsercion, {
    consulta: 2,
    modulo: 9
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

      document.getElementById('modal-title').textContent = "Agregar Nuevo Personal"
      $("#Modalmedico").modal("show");
    }
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });
}

document.getElementById("btnModalPersonal").addEventListener("click", mostrarModal);