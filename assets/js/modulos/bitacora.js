let tblBitacora;

document.addEventListener("DOMContentLoaded", function () {
  const buttons = [
    //Botón para PDF
    {
      text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
      action: function () {
        window.location.href = '../views/pdf/pdfBitacora.php';
      }
    },
  
    //Botón para print
    {
      extend: "print",
      footer: true,
      text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
  
    },
  ];

  permisosPantalla = obtenerPermisos("Bitacora", permisosUsuario)

  if(!permisosPantalla.consultar) {
    window.location.replace(base_url+'admin');
  }

  let url = base_url + "Bitacora/CrearEvento";
  //cargar datos con el plugin datatables
  tblBitacora = $("#tblBitacora").DataTable({
    ajax: {
      url: base_url + "bitacora/listar",
      dataSrc: "",
    },
    columns: [
      { data: "FECHA" },
      { data: "USUARIO" },
      { data: "OBJETOS" },
      { data: "ACCION" },
      { data: "DESCRIPCION" },
    ],
    language: {
      url: base_url + "assets/js/espanol.json",
    },
    dom,
    buttons,
    responsive: true,
    order: [[0, "asc"]],
  });

  let data = {
    idUser: idUsuario,
    idObjeto: 4,
    accion: "INGRESO",
    descripcion: "SE INGRESÓ A LA PANTALLA DE BITÁCORA",
  };
  axios.post(url, data).then((res) => {
    console.log(res);
    tblBitacora.ajax.reload();
  });
});
