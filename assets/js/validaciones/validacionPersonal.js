import { validarCampo, limitarCaracteresNumericos } from "../helpers/funciones.js";

/* Llamados a la función de validarCampo
Se usa un evento que detecte si el campo ha sido llenado */

document.getElementById("nombre").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("nombre").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
    "spanNombre",
    "Solo puede ingresar letras en este campo"
  );
});

document.getElementById("apellido").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("apellido").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
    "spanApellido",
    "Solo puede ingresar letras en este campo"
  );
});

document.getElementById("usuario").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("usuario").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[a-z0-9]{1,50}$/,
    "spanUsuario",
    "Solo puede ingresar letras minúsculas y números, sin espacios,  en este campo"
  );
});


document.getElementById("telefono").addEventListener("input", function() {
  //se obtiene el valor del input
  const valor = document.getElementById("telefono");
  //se envian los datos a la función
  limitarCaracteresNumericos(valor, 10);
});