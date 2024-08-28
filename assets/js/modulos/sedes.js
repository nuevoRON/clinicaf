//Datos generales del Sexo
const formulario = document.querySelector("#formulario");
const selectDepartamento = document.querySelector("#departamento");
const selectMunicipio = document.querySelector("#municipio");

const ubicacion = document.querySelector("#ubicacion");
const id = document.querySelector("#id");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoConsulta, {
      consulta: 1,
      modulo: 8,
    })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });

  //Cargar departamentos
  //se llama a la funcion getDepartamentos para obtener los departamentos
  let urlDepartamento =
    "http://localhost/clinicaf/dependencias/getDepartamentos";
  axios
    .get(urlDepartamento)
    //si no hay problemas con la consulta se reciben los datos y se construyen las opciones del select
    .then(function (response) {
      // Llenar Select
      console.log(response);
      //se recorre el response con un forEach para ir creando las opciones
      response.data.departamentos.forEach((opcion) => {
        //se crea un elemento de la clase option
        let option = document.createElement("option");

        //dentro del option se agregan los datos de la base de datos
        //option.text muestra el nombre guardado en base de datos y option.value el id del registro en la base de datos
        option.text = opcion.nombre_departamento;
        option.value = opcion.id_departamento;

        //se usa la funcion appendChild para crear las opciones dentro del select
        //el select ya esta definido como variable en la parte de arriba
        selectDepartamento.appendChild(option);
      });
    })
    .catch(function (error) {
      //Se ejecuta un console.log en caso de que haya un error en la logica del controlador y modelo
      console.error("Ocurrió un error:", error);
    });

  //Cargar municipios
  //la funcion se ejecuta al momento de detectar que se selecciono una opción del select de departamentos
  selectDepartamento.addEventListener("change", function () {
    //se llama a la funcion getMunicipios para obtener los municipios
    //La variable idDepartamento obtiene el valor que se asignó con option.value en la funcion anterior
    let idDepartamento =
      selectDepartamento.options[selectDepartamento.selectedIndex].value;
    let urlMunicipio =
      "http://localhost/clinicaf/dependencias/getMunicipios/" + idDepartamento;

    // Eliminar opciones existentes del select de municipios
    /* Para manejar de forma dinamica el select de municipios cada vez que se selecciona un departamento
      el select de municipios se borra y se vuelve a recrear con los datos del nuevo departamento */
    while (selectMunicipio.firstChild) {
      selectMunicipio.removeChild(selectMunicipio.firstChild);
    }

    axios
      //si no hay problemas con la consulta se reciben los datos y se construyen las opciones del select
      .get(urlMunicipio)
      .then(function (response) {
        // Llenar Select
        console.log(response);
        //se recorre el response con un forEach para ir creando las opciones
        response.data.forEach((opcion) => {
          //se crea un elemento de la clase option
          let option = document.createElement("option");

          //dentro del option se agregan los datos de la base de datos
          //option.text muestra el nombre guardado en base de datos y option.value el id del registro en la base de datos
          option.text = opcion.nombre_municipio;
          option.value = opcion.id_municipio;

          //se usa la funcion appendChild para crear las opciones dentro del select
          //el select ya esta definido como variable en la parte de arriba
          selectMunicipio.appendChild(option);
        });
      })
      .catch(function (error) {
        //Se ejecuta un console.log en caso de que haya un error en la logica del controlador y modelo
        console.error("Ocurrió un error:", error);
      });
  });

  /* Mostrar Tabla */
  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListarSedes = "http://localhost/clinicaf/sedes/listarSedes";

  axios
    .get(urlListarSedes)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      //los datos a mostrar en la tabla se encuentran en response.data
      //se define una variable que pueda ser usada dentro del datatable
      let datos = response.data;

      //se inicializa el datatable usando el id de la tabla
      $("#tabla_sedes").DataTable({
        language: {
          decimal: ",",
          thousands: ".",
          lengthMenu: "Mostrar _MENU_ registros",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          infoEmpty:
            "Mostrando registros del 0 al 0 de un total de 0 registros",
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
          { data: "id_sede" },
          { data: "nombre_departamento" },
          { data: "nombre_municipio" },
          { data: "ubicacion" },
          { data: "cod_alfabetico" },
          { data: "cod_numerico" },
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
              editarSede(data.id_sede);
            });

          $(row)
            .find(".btn-warning")
            .click(function () {
              eliminarSede(data.id_sede);
            });
        },
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });

  /* Formulario para crear o actualizar un registro */
  formulario.addEventListener("submit", function (e) {
    console.log(ubicacion);
    e.preventDefault(); /*evita que se envie el formulario sin validar*/

    if (ubicacion.value == "") {
      console.log("No puede enviar el formulario vacio");
    } else {
      //Rutas a las funciones para crear y actualizar registros
      const urlInsertar = "http://localhost/clinicaf/sedes/insertarSede";
      const urlActualizar = "http://localhost/clinicaf/sedes/actualizarSede";
      const data = new FormData(this);

      // Verificar si el campo 'id' está presente en los datos del formulario
      const id = data.get("id");

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
    }
  });
});

