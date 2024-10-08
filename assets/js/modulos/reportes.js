import { cargarOpcionesSelect } from "../helpers/funciones.js";

//Selects a llenar
const selectSexo = document.querySelector("#sexo");
const selectReconocimiento = document.querySelector("#reconocimiento");
const selectMedico = document.querySelector("#medico");
const selectVacaciones = document.getElementById("medicoVacaciones");

document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";

  axios
    .post(permisoConsulta, {
      consulta: 1,
      modulo: 18,
    })
    .then(function (response) {
      if (response.data.consulta == 0 || response.data == false) {
        window.location.href = "../inicio/error";
      }
    })
    .catch(function (error) {
      console.error("Ocurrió un error:", error);
    });

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
});

$(document).ready(function () {
  $("#medicoVacaciones").select2();
});

/* Funcion para obtener los paráemetros de búsqueda del formulario de Proveido */
function obtenerValoresFormularioProveido() {
  return {
    fechaInicio: document.getElementById("fecha_inicio").value,
    fechaFinal: document.getElementById("fecha_final").value,
    medico: document.getElementById("medico").value,
    reconocimiento: document.getElementById("reconocimiento").value,
    sexo: document.getElementById("sexo").value,
  };
}

/* Funcion para obtener los paráemetros de búsqueda del formulario de Vacaciones */
function obtenerValoresFormularioVacaciones() {
  return {
    fechaInicio: document.getElementById("fechaInicioVacacion").value,
    fechaFinal: document.getElementById("fechaFinVacacion").value,
    medico: document.getElementById("medicoVacaciones").value,
  };
}


