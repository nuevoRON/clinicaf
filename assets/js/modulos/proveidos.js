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
const selectMedico = document.querySelector("#medico");
const selectDepartamento = document.querySelector("#item_departamento_reg");
const selectMunicipio = document.querySelector("#item_municipio_reg");

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
  let urlReconocimiento = "http://localhost/clinicaf/reconocimiento/listarReconocimientos";
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


    /* Mostrar Tabla */
  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListarSedes = "http://localhost/clinicaf/proveidos/listarProveidos";

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
      $('#tabla_proveidos').DataTable({
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
       
            { data: 'num_caso' },
            { data: 'dni_evaluado' },
            { data: 'nombre_evaluado' },
            { data: 'apellido_evaluado' },
            { data: 'nom_dependencia' },
            { data: 'nom_reconocimiento' },
            { data: 'fecha_citacion' },
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
              editarProveido(data.id_proveidos);
            });
  
            $(row).find('.btn-warning').click(function() {
              eliminarProveido(data.id_proveidos);
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
function eliminarProveido(idProveido) {

  Swal.fire({
    title: "¿Estas seguro de eliminar este proveído?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      let url = "http://localhost/clinicaf/proveidos/eliminarProveido/" + idProveido;
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



// funcion para recuperar los datos del proveido
function editarProveido(idProveido) {

  const url = "http://localhost/clinicaf/proveidos/editarProveido/" + idProveido;
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
      document.getElementById('id').value = idProveido;
      document.getElementById('numero_solicitud_reg').value = res.num_caso;
      document.getElementById('numero_externo_reg').value = res.num_caso_ext;
      document.getElementById('fecha_emision').value = res.fech_emi_soli;
      document.getElementById('fecha_recepcion').value = res.fech_recep_soli;
      document.getElementById('nombre').value = res.nombre_evaluado;
      document.getElementById('apellido').value = res.apellido_evaluado;
      document.getElementById('dni').value = res.dni_evaluado;
      document.getElementById('aldea_barrio').value = res.localidad;
      document.getElementById('lugar').value = res.lugar_hecho;
      document.getElementById('fecha_hecho').value = res.fecha_hecho;
      document.getElementById('fecha_citacion').value = res.fecha_citacion;
      $("#item_departamento_reg option[value=" + res.id_departamento + "]").attr({selected: true,});
      $("#item_dependencia_reg option[value=" + res.fiscalia_remitente + "]").attr({selected: true,});
      $("#item_recon_reg option[value=" + res.tipo_reconocimiento + "]").attr({selected: true,});
      $("#medico option[value=" + res.medico + "]").attr({selected: true,});

      //Cargar municipios
      if(res.fk_departamento != 0){
        const selectDepartamento = document.querySelector("#item_departamento_reg");
        const selectMunicipio = document.querySelector("#item_municipio_reg");

          //se llama a la funcion getMunicipios para obtener los municipios
          //La variable idDepartamento obtiene el valor que se asignó con option.value en la funcion anterior
          let idDepartamento= selectDepartamento.options[selectDepartamento.selectedIndex].value
          let urlMunicipio = "http://localhost/clinicaf/dependencias/getMunicipios/"+ idDepartamento;
      
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

            console.log(res.id_municipio)
            if(res.id_municipio != 0){
              $("#item_municipio_reg option[value=" + res.id_municipio + "]").attr({
                selected: true,
              });
      
            }
          })
          .catch(function (error) {
            //Se ejecuta un console.log en caso de que haya un error en la logica del controlador y modelo
            console.error("Ocurrió un error:", error);
          });
      
      }

     //Se abre el modal usando su id
     $('#Modalproveído').modal('show'); 
    }
  }
  
}