import { cargarOpcionesSelect } from "../helpers/funciones.js";

const formulario = document.querySelector("#formulario");
const formularioOcupacion = document.querySelector("#formularioOcupacion");
const formularioInstrumento = document.querySelector("#formularioInstrumento");
const formularioNacionalidad = document.querySelector("#formularioNacionalidad");

const selectOcupacion = document.querySelector("#ocupacion");
const selectSexo = document.querySelector("#sexo");
const selectEscolaridad = document.querySelector("#escolaridad");
const selectDepartamento = document.querySelector("#departamento");
const selectMunicipio = document.querySelector("#municipio");
const selectInstrumento = document.querySelector("#instrumento");
const selectEstadoCivil = document.querySelector("#estadoCivil");
const selectSede = document.querySelector("#sede_evaluacion");
const sedeConsentimiento = document.getElementById('permiso_evaluacion')
const selectNacionalidad = document.getElementById('nacionalidad')
const idEvaluado = document.querySelector("#id_evaluado").value;

document.addEventListener("DOMContentLoaded", function () {
  //Creación de los selects del modal
  cargarOpcionesSelect(
    "http://localhost/clinicaf/sexos/listarSexos",
    selectSexo,
    "nom_sexo",
    "id_sexo"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/evaluados/listarOcupaciones",
    selectOcupacion,
    "nom_ocupacion",
    "id_ocupacion"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/evaluados/listarEscolaridad",
    selectEscolaridad,
    "nom_escolaridad",
    "id_escolaridad"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/evaluados/listarNacionalidad",
    selectNacionalidad,
    "nom_nacionalidad",
    "id_nacionalidad"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/dependencias/getDepartamentos",
    selectDepartamento,
    "nombre_departamento",
    "id_departamento"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/evaluados/listarInstrumentos",
    selectInstrumento,
    "nom_instrumento",
    "id_instrumento"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/evaluados/listarEstadoCivil",
    selectEstadoCivil,
    "nom_estado",
    "id_estado_civil"
  );

  cargarOpcionesSelect(
    "http://localhost/clinicaf/sedes/listarSedes",
    selectSede,
    "ubicacion",
    "id_sede"
  );

    //Cargar municipios
    selectDepartamento.addEventListener("change", function() {
      let idDepartamento= selectDepartamento.options[selectDepartamento.selectedIndex].value
      let urlMunicipio = "http://localhost/clinicaf/dependencias/getMunicipios/"+ idDepartamento;
  
      // Eliminar opciones existentes del select de municipios
      while (selectMunicipio.firstChild) {
          selectMunicipio.removeChild(selectMunicipio.firstChild);
      }

      axios
      .get(urlMunicipio)
      .then(function (response) {
        // Llenar Select
        console.log(response);
        response.data.forEach((opcion) => {
          let option = document.createElement("option");

          option.text = opcion.nombre_municipio;
          option.value = opcion.id_municipio;
          selectMunicipio.appendChild(option);
        });

        if(res.id_municipio != 0){
          $("#municipio option[value=" + res.id_municipio + "]").attr({
            selected: true,
          });
        }
      })
      .catch(function (error) {
        // Maneja errores
        console.error("Ocurrió un error:", error);
      });
  
  }); 


   

  sedeConsentimiento.addEventListener("change", function() {
    sedeConsentimiento.value == 'Si' ? $(".contenedor-consentimiento").show() : $(".contenedor-consentimiento").hide();
  })


  const cargarFormulario = async () => {
    const urlEvaluado = "http://localhost/clinicaf/evaluados/editarEvaluado/" + idEvaluado;
    try {
      const response = await axios.get(urlEvaluado);
      const res = response.data;
  
      if (res.estado_evaluacion === 'Pendiente' || res.estado_evaluacion === 'Realizado' || res.estado_evaluacion === 'Nuevo') {
        document.getElementById('numero_solicitud').value = res.num_caso;
        document.getElementById('numero_caso').value = res.num_solicitud;
        document.getElementById('numero_caso_ext').value = res.num_caso_ext;
        document.getElementById('fecha_emision').value = res.fech_emi_soli;
        document.getElementById('fecha_recepcion').value = res.fech_recep_soli;
        document.getElementById('especifique').value = res.especifique_cual;
        document.getElementById('nombre').value = res.nombre_evaluado;
        document.getElementById('apellido').value = res.apellido_evaluado;
        document.getElementById('dni').value = res.dni_evaluado;
        document.getElementById('telefono').value = res.telefono_evaluado;
        document.getElementById('diversidad').value = res.diversidad;
        document.getElementById('edad').value = res.edad;
        document.getElementById('lugar_procedencia').value = res.lugar_procedencia;
        document.getElementById('nombre_acomp').value = res.nombre_acompanante;
        document.getElementById('apellido_acomp').value = res.apellido_acompanante;
        document.getElementById('dni_acomp').value = res.dni_acompanante;
        document.getElementById('aldea_barrio').value = res.localidad;
        document.getElementById('lugar_hecho').value = res.lugar_hecho;
        document.getElementById('fecha_hecho').value = res.fecha_hecho;
        document.getElementById('fiscalia').value = res.nom_dependencia;
        document.getElementById('tipo_evaluacion').value = res.nom_reconocimiento;
        document.getElementById('descripcion_evaluacion').value = res.descripcion_evaluacion;
        document.getElementById('agresor_conocido').value = res.especificar_relacion;
        document.getElementById('fecha_finalizacion').value = res.fecha_finalizacion;

        document.getElementById('departamento').value = res.id_departamento;
        document.getElementById('nacionalidad').value = res.nacionalidad;
        document.getElementById('sexo').value = res.id_sexo;
        document.getElementById('estadoCivil').value = res.estado_civil;
        document.getElementById('escolaridad').value = res.escolaridad;
        document.getElementById('tiempo').value = res.tiempo;
        document.getElementById('relacion').value = res.relacion_acompanante;
        document.getElementById('permiso_evaluacion').value = res.consentimiento_informado;
        document.getElementById('relacion_agresor').value = res.relacion_agresor;
        document.getElementById('sede_evaluacion').value = res.sede_evaluacion;
        $("#ocupacion").val(res.ocupacion).trigger('change'); 
        $("#instrumento").val(res.instrumento_agresion).trigger('change'); 

        if (res.consentimiento_informado === 'Si') {
          $(".contenedor-consentimiento").show();
        } else {
          $(".contenedor-consentimiento").hide();
        }
  
        if (res.id_departamento) {
          await cargarMunicipios(res.id_departamento, res.id_municipio);
        }
      }
    } catch (error) {
      console.error("Ocurrió un error al cargar los datos:", error);
    }
  };
  
  const cargarMunicipios = async (idDepartamento, idMunicipio) => {
    const urlMunicipio = "http://localhost/clinicaf/dependencias/getMunicipios/" + idDepartamento;
    try {
      const response = await axios.get(urlMunicipio);
  
      while (selectMunicipio.firstChild) {
        selectMunicipio.removeChild(selectMunicipio.firstChild);
      }

      response.data.forEach((opcion) => {
        let option = document.createElement("option");
        option.text = opcion.nombre_municipio;
        option.value = opcion.id_municipio;
        selectMunicipio.appendChild(option);
      });
  
      if (idMunicipio) {
        $("#municipio option[value=" + idMunicipio + "]").attr({ selected: true });
      }
    } catch (error) {
      console.error("Ocurrió un error al cargar los municipios:", error);
    }
  };
  
  $(document).ready(function() {
    $('#ocupacion').select2({
      selectionCssClass: "",
      language:"SpanishTranslation"
    });
  });

  $(document).ready(function() {
    $('#instrumento').select2();
  });

  cargarFormulario();
  


  formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario

      const urlInsertar = "http://localhost/clinicaf/evaluados/insertarEvaluado";
      const urlActualizar = "http://localhost/clinicaf/evaluados/actualizarEvaluado";
      const data = new FormData(this);
    
      // Verificar si el campo 'id' está presente en los datos del formulario
      const id = data.get('id_evaluado'); // Asume que el campo 'id' tiene el nombre 'id'
      
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
              window.location.href = './listaEvaluacion'
            }
        });
    
        }
      };
  });
});


