const formulario = document.querySelector("#formulario");
const formularioClave = document.querySelector("#formularioClave");

//Datos del perfil para la vista y modal
  let urlListarEmpleados = "http://localhost/clinicaf/personal/listarPerfilEmpleado";

  axios
    .get(urlListarEmpleados)
    //si no hay problemas con la consulta se reciben los datos y se construye la tabla
    .then(function (response) {
      //se muestran los datos obtenidos
      console.log(response.data);
      
      response.data.forEach((opcion) => {
        document.getElementById("span-usuario").textContent = opcion.usuario;
        document.getElementById("span-correo").textContent = opcion.correo;

        document.getElementById("correo_perfil").value = opcion.correo;
        document.getElementById("nombre").value = opcion.nombre;
        document.getElementById("nombre_perfil").value = opcion.nombre;
        document.getElementById("apellido").value = opcion.apellido;
        document.getElementById("apellido_perfil").value = opcion.apellido;
        document.getElementById("telefono").value = opcion.telefono;
        document.getElementById("telefono_perfil").value = opcion.telefono;
        document.getElementById("colegiacion").value = opcion.num_colegiacion;
        document.getElementById("empleado").value = opcion.num_empleado;
        document.getElementById("jornada").value = opcion.nom_jornada;
        document.getElementById("sede").value = opcion.ubicacion;
        document.getElementById("puesto").value = opcion.nom_puesto;
      });
      

    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });


  formularioClave.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario

      const url = "http://localhost/clinicaf/personal/actualizarPerfil";
      const data = new FormData(this);
    
      const method = "PUT";
    
      const http = new XMLHttpRequest();
      http.open(method, url, true);
      
      // Convertir FormData a JSON
      const object = {};
      data.forEach((value, key) => { object[key] = value });
      const jsonData = JSON.stringify(object);
      http.setRequestHeader("Content-Type", "application/json");
      http.send(jsonData);
    
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
              location.reload();
            }
        });
    
        }
      };
  });


  formularioClave.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario

      const url = "http://localhost/clinicaf/personal/actualizarClave";
      const data = new FormData(this);
    
      const method = "PUT";
    
      const http = new XMLHttpRequest();
      http.open(method, url, true);
      
      // Convertir FormData a JSON
      const object = {};
      data.forEach((value, key) => { object[key] = value });
      const jsonData = JSON.stringify(object);
      http.setRequestHeader("Content-Type", "application/json");
      http.send(jsonData);
    
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
              location.reload();
            }
        });
    
        }
      };
  });


  const passwordField = document.getElementById('contrasena');
  const confirmPasswordField = document.getElementById('conf_contrasena');
  const errorMessage = document.getElementById('error-message');
  
  // Función para validar si las contraseñas coinciden
  function validatePasswords() {
      if (confirmPasswordField.value === passwordField.value) {
          errorMessage.textContent = 'Las contraseñas coinciden.';
          errorMessage.style.color = 'green';
      } else {
          errorMessage.textContent = 'Las contraseñas no coinciden.';
          errorMessage.style.color = 'red';
      }
  }
  
  // Escuchar el evento 'input' en el campo de confirmación de contraseña
  confirmPasswordField.addEventListener('input', validatePasswords);