function exportarPDFProveido() {
  const { jsPDF } = window.jspdf;

  // Obtener la fecha y hora actual
  var fechaActual = new Date();
  var fechaTexto = fechaActual.toLocaleDateString();
  var horaTexto = fechaActual.toLocaleTimeString();

  var valores = obtenerValoresFormularioProveido();

  let urlDescarga = "http://localhost/clinicaf/exportacion/exportarProveidos";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio)
    parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);
  if (valores.reconocimiento)
    parametros.push(`reconocimiento=${valores.reconocimiento}`);
  if (valores.sexo) parametros.push(`sexo=${valores.sexo}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += "?" + parametros.join("&");
  }

  axios({
    url: urlDescarga,
    method: "GET",
    responseType: "json",
  })
    .then((response) => {
      var datos = response.data;

      // Crear un nuevo documento PDF
      const doc = new jsPDF({
        orientation: "landscape", 
        unit: "mm", 
        format: "a4", 
      });

      const imageUrl = "http://localhost/clinicaf/assets/images/mf.jpeg"; 

      doc.addImage(imageUrl, "PNG", 135, 20, 30, 30); 

      // Título del PDF
      doc.setFontSize(18);
      doc.setFont("helvetica", "bold");
      doc.text("Reporte de Evaluaciones Médicas", 100, 60);

      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("Fecha: " + fechaTexto + " - Hora: " + horaTexto, 10, 80);

      // Datos
      const headers = [
        "Número de Caso",
        "DNI",
        "Nombre",
        "Dependencia",
        "Reconocimiento",
        "Fecha Citación",
      ];
      const rows = datos.map((item) => [
        item.num_caso,
        item.dni_evaluado,
        item.nombre_completo,
        item.nom_dependencia,
        item.nom_reconocimiento,
        item.fecha_citacion,
      ]);

      // Definir el ancho máximo de la página
      const pageWidth = doc.internal.pageSize.width - 28;
      const pageHeight = doc.internal.pageSize.height - 40;
      const startX = 14;
      let startY = 100;
      const cellHeight = 10;
      const padding = 2;
      const headerPadding = 4;
      const zebraColor1 = [240, 240, 240];
      const zebraColor2 = [255, 255, 255];

      const maxColumnWidths = headers.map((header, index) =>
        Math.max(
          doc.getTextWidth(header) + 2 * padding,
          ...rows.map(
            (row) => doc.getTextWidth(String(row[index])) + 2 * padding
          )
        )
      );

      const totalWidth = maxColumnWidths.reduce((a, b) => a + b, 0);
      const scaleFactor = pageWidth / totalWidth;
      const adjustedCellWidth = maxColumnWidths.map(
        (width) => width * scaleFactor
      );

      // Encabezados
      doc.setFontSize(12);
      doc.setFont("helvetica", "bold");
      let xOffset = startX;
      headers.forEach((header, index) => {
        doc.text(header, xOffset, startY + headerPadding);
        xOffset += adjustedCellWidth[index];
      });
      doc.setLineWidth(0.5);
      doc.line(
        startX,
        startY + cellHeight / 2 + headerPadding,
        startX + adjustedCellWidth.reduce((a, b) => a + b, 0),
        startY + cellHeight / 2 + headerPadding
      );

      startY += cellHeight + headerPadding;

      // Datos
      doc.setFont("helvetica", "normal");
      rows.forEach((row, rowIndex) => {
        // Si la altura total de la siguiente fila excede el tamaño de la página, crear una nueva página
        if (startY + cellHeight > pageHeight) {
          doc.addPage();
          startY = 20;

          // Reimprimir encabezados en la nueva página
          doc.setFontSize(12);
          doc.setFont("helvetica", "bold");
          xOffset = startX;
          headers.forEach((header, index) => {
            doc.text(header, xOffset, startY + headerPadding);
            xOffset += adjustedCellWidth[index];
          });
          doc.setLineWidth(0.5);
          doc.line(
            startX,
            startY + cellHeight / 2 + headerPadding,
            startX + adjustedCellWidth.reduce((a, b) => a + b, 0),
            startY + cellHeight / 2 + headerPadding
          );

          startY += cellHeight + headerPadding;
        }

        const zebraColor = rowIndex % 2 === 0 ? zebraColor1 : zebraColor2;
        doc.setFillColor(...zebraColor);
        doc.rect(
          startX,
          startY,
          adjustedCellWidth.reduce((a, b) => a + b, 0),
          cellHeight,
          "F"
        );

        xOffset = startX;
        row.forEach((cell, cellIndex) => {
          const x = xOffset;
          const y = startY;

          const cellText = String(cell);
          const lines = doc.splitTextToSize(
            cellText,
            adjustedCellWidth[cellIndex] - 2 * padding
          );
          lines.forEach((line, lineIndex) => {
            doc.text(line, x + padding, y + lineIndex * 6);
          });

          xOffset += adjustedCellWidth[cellIndex];
        });

        startY += cellHeight; // Mover la posición hacia abajo para la siguiente fila
      });

      var nombreArchivo = "reporte_evaluaciones_" + fechaTexto + "_" + horaTexto + ".pdf";
      doc.save(nombreArchivo);
    })
    .catch((error) => {
      console.error("Error al descargar el archivo Excel:", error);
    });
}
document
  .getElementById("botonPDF")
  .addEventListener("click", exportarPDFProveido);



function exportarExcelProveido() {
  var valores = obtenerValoresFormularioProveido();

  let urlDescarga = "http://localhost/clinicaf/exportacion/exportarProveidos";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio)
    parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);
  if (valores.reconocimiento)
    parametros.push(`reconocimiento=${valores.reconocimiento}`);
  if (valores.sexo) parametros.push(`sexo=${valores.sexo}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += "?" + parametros.join("&");
  }

  axios({
    url: urlDescarga,
    method: "GET",
    responseType: "json", 
  })
    .then((response) => {
      console.log(response);
      const titulo = "Reporte de Evaluaciones Médicas";

      const headers = [
        "ID Proveídos",
        "Número de Caso",
        "DNI Evaluado",
        "Nombre",
        "Dependencia",
        "Reconocimiento",
        "Fecha Citación",
        "Estado Evaluación",
      ];

      // Crear una hoja de trabajo a partir de los datos
      const worksheetData = [[titulo], []];
      worksheetData.push(headers);

      response.data.forEach((item) => {
        worksheetData.push([
          item.id_proveidos,
          item.num_caso,
          item.dni_evaluado,
          item.nombre_completo,
          item.nom_dependencia,
          item.nom_reconocimiento,
          item.fecha_citacion,
          item.estado_evaluacion,
        ]);
      });

      const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);

      const headerStyle = {
        font: { bold: true, color: { rgb: "FFFFFF" } }, 
        fill: { fgColor: { rgb: "4F81BD" } }, 
        alignment: { horizontal: "center", vertical: "center" }, 
      };

      // Estilo para las celdas de datos
      const cellStyle = {
        alignment: { horizontal: "center", vertical: "center" }, 
      };

      // Aplicar el estilo a los encabezados
      const range = XLSX.utils.decode_range(worksheet["!ref"]);
      for (let C = range.s.c; C <= range.e.c; ++C) {
        const cell_ref = XLSX.utils.encode_cell({ r: 0, c: C });
        if (!worksheet[cell_ref]) continue;
        worksheet[cell_ref].s = headerStyle; 
      }

      // Aplicar estilo a las celdas de datos
      for (let R = 1; R <= range.e.r; ++R) {
        for (let C = range.s.c; C <= range.e.c; ++C) {
          const cell_ref = XLSX.utils.encode_cell({ r: R, c: C });
          if (!worksheet[cell_ref]) continue;
          worksheet[cell_ref].s = cellStyle; 
        }
      }

      const workbook = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(workbook, worksheet, "Evaluaciones");

      XLSX.writeFile(workbook, "evaluaciones.xlsx");
    })
    .catch((error) => {
      console.error("Error al descargar el archivo Excel:", error);
    });
}
document
  .getElementById("botonExcel")
  .addEventListener("click", exportarExcelProveido);


