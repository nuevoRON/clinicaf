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
})