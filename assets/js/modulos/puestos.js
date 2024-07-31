//Datos generales del puestos
const formulario = document.querySelector("#formulario");
const selectEstado = document.querySelector("#estado");
const selectipuesto = document.querySelector("#puesto");
const id = document.querySelector("#id");

document.addEventListener("DOMContentLoaded", function () {
  
  /* Mostrar Tabla */
  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListarPuestos = "http://localhost/clinicaf/Puestos/listarPuestos";

  axios
    .get(urlListarPuestos)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      //los datos a mostrar en la tabla se encuentran en response.data
      //se define una variable que pueda ser usada dentro del datatable
      let datos = response.data;

      //se inicializa el datatable usando el id de la tabla
      $('#tabla_puestos').DataTable({
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
            { data: 'id_puesto' },
            { data: 'nom_puesto' },
            { data: 'estado' },
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
              editarPuestos(data.id_puesto);
          });

          $(row).find('.btn-warning').click(function() {
            eliminarPuestos(data.id_puesto);
        });
      },

    });

  })
  .catch(function (error) {
    // Maneja errores
    console.error("Ocurrió un error:", error);
  });


  /* Formulario para crear o actualizar un registro */
  formulario.addEventListener('submit', function(e) {
      console.log(estado)
      e.preventDefault(); /*evita que se envie el formulario sin validar*/

      if (estado.value == "") {
          console.log('No puede enviar el formulario vacio')
      } else {
        //Rutas a las funciones para crear y actualizar registros
        const urlInsertar = "http://localhost/clinicaf/puestos/insertarPuestos";
        const urlActualizar = "http://localhost/clinicaf/puestos/actualizarPuestos";
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


/*Eliminar registros*/
//esta funcion recibe el id del registro para realizar la eliminación
function eliminarPuestos(id_puesto) {

  Swal.fire({
    title: "¿Estas seguro de eliminar este puesto?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      let url = "http://localhost/clinicaf/puestos/eliminarPuestos/" + id_puesto;
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


/* Obtener datos de un registro para edición */
function editarPuestos(id_puesto) {
  const url = "http://localhost/clinicaf/puestos/obtenerPuesto/" + id_puesto;
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
      id.value = res.id_puesto;
      id_puesto.value = res.id_puesto;
      
      $("#nom_puesto option[value=" + res.nom_puesto + "]").attr({
        selected: true,
      });
      $("#estado option[value=" + res.estado + "]").attr({
        selected: true,
      });

      //Se abre el modal usando su id
      $('#ModalPuestos').modal('show');
      
    }
  };

}