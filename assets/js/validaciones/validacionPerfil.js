import { validarCampo, limitarCaracteresNumericos } from "../helpers/funciones.js";

/* Llamados a la función de validarCampo
Se usa un evento que detecte si el campo ha sido llenado */

document.getElementById("nombre_perfil").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("nombre_perfil").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
    "spanNombre",
    "Solo puede ingresar letras en este campo"
  );
});



document.getElementById("apellido_perfil").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("apellido_perfil").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
    "spanApellido",
    "Solo puede ingresar letras en este campo"
  );
});

document.getElementById("telefono_perfil").addEventListener("input", function() {
  //se obtiene el valor del input
  const valor = document.getElementById("telefono_perfil");
  //se envian los datos a la función
  limitarCaracteresNumericos(valor, 10);
});


document.getElementById("contrasena").addEventListener("input", function () {
  const valor = document.getElementById("contrasena").value;
  validarCampo(
    valor,
    /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#])[A-Za-z\d@$!%*?&_#]{8,}$/,
    "spanClave",
    "Su contraseña no cumple con los parámetros de seguridad"
  );
});