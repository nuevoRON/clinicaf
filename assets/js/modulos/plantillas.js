const formulario = document.querySelector("#formulario");
const id = document.querySelector("#id");

document.addEventListener("DOMContentLoaded", function () {
  //Se extraen los datos de la base de datos para llenar el datatable
  let urlListar = "http://localhost/clinicaf/plantillas/listarPlantillas";

  axios
    .get(urlListar)
    .then(function (response) {
      //se muestran los datos obtenidos
      let datos = response.data;

      $("#tblPlantilla").DataTable({
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
        data: datos,
        paging: true,
        columns: [
          { data: "id_archivo" },
          { data: "ruta" },
          {
            render: function (data, type, row) {
              return `<button class="btn btn-success">
                    <i class="fas fa-download"></i></button>`;
            },
          }
        ],
        createdRow: function (row, data, dataIndex) {
          $(row)
            .find(".btn-success", "btn")
            .click(function () {
              descargarPlantilla(data.id_archivo);
            });
        },
      });
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });

});



function descargarPlantilla(id) {
  let urlDescarga = "http://localhost/clinicaf/plantillas/descargarArchivo?id=" + id;
    
  window.location.href = urlDescarga;
}

