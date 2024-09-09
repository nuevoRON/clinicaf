import { cargarOpcionesSelect } from "../helpers/funciones.js";

const formulario = document.querySelector("#formulario");
const selectSexo = document.querySelector("#sexo");
const selectReconocimiento = document.querySelector("#reconocimiento");
const selectMedico = document.querySelector("#medico");
const id = document.querySelector("#id");

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
})


//Funciones del formulario para agregar o actualizar un registro
function exportarPDF() {
  // Obtener los valores de los campos del formulario
  let fechaInicio = document.getElementById("fecha_inicio").value;
  let fechaFinal = document.getElementById("fecha_final").value;
  let medico = document.getElementById("medico").value;
  let reconocimiento = document.getElementById("reconocimiento").value;
  let sexo = document.getElementById("sexo").value;

  // Inicializar la URL base
  let urlDescarga = "http://localhost/clinicaf/exportacionPDF/exportarProveidos";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (fechaInicio) parametros.push(`fecha_inicio=${fechaInicio}`);
  if (fechaFinal) parametros.push(`fecha_final=${fechaFinal}`);
  if (medico) parametros.push(`medico=${medico}`);
  if (reconocimiento) parametros.push(`reconocimiento=${reconocimiento}`);
  if (sexo) parametros.push(`sexo=${sexo}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += '?' + parametros.join('&');
  }

  // Redireccionar para descargar el PDF con los parámetros
  window.location.href = urlDescarga;
}

document.getElementById("botonPDF").addEventListener("click", exportarPDF);

function exportarExcel() {
  // Obtener los valores de los campos del formulario
  let fechaInicio = document.getElementById("fecha_inicio").value;
  let fechaFinal = document.getElementById("fecha_final").value;
  let medico = document.getElementById("medico").value;
  let reconocimiento = document.getElementById("reconocimiento").value;
  let sexo = document.getElementById("sexo").value;

  // Inicializar la URL base
  let urlDescarga = "http://localhost/clinicaf/exportacionExcel/exportarProveidos";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (fechaInicio) parametros.push(`fecha_inicio=${fechaInicio}`);
  if (fechaFinal) parametros.push(`fecha_final=${fechaFinal}`);
  if (medico) parametros.push(`medico=${medico}`);
  if (reconocimiento) parametros.push(`reconocimiento=${reconocimiento}`);
  if (sexo) parametros.push(`sexo=${sexo}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += '?' + parametros.join('&');
  }

  // Redireccionar para descargar el PDF con los parámetros
  window.location.href = urlDescarga;
}

document.getElementById("botonExcel").addEventListener("click", exportarExcel);


