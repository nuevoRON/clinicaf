let tblRoles;
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');
const formulario = document.querySelector('#formulario');

const nombre = document.querySelector('#nombre');
const id = document.querySelector('#id');

const errorNombre = document.querySelector('#errorNombre');
let listaCheck = document.querySelectorAll('.listaCheck');

document.addEventListener('DOMContentLoaded', function () {
    const buttons = [
        //Botón para PDF
        {
          text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
          action: function () {
            window.location.href = base_url+'views/pdf/pdfUsuarios.php';
          }
        },
      
        //Botón para print
        {
          extend: "print",
          footer: true,
          text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>',
      
        },
      ];
      
    //cargar datos con el plugin datatables
    tblRoles = $('#tblRoles').DataTable({
        ajax: {
            url: base_url + 'roles/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'estado' },
            { data: 'nombre' },
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

    let data = {
        idUser: idUsuario,
        idObjeto: 10,
        accion: "INGRESO",
        descripcion: "SE INGRESÓ A LA PANTALLA DE PERMISOS",
    };
    url = base_url + "Bitacora/CrearEvento";
    axios.post(url, data).then((res) => { console.log(res) });

    btnNuevo.addEventListener('click', function () {
        id.value = '';
        errorNombre.textContent = '';
        btnAccion.textContent = 'Registrar';
        for (let j = 0; j < listaCheck.length; j++) {
            listaCheck[j].removeAttribute('checked');            
        }        
        formulario.reset();
        nombre.focus();
    })
    //enviar datos
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorNombre.textContent = '';
        if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES REQUERIDO';
        }else {
            const url = base_url + 'roles/registrar';
            insertarRegistros(url, this, tblRoles, btnAccion, false);
        }
    });
})

function eliminarRol(idRol) {
    const url = base_url + 'roles/eliminar/' + idRol;
    eliminarRegistros(url, tblRoles);
}

function editarRol(idRol) {
    errorNombre.textContent = '';
    const url = base_url + 'roles/editar/' + idRol;
    //hacer una instancia del objeto XMLHttpRequest 
    const http = new XMLHttpRequest();
    //Abrir una Conexion - POST - GET
    http.open('GET', url, true);
    //Enviar Datos
    http.send();
    //verificar estados
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let arreglo = res.permisos;            
            for (let i = 0; i < listaCheck.length; i++) {
                listaCheck[i].removeAttribute('checked');
                let result = arreglo.includes(listaCheck[i].value);
                //let result = arreglo.filter(element => element == listaCheck[i].value);
                if (result) {
                    listaCheck[i].setAttribute('checked', 'checked');
                }           
            }
            id.value = res.rol.id;
            nombre.value = res.rol.nombre;
            btnAccion.textContent = 'Actualizar';
                //////🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃
                pagina='admin/permisos';
                window.location.href=(pagina);
                //////🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃🎃


            ///////
            /*const firstTabEl = document.querySelector("#nav-tab button:nth-last-child(1)");
            const firstTab = new bootstrap.Tab(firstTabEl);
            firstTab.show();*/
            //firstTab.show()
        }
    }
}





function restaurarRol(idRol) {
    const url = base_url + 'roles/restaurar/' + idRol;
    
    restaurarRegistros(url, tblRoles);

}