/* Añadir nuevas ocupaciones */
formularioOcupacion.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevenir la acción por defecto del formulario
    const url = "http://localhost/clinicaf/evaluados/insertarOcupacion";
    const method = "POST";
    const data = new FormData(this);
  
    const http = new XMLHttpRequest();
    http.open(method, url, true);
    http.send(data);

    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        $('#ModalOcupacion').modal('hide'); 
            // Eliminar opciones existentes del select de municipios
            while (selectOcupacion.firstChild) {
              selectOcupacion.removeChild(selectOcupacion.firstChild);
            }

            cargarOpcionesSelect(
              "http://localhost/clinicaf/evaluados/listarOcupaciones",
              selectOcupacion,
              "nom_ocupacion",
              "id_ocupacion"
            );
      }
    };
});


/* Añadir nuevos instrumentos */
formularioInstrumento.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevenir la acción por defecto del formulario
    const url = "http://localhost/clinicaf/evaluados/insertarInstrumento";
    const method = "POST";
    const data = new FormData(this);
  
    const http = new XMLHttpRequest();
    http.open(method, url, true);
    http.send(data);

    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        $('#ModalInstru').modal('hide'); 
          // Eliminar opciones existentes del select de municipios
          while (selectInstrumento.firstChild) {
            selectInstrumento.removeChild(selectInstrumento.firstChild);
          }
          cargarOpcionesSelect(
            "http://localhost/clinicaf/evaluados/listarInstrumentos",
            selectInstrumento,
            "nom_instrumento",
            "id_instrumento"
          );
      }
    };
});


