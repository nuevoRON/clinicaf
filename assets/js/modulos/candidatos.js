const formularioInformacionPersonal = document.querySelector('#formulario-informacion-personal');
const formularioNivelEducativo = document.querySelector('#formulario-nivel-educativo');
const formularioExperienciaLaboral = document.querySelector('#formulario-experiencia-laboral');
const formularioCursosHabilidades = document.querySelector('#formulario-cursos-habilidades');

const botonSiguienteInformacionPersonal = document.querySelector('#btnSiguienteInformacionPersonal');
const botonSiguienteEducacion = document.querySelector('#btnSiguienteEducacion');
const botonSiguienteExperiencia = document.querySelector('#btnSiguienteExperiencia');
const botonAnteriorEducacion = document.querySelector('#btnAnteriorEducacion');
const botonAnteriorExperiencia = document.querySelector('#btnAnteriorExperiencia');
const botonAnteriorCursos = document.querySelector('#btnAnteriorCursos');

const nombres = document.querySelector('#nombres');
const apellido = document.querySelector('#apellido');
const correo = document.querySelector('#correo');
const identidad = document.querySelector('#identidad');
const fecha_nacimiento = document.querySelector('#fecha_nacimiento');
const sexo = document.querySelector('#sexo');
const estado_civil = document.querySelector('#estado_civil');
const departamento = document.querySelector('#departamento');
const municipio = document.querySelector('#municipio');
const telefono = document.querySelector('#telefono');


const nivel_educativo = document.querySelector('#nivel_educativo');
const carrera = document.querySelector('#carrera');
const fecha_fin = document.querySelector('#fecha_inicio');

const empresa = document.querySelector('#empresa');
const puesto = document.querySelector('#puesto');
const fecha_inicio_trabajo= document.querySelector('#fecha_inicio_trabajo');
const fecha_fin_trabajo = document.querySelector('#fecha_fin_trabajo');
const descripcion = document.querySelector('#descripcion');

const habilidad = document.querySelector('#habilidad');

const id = document.querySelector('#id_usuario');

//elementos para mostrar errores
const errorNombre = document.querySelector('#errorNombre');
const errorApellido = document.querySelector('#errorApellido');
const errorCorreo = document.querySelector('#errorCorreo');
const errorIdentidad = document.querySelector('#errorIdentidad');
const errorFecha = document.querySelector('#errorFecha');
const errorSexo = document.querySelector('#errorSexo');
const errorEstadoCivil = document.querySelector('#errorEstadoCivil');
const errorMunicipio = document.querySelector('#errorMunicipio');
const errorTelefono = document.querySelector('#errorTelefono');


const errorNivelEducativo = document.querySelector('#errorNivelEducativo');
const errorCarrera = document.querySelector('#errorCarrera');
const errorFechaFin = document.querySelector('#errorFechaFin');

const errorEmpresa = document.querySelector('#errorEmpresa');
const errorPuesto = document.querySelector('#errorPuesto');
const errorFechaInicioTrabajo = document.querySelector('#errorFechaInicioTrabajo');
const errorFechaFinTrabajo = document.querySelector('#errorFechaFinTrabajo');
const errorDescripcion = document.querySelector('#errorDescripcion');

const errorHabilidad = document.querySelector('#errorHabilidad');

const btnRegistrarCandidato = document.querySelector('#btnRegistrarCandidato');

