//Datos generales del Proveido
const formulario = document.querySelector("#formulario");
const formularioOcupacion = document.querySelector("#formularioOcupacion");
const formularioInstrumento = document.querySelector("#formularioInstrumento");

const selectOcupacion = document.querySelector("#ocupacion");
const selectSexo = document.querySelector("#sexo");
const selectEscolaridad = document.querySelector("#escolaridad");
const selectDepartamento = document.querySelector("#departamento");
const selectMunicipio = document.querySelector("#municipio");
const selectInstrumento = document.querySelector("#instrumento");
const selectEstadoCivil = document.querySelector("#estadoCivil");
const selectSede = document.querySelector("#sede_evaluacion");
const sedeConsentimiento = document.getElementById('permiso_evaluacion')
const idEvaluado = document.querySelector("#id_evaluado").value;

document.addEventListener("DOMContentLoaded", function () {
  $(document).ready(function() {
    $('#ocupacion').select2({
      selectionCssClass: "",
      language:"SpanishTranslation"
    });
  });

  $(document).ready(function() {
    $('#instrumento').select2();
  });
  
  //Cargar sexos
  let url = "http://localhost/clinicaf/sexos/listarSexos";
  axios
    .get(url)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = `${opcion.nom_sexo}`;
        option.value = opcion.id_sexo;
        selectSexo.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    }); 


    //Cargar ocupaciones
  let urlOcupacion = "http://localhost/clinicaf/evaluados/listarOcupaciones";
  axios
    .get(urlOcupacion)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = `${opcion.nom_ocupacion}`;
        option.value = opcion.id_ocupacion;
        selectOcupacion.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    }); 


    //Cargar escolaridad
  let urlEscolaridad = "http://localhost/clinicaf/evaluados/listarEscolaridad";
  axios
    .get(urlEscolaridad)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = `${opcion.nom_escolaridad}`;
        option.value = opcion.id_escolaridad;
        selectEscolaridad.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    }); 


  //Cargar departamentos
  let urlDepartamento = "http://localhost/clinicaf/dependencias/getDepartamentos";
  axios
    .get(urlDepartamento)
    .then(function (response) {
      // Llenar Select
      console.log(response);
      response.data.departamentos.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.nombre_departamento;
        option.value = opcion.id_departamento;
        selectDepartamento.appendChild(option);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });
 

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


   //Cargar instrumentos
   let urlInstrumentos = "http://localhost/clinicaf/evaluados/listarInstrumentos";
   axios
     .get(urlInstrumentos)
     .then(function (response) {
       // Llenar Select
       console.log(response);
       response.data.forEach((opcion) => {
         let option = document.createElement("option");
 
         option.text = `${opcion.nom_instrumento}`;
         option.value = opcion.id_instrumento;
         selectInstrumento.appendChild(option);
       });
     })
     .catch(function (error) {
       // Maneja errores
       console.error("Ocurrió un error:", error);
     });


     //Cargar estado civil
   let urlEstadoCivil = "http://localhost/clinicaf/evaluados/listarEstadoCivil";
   axios
     .get(urlEstadoCivil)
     .then(function (response) {
       // Llenar Select
       console.log(response);
       response.data.forEach((opcion) => {
         let option = document.createElement("option");
 
         option.text = opcion.nom_estado;
         option.value = opcion.id_estado_civil;
         selectEstadoCivil.appendChild(option);
       });
     })
     .catch(function (error) {
       // Maneja errores
       console.error("Ocurrió un error:", error);
     });


     //Cargar estado civil
   let urlSede = "http://localhost/clinicaf/sedes/listarSedes";
   axios
     .get(urlSede)
     .then(function (response) {
       // Llenar Select
       console.log(response);
       response.data.forEach((opcion) => {
         let option = document.createElement("option");
 
         option.text = opcion.ubicacion;
         option.value = opcion.id_sede;
         selectSede.appendChild(option);
       });
     })
     .catch(function (error) {
       // Maneja errores
       console.error("Ocurrió un error:", error);
     });
     
     
  const urlEvaluado = "http://localhost/clinicaf/evaluados/editarEvaluado/" + idEvaluado;
  //hacer una instancia del objeto CMLHttoRequest
  const http = new XMLHttpRequest();
  //Abrir una Conexion - POST - GET
  http.open("GET", urlEvaluado, true);
  //Enviar Datos
  http.send();
  //Verificar estados
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      if(res.estado_evaluacion == 'Pendiente' || res.estado_evaluacion == 'Realizado'){
        document.getElementById('numero_solicitud').value = res.num_caso;
        document.getElementById('numero_caso_ext').value = res.num_caso_ext;
        document.getElementById('fecha_emision').value = res.fech_emi_soli;
        document.getElementById('fecha_recepcion').value = res.fech_recep_soli;
  
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
  
        $("#departamento option[value=" + res.id_departamento + "]").attr({selected: true,});
        $("#nacionalidad option[value=" + res.nacionalidad + "]").attr({selected: true,});
        $("#sexo option[value=" + res.id_sexo + "]").attr({selected: true,});
        $("#estadoCivil option[value=" + res.estado_civil + "]").attr({selected: true,});
        $("#ocupacion option[value=" + res.ocupacion + "]").attr({selected: true,});
        $("#escolaridad option[value=" + res.escolaridad + "]").attr({selected: true,});
        $("#tiempo option[value=" + res.tiempo + "]").attr({selected: true,});
        $("#relacion option[value=" + res.relacion_acompanante + "]").attr({selected: true,});
        $("#permiso_evaluacion option[value=" + res.consentimiento_informado + "]").attr({selected: true,});
        $("#instrumento option[value=" + res.instrumento_agresion + "]").attr({selected: true,});
        $("#relacion_agresor option[value=" + res.relacion_agresor + "]").attr({selected: true,});
        $("#sede_evaluacion option[value=" + res.sede_evaluacion + "]").attr({selected: true,});

        res.consentimiento_informado == 'Si' ? $(".contenedor-consentimiento").show() : $(".contenedor-consentimiento").hide();
      }else if(res.estado_evaluacion == 'Nuevo'){ 
        document.getElementById('numero_solicitud').value = res.num_caso;
        document.getElementById('numero_caso_ext').value = res.num_caso_ext;
        document.getElementById('fecha_emision').value = res.fech_emi_soli;
        document.getElementById('fecha_recepcion').value = res.fech_recep_soli;
        document.getElementById('nombre').value = res.nombre_evaluado;
        document.getElementById('apellido').value = res.apellido_evaluado;
        document.getElementById('dni').value = res.dni_evaluado;
        document.getElementById('aldea_barrio').value = res.localidad;
        document.getElementById('lugar_hecho').value = res.lugar_hecho;
        document.getElementById('fecha_hecho').value = res.fecha_hecho;
        document.getElementById('fiscalia').value = res.nom_dependencia;
        document.getElementById('tipo_evaluacion').value = res.nom_reconocimiento;
        $("#departamento option[value=" + res.id_departamento + "]").attr({selected: true,})

        $(".contenedor-consentimiento").hide();
      }
      

      //Cargar municipios
      if(res.id_departamento != 0){
          //se llama a la funcion getMunicipios para obtener los municipios
          //La variable idDepartamento obtiene el valor que se asignó con option.value en la funcion anterior
          let idDepartamento= selectDepartamento.options[selectDepartamento.selectedIndex].value
          let urlMunicipio = "http://localhost/clinicaf/dependencias/getMunicipios/"+ idDepartamento;
      
          // Eliminar opciones existentes del select de municipios
          /* Para manejar de forma dinamica el select de municipios cada vez que se selecciona un departamento
          el select de municipios se borra y se vuelve a recrear con los datos del nuevo departamento */
          while (selectMunicipio.firstChild) {
              selectMunicipio.removeChild(selectMunicipio.firstChild);
          }

          axios
          //si no hay problemas con la consulta se reciben los datos y se construyen las opciones del select
          .get(urlMunicipio)
          .then(function (response) {
            // Llenar Select
            console.log(response);
            //se recorre el response con un forEach para ir creando las opciones
            response.data.forEach((opcion) => {
              //se crea un elemento de la clase option
              let option = document.createElement("option");

              //dentro del option se agregan los datos de la base de datos
            //option.text muestra el nombre guardado en base de datos y option.value el id del registro en la base de datos
              option.text = opcion.nombre_municipio;
              option.value = opcion.id_municipio;

              //se usa la funcion appendChild para crear las opciones dentro del select
            //el select ya esta definido como variable en la parte de arriba
              selectMunicipio.appendChild(option);
            });

            if(res.id_municipio != 0){
              $("#municipio option[value=" + res.id_municipio + "]").attr({
                selected: true,
              });
      
            }
          })
          .catch(function (error) {
            //Se ejecuta un console.log en caso de que haya un error en la logica del controlador y modelo
            console.error("Ocurrió un error:", error);
          });
      
      }
    }
  }

  sedeConsentimiento.addEventListener("change", function() {
    sedeConsentimiento.value == 'Si' ? $(".contenedor-consentimiento").show() : $(".contenedor-consentimiento").hide();
  })


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

        let urlOcupacion = "http://localhost/clinicaf/evaluados/listarOcupaciones";
            // Eliminar opciones existentes del select de municipios
            while (selectOcupacion.firstChild) {
              selectOcupacion.removeChild(selectOcupacion.firstChild);
            }

            axios
            .get(urlOcupacion)
            .then(function (response) {
              // Llenar Select
              console.log(response);
              response.data.forEach((opcion) => {
                let option = document.createElement("option");

                option.text = opcion.nom_ocupacion;
                option.value = opcion.id_ocupacion;
                selectOcupacion.appendChild(option);
              });

            })
            .catch(function (error) {
              // Maneja errores
              console.error("Ocurrió un error:", error);
            })
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

        let urlInstrumentos = "http://localhost/clinicaf/evaluados/listarInstrumentos";
            // Eliminar opciones existentes del select de municipios
            while (selectInstrumento.firstChild) {
              selectInstrumento.removeChild(selectInstrumento.firstChild);
            }

            axios
            .get(urlInstrumentos)
            .then(function (response) {
              // Llenar Select
              console.log(response);
              response.data.forEach((opcion) => {
                let option = document.createElement("option");

                option.text = opcion.nom_instrumento;
                option.value = opcion.id_instrumento;
                selectInstrumento.appendChild(option);
              });

            })
            .catch(function (error) {
              // Maneja errores
              console.error("Ocurrió un error:", error);
            })
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