/*Eliminar registros*/
//esta funcion recibe el id del registro para realizar la eliminación
function eliminarSede(idSede) {
  let permisoEliminacion = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoEliminacion, {
      consulta: 4,
      modulo: 8,
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
          title: "¿Estas seguro de eliminar esta sede?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
          cancelButtonText: "No",
        }).then((result) => {
          if (result.isConfirmed) {
            let url = "http://localhost/clinicaf/sedes/eliminarSede/" + idSede;
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
                });
              }
            };
          }
        });
      }
    });
}

/* Obtener datos de un registro para edición */
function editarSede(idSede) {
  let permisoActualizacion =
    "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoActualizacion, {
      consulta: 3,
      modulo: 7,
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
        const url = "http://localhost/clinicaf/sedes/obtenerSede/" + idSede;
        //hacer una instancia del objeto CMLHttoRequest
        const http = new XMLHttpRequest();
        //Abrir una Conexion - POST - GET
        http.open("GET", url, true);
        //Enviar Datos
        http.send();
        //Verificar estados
        http.onreadystatechange = function () {
          //si se obtienen los datos de la base de datos se deben ingresar en los inputs
          //usando los id para asignar los datos en los mismos
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            id.value = res.id_sede;
            ubicacion.value = res.ubicacion;
            document.getElementById("cod_alfabetico").value =
              res.cod_alfabetico;
            document.getElementById("cod_numerico").value = res.cod_numerico;

            $("#departamento option[value=" + res.fk_departamento + "]").attr({
              selected: true,
            });

            //Cargar municipios
            if (res.fk_departamento != 0) {
              const selectDepartamento =
                document.querySelector("#departamento");
              const selectMunicipio = document.querySelector("#municipio");

              //se llama a la funcion getMunicipios para obtener los municipios
              //La variable idDepartamento obtiene el valor que se asignó con option.value en la funcion anterior
              let idDepartamento =
                selectDepartamento.options[selectDepartamento.selectedIndex]
                  .value;
              let urlMunicipio =
                "http://localhost/clinicaf/dependencias/getMunicipios/" +
                idDepartamento;

              // Eliminar opciones existentes del select de municipios
              /* Para manejar de forma dinamica el select de municipios cada vez que se selecciona un departamento
                el select de municipios se borra y se vuelve a recrear con los datos del nuevo departamento */
              while (selectMunicipio.firstChild) {
                selectMunicipio.removeChild(selectMunicipio.firstChild);
              }

              axios
                //si no hay problemas con la consulta se reciben los datos y se construyen las opciones del select
                .get(urlMunicipio)
                .then(function (response) {
                  // Llenar Select
                  console.log(response);
                  //se recorre el response con un forEach para ir creando las opciones
                  response.data.forEach((opcion) => {
                    //se crea un elemento de la clase option
                    let option = document.createElement("option");

                    //dentro del option se agregan los datos de la base de datos
                    //option.text muestra el nombre guardado en base de datos y option.value el id del registro en la base de datos
                    option.text = opcion.nombre_municipio;
                    option.value = opcion.id_municipio;

                    //se usa la funcion appendChild para crear las opciones dentro del select
                    //el select ya esta definido como variable en la parte de arriba
                    selectMunicipio.appendChild(option);
                  });

                  if (res.fk_municipio != 0) {
                    $("#municipio option[value=" + res.fk_municipio + "]").attr(
                      {
                        selected: true,
                      }
                    );
                  }
                })
                .catch(function (error) {
                  //Se ejecuta un console.log en caso de que haya un error en la logica del controlador y modelo
                  console.error("Ocurrió un error:", error);
                });
            }

            //Se abre el modal usando su id
            $("#ModalSedes").modal("show");
          }
        };
      }
    });
}
