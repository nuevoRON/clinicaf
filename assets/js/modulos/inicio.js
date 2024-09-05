document.addEventListener("DOMContentLoaded", function () {
  let permisoConsulta = "http://localhost/clinicaf/permisos/validarPermisos";
  
  axios.post(permisoConsulta, {
    consulta: 1,
    modulo: 1
  })
  .then(function (response) {
    if(response.data.consulta == 0){
      window.location.href = '../inicio/error'
    }
    
  })
  .catch(function (error) {
    console.error("Ocurrió un error:", error);
  });
    
    
    axios
      .get("http://localhost/clinicaf/inicio/countEmpleados")
      .then(function (response) {
        // Recorrer los datos y agregar las opciones al select
        document.getElementById('span-empleados').textContent = `${response.data.cantidad_empleados} Registrados`
      })
      .catch(function (error) {
        // Manejar errores
        console.error("Ocurrió un error:", error);
      });


      axios
      .get("http://localhost/clinicaf/inicio/countEvaluaciones")
      .then(function (response) {
        // Recorrer los datos y agregar las opciones al select
        document.getElementById('span-evaluaciones').textContent = `${response.data.cantidad_evaluados} Registradas`
      })
      .catch(function (error) {
        // Manejar errores
        console.error("Ocurrió un error:", error);
      });


      axios
      .get("http://localhost/clinicaf/inicio/countCitaciones")
      .then(function (response) {
        // Recorrer los datos y agregar las opciones al select
        document.getElementById('span-citaciones').textContent = `${response.data.cantidad_citaciones} Registradas`
      })
      .catch(function (error) {
        // Manejar errores
        console.error("Ocurrió un error:", error);
      });


      axios
      .get("http://localhost/clinicaf/inicio/countDictamenes")
      .then(function (response) {
        // Recorrer los datos y agregar las opciones al select
        document.getElementById('span-dictamenes').textContent = `${response.data.cantidad_dictamenes} Registrados`
      })
      .catch(function (error) {
        // Manejar errores
        console.error("Ocurrió un error:", error);
      });


      axios
      .get("http://localhost/clinicaf/inicio/countPlantillas")
      .then(function (response) {
        // Recorrer los datos y agregar las opciones al select
        document.getElementById('span-plantillas').textContent = `${response.data.cantidad_plantillas} Registradas`
      })
      .catch(function (error) {
        // Manejar errores
        console.error("Ocurrió un error:", error);
      });
})