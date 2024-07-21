/* constante que obtiene el boton Enviar del formulario
en caso de que alguna de las validaciones detecte que no se estan ingresando los datos que se debe
el boton Enviar queda deshabilitado */
const botonEnviar = document.getElementById("btn-enviar"); 


/* Función de Validar campos
La función utiliza cuatro parámetros:
-El valor del campo a validar
-La expresión regular que servirá para realizar la validación
-El id del span que mostrará un mensaje de error en caso de que 
el valor no concuerde con la expresión regular
-El mensaje de error */
function validarCampo(valor, regex, spanId, mensaje) {
  // Validar el valor utilizando la expresión regular
  if (!regex.test(valor)) {
    document.getElementById(spanId).textContent = mensaje;
    botonEnviar.disabled = true;
  } else {
    document.getElementById(spanId).textContent = "";
    botonEnviar.disabled = false;
  }
}

/* Llamados a la función de validarCampo
Se usa un evento que detecte si el campo ha sido llenado */
document.getElementById("puesto").addEventListener("input", function() {
  //se obtiene el valor del input
  const valor = document.getElementById("puesto").value;
  //se envian los datos a la función
  validarCampo(valor, /^[A-ZÁÉÍÓÚÑa-zñáéíóú ]+$/, "spanNombre", "Solo puede ingresar letras en el campo Nombre");
});