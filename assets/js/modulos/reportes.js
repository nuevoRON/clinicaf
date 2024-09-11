import { cargarOpcionesSelect } from "../helpers/funciones.js";

//Selects a llenar 
const selectSexo = document.querySelector("#sexo");
const selectReconocimiento = document.querySelector("#reconocimiento");
const selectMedico = document.querySelector("#medico");
const selectVacaciones = document.getElementById("medicoVacaciones");


document.addEventListener("DOMContentLoaded", function () {
  cargarOpcionesSelect(
    "http://localhost/clinicaf/sexos/listarSexos",
    selectSexo,
    "nom_sexo",
    "id_sexo"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/reconocimiento/listarReconocimientos",
    selectReconocimiento,
    "nom_reconocimiento",
    "id_reconocimiento"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/proveidos/getMedicos",
    selectMedico,
    "nombre_completo",
    "id_usu"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/proveidos/getEmpleados",
    selectVacaciones,
    "nombre_completo",
    "id_usu"
  );
})

/* Funcion para obtener los paráemetros de búsqueda del formulario de Proveido */
function obtenerValoresFormularioProveido() {
  return {
      fechaInicio: document.getElementById("fecha_inicio").value,
      fechaFinal: document.getElementById("fecha_final").value,
      medico: document.getElementById("medico").value,
      reconocimiento: document.getElementById("reconocimiento").value,
      sexo: document.getElementById("sexo").value
  };
}

/* Funcion para obtener los paráemetros de búsqueda del formulario de Vacaciones */
function obtenerValoresFormularioVacaciones() {
  return {
      fechaInicio: document.getElementById("fechaInicioVacacion").value,
      fechaFinal: document.getElementById("fechaFinVacacion").value,
      medico: document.getElementById("medicoVacaciones").value
  };
}



function exportarPDFProveido() {
  var valores = obtenerValoresFormularioProveido();

  let urlDescarga = "http://localhost/clinicaf/exportacionPDF/exportarProveidos";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio) parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);
  if (valores.reconocimiento) parametros.push(`reconocimiento=${valores.reconocimiento}`);
  if (valores.sexo) parametros.push(`sexo=${valores.sexo}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += '?' + parametros.join('&');
  }

   window.location.href = urlDescarga; 
}

document.getElementById("botonPDF").addEventListener("click", exportarPDFProveido);


function exportarExcelProveido() {
  var valores = obtenerValoresFormularioProveido();

  let urlDescarga = "http://localhost/clinicaf/exportacionExcel/exportarProveidos";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio) parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);
  if (valores.reconocimiento) parametros.push(`reconocimiento=${valores.reconocimiento}`);
  if (valores.sexo) parametros.push(`sexo=${valores.sexo}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += '?' + parametros.join('&');
  }

  window.location.href = urlDescarga;
}

document.getElementById("botonExcel").addEventListener("click", exportarExcelProveido);


 
function exportarPDFVacaciones() {
  var valores = obtenerValoresFormularioVacaciones();

  let urlDescarga = "http://localhost/clinicaf/exportacionPDF/exportarVacaciones";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio) parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += '?' + parametros.join('&');
  }

  window.location.href = urlDescarga;
}

document.getElementById("botonPDFVacacion").addEventListener("click", exportarPDFVacaciones);


function exportarExcelVacaciones() {
  var valores = obtenerValoresFormularioVacaciones();

  let urlDescarga = "http://localhost/clinicaf/exportacionExcel/exportarVacaciones";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio) parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += '?' + parametros.join('&');
  }

  window.location.href = urlDescarga; 
}

document.getElementById("botonExcelVacacion").addEventListener("click", exportarExcelVacaciones); 
 



/* Función para manejar los tabs del menú de la vista */
function openTab(event, tabName) {
  var i, tabcontent, tabbuttons;

  // Ocultar todas las pestañas
  tabcontent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remover la clase "active" de todos los botones
  tabbuttons = document.getElementsByClassName("tab-button");
  for (i = 0; i < tabbuttons.length; i++) {
    tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
  }

  // Mostrar la pestaña actual y añadir la clase "active" al botón
  document.getElementById(tabName).style.display = "block";
  event.currentTarget.className += " active";
}