function exportarPDFVacaciones() {
  const { jsPDF } = window.jspdf;

  // Obtener la fecha y hora actual
  var fechaActual = new Date();
  var fechaTexto = fechaActual.toLocaleDateString();
  var horaTexto = fechaActual.toLocaleTimeString();

  var valores = obtenerValoresFormularioProveido();

  let urlDescarga = "http://localhost/clinicaf/exportacion/exportarVacaciones";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio)
    parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += "?" + parametros.join("&");
  }

  axios({
    url: urlDescarga,
    method: "GET",
    responseType: "json",
  })
    .then((response) => {
      var datos = response.data;

      const doc = new jsPDF({
        orientation: "landscape", 
        unit: "mm",
        format: "a4", 
      });

      const imageUrl = "http://localhost/clinicaf/assets/images/mf.jpeg"; 

      doc.addImage(imageUrl, "PNG", 135, 20, 30, 30); //

      // Título del PDF
      doc.setFontSize(18);
      doc.setFont("helvetica", "bold");
      doc.text("Reporte de Vacaciones", 115, 60);

      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text("Fecha: " + fechaTexto + " - Hora: " + horaTexto, 10, 80);

      // Datos
      const headers = [
        "Número Empleado",
        "Nombre",
        "Estado",
        "Fecha Inicio",
        "Fecha Final",
        "Dias Vacaciones",
        "Observaciones",
      ];
      const rows = datos.map((item) => [
        item.num_empleado,
        item.nombre_completo,
        item.nom_estado,
        item.fecha_inicio,
        item.fecha_final,
        item.dias_vacaciones,
        item.observaciones,
      ]);

      // Definir el ancho máximo de la página
      const pageWidth = doc.internal.pageSize.width - 28;
      const pageHeight = doc.internal.pageSize.height - 40;
      const startX = 14;
      let startY = 100;
      const cellHeight = 10;
      const padding = 2;
      const headerPadding = 4;
      const zebraColor1 = [240, 240, 240];
      const zebraColor2 = [255, 255, 255];

      const maxColumnWidths = headers.map((header, index) =>
        Math.max(
          doc.getTextWidth(header) + 2 * padding,
          ...rows.map(
            (row) => doc.getTextWidth(String(row[index])) + 2 * padding
          )
        )
      );

      const totalWidth = maxColumnWidths.reduce((a, b) => a + b, 0);
      const scaleFactor = pageWidth / totalWidth;
      const adjustedCellWidth = maxColumnWidths.map(
        (width) => width * scaleFactor
      );

      // Encabezados
      doc.setFontSize(12);
      doc.setFont("helvetica", "bold");
      let xOffset = startX;
      headers.forEach((header, index) => {
        doc.text(header, xOffset, startY + headerPadding);
        xOffset += adjustedCellWidth[index];
      });
      doc.setLineWidth(0.5);
      doc.line(
        startX,
        startY + cellHeight / 2 + headerPadding,
        startX + adjustedCellWidth.reduce((a, b) => a + b, 0),
        startY + cellHeight / 2 + headerPadding
      );

      startY += cellHeight + headerPadding;

      // Datos
      doc.setFont("helvetica", "normal");
      rows.forEach((row, rowIndex) => {
        // Si la altura total de la siguiente fila excede el tamaño de la página, crear una nueva página
        if (startY + cellHeight > pageHeight) {
          doc.addPage();
          startY = 20;

          // Reimprimir encabezados en la nueva página
          doc.setFontSize(12);
          doc.setFont("helvetica", "bold");
          xOffset = startX;
          headers.forEach((header, index) => {
            doc.text(header, xOffset, startY + headerPadding);
            xOffset += adjustedCellWidth[index];
          });
          doc.setLineWidth(0.5);
          doc.line(
            startX,
            startY + cellHeight / 2 + headerPadding,
            startX + adjustedCellWidth.reduce((a, b) => a + b, 0),
            startY + cellHeight / 2 + headerPadding
          );

          startY += cellHeight + headerPadding;
        }

        const zebraColor = rowIndex % 2 === 0 ? zebraColor1 : zebraColor2;
        doc.setFillColor(...zebraColor);
        doc.rect(
          startX,
          startY,
          adjustedCellWidth.reduce((a, b) => a + b, 0),
          cellHeight,
          "F"
        );

        xOffset = startX;
        row.forEach((cell, cellIndex) => {
          const x = xOffset;
          const y = startY;

          const cellText = String(cell);
          const lines = doc.splitTextToSize(
            cellText,
            adjustedCellWidth[cellIndex] - 2 * padding
          );
          lines.forEach((line, lineIndex) => {
            doc.text(line, x + padding, y + lineIndex * 6);
          });

          xOffset += adjustedCellWidth[cellIndex];
        });

        startY += cellHeight; // Mover la posición hacia abajo para la siguiente fila
      });

      var nombreArchivo = "reporte_vacaciones_" + fechaTexto + "_" + horaTexto + ".pdf";
      doc.save(nombreArchivo);
    })
    .catch((error) => {
      console.error("Error al descargar el archivo Excel:", error);
    });
}
document
  .getElementById("botonPDFVacacion")
  .addEventListener("click", exportarPDFVacaciones);

  
