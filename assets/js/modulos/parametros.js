let tblParametros;
const formulario = document.querySelector("#formulario");
const nombreParametro = document.querySelector("#nombre");
const ValorParametro = document.querySelector("#valor");
const id = document.querySelector("#id");
const errorNombre = document.querySelector("#errorNombre");
const errorValor = document.querySelector("#errorValor");
const btnAccion = document.querySelector("#btnAccion");
const btnNuevo = document.querySelector("#btnNuevo");

document.addEventListener("DOMContentLoaded", function () {
    const buttons = [
        //Botón para PDF
        {
          text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
          action: function () {
            window.location.href = base_url+'views/pdf/pdfParametros.php';
          }
        },
      
        //Botón para print
        {
          extend: "print",
          footer: true,
          text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
      
        },
      ];

    tblParametros = $("#tblParametros").DataTable({
        ajax: {
            url: base_url + "parametros/listarParametros",
            dataSrc: "",
        },
        columns: [
            { data: "PARAMETROS" },
            { data: "VALOR" },
            { data: "acciones" },
        ],
        language: {
            url: base_url + "assets/js/espanol.json",
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, "asc"]],
    });

    // Limpiar campos
    btnNuevo.addEventListener("click", function () {
        limpiarCampos();
    });

    // Registrar parámetros
    formulario.addEventListener("submit", function (e) {
        e.preventDefault();
        errorNombre.textContent = "";

        if (nombreParametro.value == "") {
            errorNombre.textContent = "EL NOMBRE DEL PARÁMETRO ES REQUERIDO";
        }else if(ValorParametro.value == ""){
            errorValor.textContent = "EL VALOR DEL PARÁMETRO ES REQUERIDO";
        } 
        else {
            const url = base_url + "parametros/registrarParametro";
            const data = new FormData(this);
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    // Lógica para manejar la respuesta después de registrar un parámetro
                    
                }
            };
        }
    });
});

function eliminarParametro(idParametro) {
    Swal.fire({
        title: "¿Estás seguro de eliminar el parámetro seleccionado?",
        text: "Esta acción no se puede revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
    }).then((result) => {
        if (result.isConfirmed) {
            let url = base_url + "parametros/eliminarParametro/" + idParametro;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    Swal.fire({
                        toast: true,
                        position: "top-right",
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    if (res.type == "success") {
                        tblParametros.ajax.reload();
                        // Lógica adicional después de eliminar un parámetro
                        let data = {
                idUser: idUsuario,
                idObjeto: 29,
                accion: "ELIMINAR",
                descripcion: "SE ELIMINO EL PARAMETRO CON ID " + idParametro,
              };
              url = base_url + "Bitacora/CrearEvento";
              axios.pos(url, data).then((res) => {
                console.log(res);
              });
                    }
                }
            };
        }
    });
}

function editarParametro(idParametro) {
    const url = base_url + "parametros/editarParametro/" + idParametro;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            id.value = res.ID_PARAMETRO;
            nombreParametro.value = res.PARAMETROS;
            ValorParametro.value = res.VALOR;
            // Bloquear el campo de entrada correspondiente al nombre del parámetro
            nombreParametro.setAttribute("readonly", true);
            btnAccion.textContent = "Actualizar";
            const firstTabEl = document.querySelector("#nav-tab button:last-child");
            const firstTab = new bootstrap.Tab(firstTabEl);
            firstTab.show();
        }
    };
    
}


function limpiarCampos() {
    id.value = "";
    btnAccion.textContent = "Registrar";
    formulario.reset();
    nombre.focus();
    valor.focus(); 
    setTimeout(function() {
      location.reload();
    }, 1000);
  }
