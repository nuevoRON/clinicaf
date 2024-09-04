import { validarCampo } from "./funcionValidacion.js";

/* Llamados a la función de validarCampo
Se usa un evento que detecte si el campo ha sido llenado */
document.getElementById("especificar").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("especificar").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]+$/,
    "spanEspecificar",
    "Solo puede ingresar letras en el campo de Especifique"
  );
});

document.getElementById("nombre").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("nombre").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
    "spanNombre",
    "Solo puede ingresar letras en el campo de Nombre"
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
    "Solo puede ingresar letras en el campo de Apellido"
  );
});

document.getElementById("aldea_barrio").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("aldea_barrio").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,100}$/,
    "spanBarrio",
    "Solo puede ingresar letras en el campo de Caserio, Aldea o Barrio"
  );
});

document.getElementById("lugar").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("lugar").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú0-9,. ]{1,50}$/,
    "spanLugar",
    "Solo puede ingresar letras y números en el campo de Lugar"
  );
});
