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

document.getElementById("nombre_acomp").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("nombre_acomp").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
    "spanNombreAcomp",
    "Solo puede ingresar letras en este campo"
  );
});

document
  .getElementById("apellido_acomp")
  .addEventListener("change", function () {
    //se obtiene el valor del input
    const valor = document.getElementById("apellido_acomp").value;
    //se envian los datos a la función
    validarCampo(
      valor,
      /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
      "spanApellidoAcomp",
      "Solo puede ingresar letras en este campo"
    );
  });

document
  .getElementById("lugar_procedencia")
  .addEventListener("change", function () {
    //se obtiene el valor del input
    const valor = document.getElementById("lugar_procedencia").value;
    //se envian los datos a la función
    validarCampo(
      valor,
      /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
      "spanLugarProcedencia",
      "Solo puede ingresar letras en este campo"
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

document.getElementById("lugar_hecho").addEventListener("change", function () {
  //se obtiene el valor del input
  const valor = document.getElementById("lugar_hecho").value;
  //se envian los datos a la función
  validarCampo(
    valor,
    /^[A-ZÁÉÍÓÚÑa-zñáéíóú0-9,. ]{1,50}$/,
    "spanLugar",
    "Solo puede ingresar letras y números en el campo de Lugar"
  );
});

document
  .getElementById("agresor_conocido")
  .addEventListener("change", function () {
    //se obtiene el valor del input
    const valor = document.getElementById("agresor_conocido").value;
    //se envian los datos a la función
    validarCampo(
      valor,
      /^[A-ZÁÉÍÓÚÑa-zñáéíóú0-9,. ]{1,50}$/,
      "spanAgresorConocido",
      "Solo puede ingresar letras y números en el campo de Lugar"
    );
  });


  document
  .getElementById("instrumento_nuevo")
  .addEventListener("input", function () {
    //se obtiene el valor del input
    const valor = document.getElementById("instrumento_nuevo").value;
    //se envian los datos a la función
    validarCampo(
      valor,
      /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
      "spanInstrumento",
      "Solo puede ingresar letras en el campo",
      "guardarInstrumento"
    );
  });


  document
  .getElementById("ocupacion_nueva")
  .addEventListener("input", function () {
    //se obtiene el valor del input
    const valor = document.getElementById("ocupacion_nueva").value;
    //se envian los datos a la función
    validarCampo(
      valor,
      /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
      "spanOcupacion",
      "Solo puede ingresar letras en el campo",
      "guardarOcupacion"
    );
  });


  document
  .getElementById("nacionalidad_nuevo")
  .addEventListener("input", function () {
    //se obtiene el valor del input
    const valor = document.getElementById("nacionalidad_nuevo").value;
    //se envian los datos a la función
    validarCampo(
      valor,
      /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]{1,50}$/,
      "spanNacionalidad",
      "Solo puede ingresar letras en el campo",
      "guardarNacionalidad"
    );
  });


  document.getElementById("dni").addEventListener("input", function() {
    //se obtiene el valor del input
    const valor = document.getElementById("dni");
    //se envian los datos a la función
    limitarCaracteresNumericos(valor, 13);
  });


  document.getElementById("dni_acomp").addEventListener("input", function() {
    //se obtiene el valor del input
    const valor = document.getElementById("dni_acomp");
    //se envian los datos a la función
    limitarCaracteresNumericos(valor, 13);
  });

  document.getElementById("telefono").addEventListener("input", function() {
    //se obtiene el valor del input
    const valor = document.getElementById("telefono");
    //se envian los datos a la función
    limitarCaracteresNumericos(valor, 10);
  });


  document.getElementById("edad").addEventListener("input", function() {
    //se obtiene el valor del input
    const valor = document.getElementById("edad");
    //se envian los datos a la función
    limitarCaracteresNumericos(valor, 3);
  });

