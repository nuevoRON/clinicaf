import { cargarOpcionesSelect } from "../helpers/funciones.js";

const formulario = document.querySelector("#formulario");
const selectPuesto = document.querySelector("#puesto");
const selectModulo = document.querySelector("#modulo");
const id = document.querySelector("#id");

document.addEventListener("DOMContentLoaded", function () {
  //Cargar puestos
  cargarOpcionesSelect(
    "http://localhost/clinicaf/puestos/getPuestosSelect",
    selectPuesto,
    "nom_puesto",
    "id_puesto"
  );

  //Cargar modulos
  cargarOpcionesSelect(
    "http://localhost/clinicaf/modulos/getModulosSelect",
    selectModulo,
    "nombre",
    "id"
  );

  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListar = "http://localhost/clinicaf/permisos/listarPermisos";

  axios
    .get(urlListar)
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      let datos = response.data;

      $('#tablaPermisos').DataTable({
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
            { data: 'nom_puesto' },
            { data: 'nombre' },
            { data: 'consulta', 
              render: function(data, type, row) {
                    if(data==1){
                      return `<i class="fas fa-check" style="color:green"></i>`;
                    }else{
                      return `<i class="fas fa-ban" style="color:red"></i>`;
                    }
                
                  } 
            },
              { data: 'insercion',
              render: function(data, type, row) {
                    if(data==1){
                      return `<i class="fas fa-check" style="color:green"></i>`;
                    }else{
                      return `<i class="fas fa-ban" style="color:red"></i>`;
                    }
                
                  } 
             },
              { data: 'actualizacion',
              render: function(data, type, row) {
                    if(data==1){
                      return `<i class="fas fa-check" style="color:green"></i>`;
                    }else{
                      return `<i class="fas fa-ban" style="color:red"></i>`;
                    }
                
                  } 
            },
              { data: "eliminacion", 
                render: function(data, type, row) {
                    if(data==1){
                      return `<i class="fas fa-check" style="color:green"></i>`;
                    }else{
                      return `<i class="fas fa-ban" style="color:red"></i>`;
                    }
                
                  } 
              },
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
                editarPermiso(data.id);
            });
  
            $(row).find('.btn-warning').click(function() {
              eliminarPermiso(data.id);
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
    e.preventDefault(); 

      //Rutas a las funciones para crear y actualizar registros
      const urlInsertar = "http://localhost/clinicaf/permisos/insertarPermiso";
      const urlActualizar = "http://localhost/clinicaf/permisos/actualizarPermiso";
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
  });
});


function eliminarPermiso(id) {

  Swal.fire({
    title: "¿Estas seguro de eliminar este permiso?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      let url = "http://localhost/clinicaf/permisos/eliminarPermiso/" + id;
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


// funcion para recuperar los datos 
function editarPermiso(id) {
  var checkboxIns = document.querySelector("#insercion");
  var checkboxAct = document.querySelector("#actualizacion");
  var checkboxEli = document.querySelector("#eliminacion");
  var checkboxCons = document.querySelector("#consulta");

  selectPuesto.selectedIndex = -1;
  selectModulo.selectedIndex = -1;

  const url = "http://localhost/clinicaf/permisos/obtenerPermisos/" + id;
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
      document.getElementById('id').value = id;
      document.getElementById('modal-title').textContent = "Editar Permiso"

      // Establecer los valores seleccionados
      selectPuesto.value = res.id_puesto;
      selectModulo.value = res.id_modulo;

      checkboxIns.checked = res.insercion == 1 ? true : false;
      checkboxAct.checked = res.actualizacion == 1 ? true : false;
      checkboxEli.checked = res.eliminacion == 1 ? true : false;
      checkboxCons.checked = res.consulta == 1 ? true : false;

      $('#ModalPermisos').modal('show'); 
      
    }
  };

}