/* Añadir nuevas nacionalidades */
formularioNacionalidad.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevenir la acción por defecto del formulario
    const url = "http://localhost/clinicaf/evaluados/insertarNacionalidad";
    const method = "POST";
    const data = new FormData(this);
  
    const http = new XMLHttpRequest();
    http.open(method, url, true);
    http.send(data);

    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        $('#ModalNacionalidad').modal('hide'); 
          // Eliminar opciones existentes del select de municipios
          while (selectNacionalidad.firstChild) {
            selectNacionalidad.removeChild(selectNacionalidad.firstChild);
          }
          
          cargarOpcionesSelect(
            "http://localhost/clinicaf/evaluados/listarNacionalidad",
            selectNacionalidad,
            "nom_nacionalidad",
            "id_nacionalidad"
          );
      }
    };
});



/*Eliminar registros*/
//esta funcion recibe el id del registro para realizar la eliminación
function eliminarProveido(idProveido) {

  Swal.fire({
    title: "¿Estas seguro de eliminar este proveído?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      let url = "http://localhost/clinicaf/proveidos/eliminarProveido/" + idProveido;
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

//Funcion para limitar cantidad de caracteres en campos
function limitarCaracteres(elemento, maximo) {
  elemento.value = elemento.value.replace(/[^0-9]/g, '');
  
  if (elemento.value.length > maximo) {
      elemento.value = elemento.value.slice(0, maximo);
  }
}


document.getElementById("dni").addEventListener("input", function () {
  const valor = document.getElementById("dni");
  limitarCaracteres(valor, 13);
});

document.getElementById("dni_acomp").addEventListener("input", function () {
  const valor = document.getElementById("dni_acomp");
  limitarCaracteres(valor, 13);
});


document.getElementById("edad").addEventListener("input", function () {
  const valor = document.getElementById("edad");
  limitarCaracteres(valor, 3);
});


document.getElementById("telefono").addEventListener("input", function () {
  const valor = document.getElementById("telefono");
  limitarCaracteres(valor, 8);
});