function exportarExcelVacaciones() {
  var valores = obtenerValoresFormularioVacaciones();

  let urlDescarga = "http://localhost/clinicaf/exportacion/exportarVacaciones";

  // Crear un objeto para almacenar los parámetros
  let parametros = [];

  // Verificar si hay valores y agregarlos a la lista de parámetros
  if (valores.fechaInicio)
    parametros.push(`fecha_inicio=${valores.fechaInicio}`);
  if (valores.fechaFinal) parametros.push(`fecha_final=${valores.fechaFinal}`);
  if (valores.medico) parametros.push(`medico=${valores.medico}`);

  // Si hay parámetros, agregarlos a la URL
  if (parametros.length > 0) {
    urlDescarga += "?" + parametros.join("&");
  }

  axios({
    url: urlDescarga,
    method: "GET",
    responseType: "json", 
  })
    .then((response) => {
      console.log(response);
      const titulo = "Reporte de Vacaciones";

      const headers = [
        "Número Empleado",
        "Nombre",
        "Estado",
        "Fecha Inicio",
        "Fecha Final",
        "Dias Vacaciones",
        "Observaciones",
      ];

      const worksheetData = [[titulo], []];
      worksheetData.push(headers);

      response.data.forEach((item) => {
        worksheetData.push([
          item.num_empleado,
          item.nombre_completo,
          item.nom_estado,
          item.fecha_inicio,
          item.fecha_final,
          item.dias_vacaciones,
          item.observaciones,
        ]);
      });

      const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);

      const headerStyle = {
        font: { bold: true, color: { rgb: "FFFFFF" } }, 
        fill: { fgColor: { rgb: "4F81BD" } }, 
        alignment: { horizontal: "center", vertical: "center" }, 
      };

      // Estilo para las celdas de datos
      const cellStyle = {
        alignment: { horizontal: "center", vertical: "center" },
      };

      // Aplicar el estilo a los encabezados
      const range = XLSX.utils.decode_range(worksheet["!ref"]);
      for (let C = range.s.c; C <= range.e.c; ++C) {
        const cell_ref = XLSX.utils.encode_cell({ r: 0, c: C });
        if (!worksheet[cell_ref]) continue;
        worksheet[cell_ref].s = headerStyle; // Aplicar estilo a la fila de encabezado
      }

      // Aplicar estilo a las celdas de datos
      for (let R = 1; R <= range.e.r; ++R) {
        for (let C = range.s.c; C <= range.e.c; ++C) {
          const cell_ref = XLSX.utils.encode_cell({ r: R, c: C });
          if (!worksheet[cell_ref]) continue;
          worksheet[cell_ref].s = cellStyle; // Aplicar estilo a las filas de datos
        }
      }

      const workbook = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(workbook, worksheet, "Evaluaciones");

      XLSX.writeFile(workbook, "evaluaciones.xlsx");
    })
    .catch((error) => {
      console.error("Error al descargar el archivo Excel:", error);
    });
}

document
  .getElementById("botonExcelVacacion")
  .addEventListener("click", exportarExcelVacaciones);

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
