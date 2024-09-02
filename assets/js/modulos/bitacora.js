/* Mostrar Tabla */
//Se extraen los datos de la base de datos para llenar el datatable
let urlListar = "http://localhost/clinicaf/bitacora/listar";

axios
  .get(urlListar)
  //si no hay problemas con la consulta se reciben los datos y se construye la tabla
  .then(function (response) {
    //se muestran los datos obtenidos
    console.log(response.data);
    //los datos a mostrar en la tabla se encuentran en response.data
    //se define una variable que pueda ser usada dentro del datatable
    let datos = response.data;

    //se inicializa el datatable usando el id de la tabla
    $('#tblBitacora').DataTable({
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
        { data: 'usuario' },
        { data: 'nombre' },
        { data: 'accion' },
        { data: 'descripcion' },
        { data: 'fecha_accion' },
      ],
      order: [[ 4, "desc" ]]
    });
    

  })
  .catch(function (error) {
    // Maneja errores
    console.error("Ocurrió un error:", error);
  });