document.addEventListener('DOMContentLoaded', function () {
    //listas sexos
    let urlSexo = base_url + "sexo/getSexo/";
  axios
    .get(urlSexo)
    .then(function (response) {
      
      console.log(response);
      response.data.sexo.forEach((opcion) => {
        let option = document.createElement("option");

        option.text = opcion.NOMBRE;
        option.value = opcion.ID_SEXO;
        sexo.appendChild(option);
      });
    })
    .catch(function (error) {
      
      console.error("Ocurrió un error:", error);
    }); 


     //listar estado civil
     let urlEstadoCivil = base_url + "estadocivil/getEstadoCivil/";
     axios
       .get(urlEstadoCivil)
       .then(function (response) {
         
         console.log(response);
         response.data.estado_civil.forEach((opcion) => {
           let option = document.createElement("option");
   
           option.text = opcion.NOMBRE;
           option.value = opcion.CODIGO_ESTADO_CIVIL;
           estado_civil.appendChild(option);
         });
       })
       .catch(function (error) {
         
         console.error("Ocurrió un error:", error);
       }); 

       //listar departamentos
     let urlDepartamento = base_url + "departamentos/getDepartamentosSelect/";
     axios
       .get(urlDepartamento)
       .then(function (response) {
         
         console.log(response);
         response.data.departamentos.forEach((opcion) => {
           let option = document.createElement("option");
   
           option.text = opcion.NOMBRE;
           option.value = opcion.ID_DEPARTAMENTO;
           departamento.appendChild(option);
         });
       })
       .catch(function (error) {
         
         console.error("Ocurrió un error:", error);
       }); 


       departamento.addEventListener("change", function() {
        // Obtener el valor seleccionado
        let seleccionado = departamento.options[departamento.selectedIndex].value;

        let urlMunicipio = base_url + "municipios/getMunicipiosSelect/"+seleccionado;
        axios
          .get(urlMunicipio)
          .then(function (response) {
            
            console.log(response);
            response.data.municipios.forEach((opcion) => {
              let option = document.createElement("option");
      
              option.text = opcion.NOMBRE;
              option.value = opcion.ID_MUNICIPIO;
              municipio.appendChild(option);
            });
          })
          .catch(function (error) {
            
            console.error("Ocurrió un error:", error);
          }); 
      });

      //listar niveles educativos
     let urlNivelEducativo = base_url + "estudios/getTiposEstudio/";
     axios
       .get(urlNivelEducativo)
       .then(function (response) {
         
         console.log(response);
         response.data.estudios.forEach((opcion) => {
           let option = document.createElement("option");
   
           option.text = opcion.NOMBRE_TITULO;
           option.value = opcion.CODIGO_ESTUDIOS;
           nivel_educativo.appendChild(option);
         });
       })
       .catch(function (error) {
         
         console.error("Ocurrió un error:", error);
       }); 

       formularioInformacionPersonal.addEventListener('submit', function (e) {
        e.preventDefault();
        errorNombre.textContent = '';
        errorApellido.textContent= '';
        errorCorreo.textContent = '';
        errorIdentidad.textContent = '';
        errorFecha.textContent = '';
        errorSexo.textContent = '';
        errorMunicipio.textContent = '';
        errorEstadoCivil.textContent = '';
        if (nombres.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES REQUERIDO';
        }else if (apellido.value == '') {
            errorApellido.textContent = 'EL APELLIDO ES REQUERIDO';
        }else if (correo.value == '') {
            errorCorreo.textContent = 'EL CORREO ES REQUERIDO';
        }else if (identidad.value == '') {
            errorIdentidad.textContent = 'LA IDENTIDAD ES REQUERIDA';
        } else if (identidad.value.includes('0000000000000')) {
            Swal.fire({
                toast : true,
                position: 'top-right',
                icon: 'warning',
                title: 'NO SE PERMITEN SOLO 0 EN LA IDENTIDAD',
                showConfirmButton: false,
                timer: 1500
            })
        } else if (fecha_nacimiento.value == '') {
          errorFecha.textContent = 'LA FECHA DE NACIMIENTO ES REQUERIDA';
        } else if (sexo.value == '') {
          errorSexo.textContent = 'EL SEXO ES REQUERIDO';
        } else if (municipio.value == '') {
          errorMunicipio.textContent = 'EL MUNICIPIO ES REQUERIDO';
        }else if (estado_civil.value == '') {
          errorEstadoCivil.textContent = 'EL ESTADO CIVIL ES REQUERIDO';
        }else if (estado_civil.value == '') {
          errorEstadoCivil.textContent = 'EL ESTADO CIVIL ES REQUERIDO';
        }else{
            const url = base_url + 'candidatos/registrarInformacionPersonal';
            //crear formData
            const data = new FormData(this);
            //hacer una instancia del objeto CMLHttoRequest
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open('POST', url, true);
            //Enviar Datos
            http.send(data);
            //Verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText)
                    const res = JSON.parse(this.responseText);
                    console.log(res)
                    if(res.msg.includes("SQLSTATE[23000]")) {
                        res.msg = "EL USUARIO DEBE SER UNICO"
                    }
                    Swal.fire({
                        toast : true,
                        position: 'top-right',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        }
    })


    formularioNivelEducativo.addEventListener('submit', function (e) {
      e.preventDefault();
      errorNivelEducativo.textContent='';
      errorCarrera.textContent='';
      errorFechaFin.textContent='';
      if (nivel_educativo.value == '') {
        errorNivelEducativo.textContent = 'EL NIVEL EDUCATIVO ES REQUERIDO';
      }else if (carrera.value == '') {
        errorCarrera.textContent = 'LA CARRERA ES REQUERIDA';
      }else if (fecha_fin.value == '') {
        errorFechaFin.textContent = 'LA FECHA DE FINALIZACION DE ESTUDIOS ES REQUERIDA';
      }else{
          const url = base_url + 'candidatos/registrarNivelEducativo';
          //crear formData
          const data = new FormData(this);
          //hacer una instancia del objeto CMLHttoRequest
          const http = new XMLHttpRequest();
          //Abrir una Conexion - POST - GET
          http.open('POST', url, true);
          //Enviar Datos
          http.send(data);
          //Verificar estados
          http.onreadystatechange = function () {
              if (this.readyState == 4 && this.status == 200) {
                  console.log(this.responseText)
                  const res = JSON.parse(this.responseText);
                  console.log(res)
                  if(res.msg.includes("SQLSTATE[23000]")) {
                      res.msg = "EL USUARIO DEBE SER UNICO"
                  }
                  Swal.fire({
                      toast : true,
                      position: 'top-right',
                      icon: res.type,
                      title: res.msg,
                      showConfirmButton: false,
                      timer: 1500
                  })
              }
          }
      }
  })


  formularioExperienciaLaboral.addEventListener('submit', function (e) {
    e.preventDefault();
        const url = base_url + 'candidatos/registrarExperienciaLaboral';
        //crear formData
        const data = new FormData(this);
        //hacer una instancia del objeto CMLHttoRequest
        const http = new XMLHttpRequest();
        //Abrir una Conexion - POST - GET
        http.open('POST', url, true);
        //Enviar Datos
        http.send(data);
        //Verificar estados
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
                const res = JSON.parse(this.responseText);
                console.log(res)
                if(res.msg.includes("SQLSTATE[23000]")) {
                    res.msg = "EL USUARIO DEBE SER UNICO"
                }
                Swal.fire({
                    toast : true,
                    position: 'top-right',
                    icon: res.type,
                    title: res.msg,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
  })


  formularioCursosHabilidades.addEventListener('submit', function (e) {
    e.preventDefault();
        const url = base_url + 'candidatos/registrarCursosHabilidades';
        //crear formData
        const data = new FormData(this);
        //hacer una instancia del objeto CMLHttoRequest
        const http = new XMLHttpRequest();
        //Abrir una Conexion - POST - GET
        http.open('POST', url, true);
        //Enviar Datos
        http.send(data);
        //Verificar estados
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
                const res = JSON.parse(this.responseText);
                console.log(res)
                if(res.msg.includes("SQLSTATE[23000]")) {
                    res.msg = "EL USUARIO DEBE SER UNICO"
                }
                Swal.fire({
                    toast : true,
                    position: 'top-right',
                    icon: res.type,
                    title: res.msg,
                    showConfirmButton: false,
                    timer: 1500
                })
                if (res.type == "success") {
                  setTimeout(function() {
                    window.location.href = "../usuarios/PerfilCandidato?id="+id;
                  }, 1000);
                }
            }
        }
  })

    //Cargar roles
    let id=document.querySelector("#id_usuario").value
    let url = base_url + "candidatos/getInformacionCandidato/"+ id;
    axios
      .get(url)
      .then(function (response) {
  
        response.data.candidato.forEach((opcion) => {
            document.querySelector('#nombres_mostrar').textContent=opcion.NOMBRES;
        });
      })
      .catch(function (error) {
        // Maneja errores
        console.error("Ocurrió un error:", error);
      });
})

function limpiarCampos(){
    formulario.reset();
    setTimeout(function() {
        location.reload();
    }, 1000);
}

function agregarExperiencia() {
  // Clona el contenedor de experiencia
  var experienciaContainer = document.querySelector('.experiencia-container');
  var nuevaExperiencia = experienciaContainer.cloneNode(true);

  // Limpia los valores de los nuevos campos
  var inputs = nuevaExperiencia.querySelectorAll('input');
  inputs.forEach(function(input) {
    input.value = '';
  });

  // Agrega la nueva experiencia después de la última
  experienciaContainer.parentNode.appendChild(nuevaExperiencia);
}

function eliminarExperiencia(contenedor) {
  // Verifica si el contenedor no es nulo
  if (contenedor) {
      // Obtiene el nodo padre del contenedor y elimina el contenedor
      contenedor.parentNode.removeChild(contenedor);
  } else {
      console.error('El contenedor es nulo o no válido');
  }
}

function agregarEducacion() {
  // Clona el contenedor de experiencia
  var experienciaContainer = document.querySelector('.contenedor-educacion');
  var nuevaExperiencia = experienciaContainer.cloneNode(true);

  // Limpia los valores de los nuevos campos
  var inputs = nuevaExperiencia.querySelectorAll('input');
  inputs.forEach(function(input) {
    input.value = '';
  });

  // Agrega la nueva experiencia después de la última
  experienciaContainer.parentNode.appendChild(nuevaExperiencia);
}

function eliminarEducacion(contenedor) {
  // Verifica si el contenedor no es nulo
  if (contenedor) {
      // Obtiene el nodo padre del contenedor y elimina el contenedor
      contenedor.parentNode.removeChild(contenedor);
  } else {
      console.error('El contenedor es nulo o no válido');
  }
}

function agregarCursos() {
  // Clona el contenedor de experiencia
  var experienciaContainer = document.querySelector('.contenedor-curso');
  var nuevaExperiencia = experienciaContainer.cloneNode(true);

  // Limpia los valores de los nuevos campos
  var inputs = nuevaExperiencia.querySelectorAll('input');
  inputs.forEach(function(input) {
    input.value = '';
  });

  // Agrega la nueva experiencia después de la última
  experienciaContainer.parentNode.appendChild(nuevaExperiencia);
}

function eliminarCurso(contenedor) {
  // Verifica si el contenedor no es nulo
  if (contenedor) {
      // Obtiene el nodo padre del contenedor y elimina el contenedor
      contenedor.parentNode.removeChild(contenedor);
  } else {
      console.error('El contenedor es nulo o no válido');
  }
}


function validarFechas() {
  // Obtener los valores de las fechas
  var fechaInicio = document.getElementById('fecha_inicio_trabajo').value;
  var fechaFin = document.getElementById('fecha_fin_trabajo').value;

  // Convertir las fechas a objetos Date
  var fechaInicioObj = new Date(fechaInicio);
  var fechaFinObj = new Date(fechaFin);

  // Comparar las fechas
  if (fechaInicioObj > fechaFinObj) {
    document.getElementById("errorFechaFinTrabajo").textContent = "LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA FINAL";
  } else {
    document.getElementById("errorFechaFinTrabajo").textContent = "";
  }
}

document.getElementById("fecha_fin_trabajo").addEventListener("input", validarFechas);
document.getElementById("fecha_inicio_trabajo").addEventListener("input", validarFechas);

botonSiguienteInformacionPersonal.addEventListener('click', function (e){
  document.getElementById('nav-informacion').classList.remove('show', 'active');
  document.getElementById('nav-informacion-tab').classList.remove('show', 'active');
  document.getElementById('nav-educacion').classList.add('show', 'active');
  document.getElementById('nav-educacion-tab').classList.add('show', 'active');
})

botonSiguienteEducacion.addEventListener('click', function (e){
  document.getElementById('nav-educacion').classList.remove('show', 'active');
  document.getElementById('nav-educacion-tab').classList.remove('show', 'active');
  document.getElementById('nav-experiencia').classList.add('show', 'active');
  document.getElementById('nav-experiencia-tab').classList.add('show', 'active');
})

botonSiguienteExperiencia.addEventListener('click', function (e){
  document.getElementById('nav-experiencia').classList.remove('show', 'active');
  document.getElementById('nav-experiencia-tab').classList.remove('show', 'active');
  document.getElementById('nav-cursos').classList.add('show', 'active');
  document.getElementById('nav-cursos-tab').classList.add('show', 'active');
})


botonAnteriorEducacion.addEventListener('click', function (e){
  document.getElementById('nav-informacion').classList.add('show', 'active');
  document.getElementById('nav-informacion-tab').classList.add('show', 'active');
  document.getElementById('nav-educacion').classList.remove('show', 'active');
  document.getElementById('nav-educacion-tab').classList.remove('show', 'active');
})

botonAnteriorExperiencia.addEventListener('click', function (e){
  document.getElementById('nav-educacion').classList.add('show', 'active');
  document.getElementById('nav-educacion-tab').classList.add('show', 'active');
  document.getElementById('nav-experiencia').classList.remove('show', 'active');
  document.getElementById('nav-experiencia-tab').classList.remove('show', 'active');
})

botonAnteriorCursos.addEventListener('click', function (e){
  document.getElementById('nav-experiencia').classList.add('show', 'active');
  document.getElementById('nav-experiencia-tab').classList.add('show', 'active');
  document.getElementById('nav-cursos').classList.remove('show', 'active');
  document.getElementById('nav-cursos-tab').classList.remove('show', 'active');
})