let tblRoles;
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');
const formulario = document.querySelector('#formulario');

const roles = document.querySelector("#roles");
const numeros = document.querySelector("#numeros");
const id = document.querySelector("#id");

//elementos para mostrar errores
const errorRoles = document.querySelector("#errorRoles");
const errorNumeros = document.querySelector("#errorNumeros");
let permisosPantalla;

document.addEventListener('DOMContentLoaded', function () {
  const buttons = [
    //Botón para PDF
    {
      text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
      action: function () {
        window.location.href = base_url+'views/pdf/pdfRoles.php';
      }
    },
  
    //Botón para print
    {
      extend: "print",
      footer: true,
      text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
  
    },
  ];
///✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅
  //inicio permisos & roles
    permisosPantalla = obtenerPermisos("Roles", permisosUsuario)

    if(!permisosPantalla.consultar) {
      window.location.replace(base_url+'admin');
    }
    //final permisos & roles
    ///🌟🌟🌟🌟🌟🌟🌟🌟🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰
    //Cargar roles
    /*let url = base_url + "roles/getRoles2/500000000";
    axios
      .get(url)
      .then(function (response) {
        // Llenar Select
        console.log(response);
        response.data.roles.forEach((opcion) => {
          let option = document.createElement("option");
  
          option.text = opcion.ROL;
          option.value = opcion.id;
          usuario.appendChild(option);
        });
      })
      .catch(function (error) {
        // Maneja errores
        console.error("Ocurrió un error:", error);
      });*/
    ///🌟🌟🌟🌟🌟🌟🌟🌟🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰🔰

    //cargar datos con el plugin datatables
    tblRoles = $('#tblRoles').DataTable({
        ajax: {
            url: base_url + 'roles/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'estado' },
            { data: 'ROL' },
            { data: 'acciones' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'desc']],
    });
    console.log(tblRoles);
    let data = {
        idUser: idUsuario,
        idObjeto: 1,
        accion: "INGRESO",
        descripcion: "SE INGRESÓ A LA PANTALLA DE ROLES",
    };
    url = base_url + "Bitacora/CrearEvento";
    axios.post(url, data).then((res) => { console.log(res) });

    btnNuevo.addEventListener('click', function () {
        id.value = '';
        btnAccion.textContent = 'Registrar';
        formulario.reset();
    })
    //enviar datos
    //resgistrar roles
  formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    errorRoles.textContent = '';
    errorNumeros.textContent = '';
///✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅
  //icio de permisos && roles✅
    if (!permisosPantalla.crear) {
        Swal.fire({
          toast: true,
          position: "top-right",
          icon: "info",
          title: "NO TIENE PERMISO DE CREAR",
          showConfirmButton: false,
          timer: 1500,
        }); 
    } else                                                                  ///✅✅
    if (roles.value == "") {
      errorRoles.textContent = "EL NOMBRE ES REQUERIDO";
    } else if (numeros.value == "") {
      errorNumeros.textContent = "EL NUMERO ES REQUERIDO";
    } else {
      const url = base_url + "roles/registrarRol";
      //crear formData
      const data = new FormData(this);
      //hacer una instancia del objeto CMLHttoRequest
      const http = new XMLHttpRequest();
      //Abrir una Conexion - POST - GET
      http.open("POST", url, true);
      //Enviar Datos
      http.send(data);
      //Verificar estados
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText)
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
            limpiarCampos();
            tblRoles.ajax.reload();
          }
        }
      };
    }
  });
});

function eliminarRol(idRol) {
  ///✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅
  //icio de permisos && roles✅
    if (!permisosPantalla.eliminar) {
        Swal.fire({
          toast: true,
          position: "top-right",
          icon: "info",
          title: "NO TIENE PERMISO DE ELIMINAR",
          showConfirmButton: false,
          timer: 1500,
        }); 
    } else 
    if(idRol == 1) {
        Swal.fire({
            toast: true,
            position: "top-right",
            icon: 'info',
            title: 'No se puede eliminar el rol administrador',
            showConfirmButton: false,
            timer: 2000,
          });
    } else {
        const url = base_url + 'roles/eliminar/' + idRol;
        eliminarRegistros(url, tblRoles);
    }
}

//funcion para recuperar los datos ((editar))
function editarRoles(idRoles) {
  ///✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅✅
    //icio de permisos && roles✅
    if (!permisosPantalla.actualizar) {
        Swal.fire({
          toast: true,
          position: "top-right",
          icon: "info",
          title: "NO TIENE PERMISO DE ACTUALIZAR",
          showConfirmButton: false,
          timer: 1500,
        }); 
    } else 
    if(idRoles != 1) {

        const url = base_url + "roles/editarRol/" + idRoles;
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
            id.value = res.id;
            roles.value = res.ROL;
            numeros.value = res.DESCRIPCION;
            btnAccion.textContent = "Actualizar";
            //console.log(this.responseText);
            const firstTabEl = document.querySelector("#nav-tab button:nth-last-child(2)");
            const firstTab = new bootstrap.Tab(firstTabEl);
            firstTab.show();
          }
        };
    } else {
        Swal.fire({
            toast: true,
            position: "top-right",
            icon: 'info',
            title: 'No se puede eliminar el rol administrador',
            showConfirmButton: false,
            timer: 2000,
          });
    }
  }
  
  //porque se bloquea el bton actualizar
  function limpiarCampos() {
    id.value = "";
    btnAccion.textContent = "Registrar";
    formulario.reset();
    roles.focus();
  }





function restaurarRol(idRol) {
    const url = base_url + 'roles/restaurar/' + idRol;

    restaurarRegistros(url, tblRoles);

}