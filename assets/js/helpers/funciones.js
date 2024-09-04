/* Función de Validar campos
La función utiliza cuatro parámetros:
-El valor del campo a validar
-La expresión regular que servirá para realizar la validación
-El id del span que mostrará un mensaje de error en caso de que el valor no concuerde con la expresión regular
-El mensaje de error */
export function validarCampo(valor, regex, spanId, mensaje) {
    /* constante que obtiene el boton Enviar del formulario
    en caso de que alguna de las validaciones detecte que no se estan ingresando los datos que se debe
    el boton Enviar queda deshabilitado */
    const botonEnviar = document.getElementById("btn-enviar"); 

    // Validar el valor utilizando la expresión regular
    if (!regex.test(valor)) {
        document.getElementById(spanId).textContent = mensaje;
        botonEnviar.disabled = true;
    } else {
        document.getElementById(spanId).textContent = "";
        botonEnviar.disabled = false;
    }
}

/* Función que crea de forma dinamica el contenido de los selects
La funcion usa cuatro parámetros:
-El endpoint del cual obtiene la informacion
-La referencia al elemento select
-El nombre del campo que será utilizado como el texto a mostrar de la opcion
-El id del campo que sera utilizado como el id de la opcion
(Los ultimos dos parametros hacen referencia a campos de la base de datos) */
export function cargarOpcionesSelect(url, selectElement, optionText, optionValue) {
    axios
      .get(url)
      .then(function (response) {
        // Recorrer los datos y agregar las opciones al select
        response.data.forEach((opcion) => {
          let option = document.createElement("option");
  
          option.text = opcion[optionText];
          option.value = opcion[optionValue]; 
          selectElement.appendChild(option);
        });
      })
      .catch(function (error) {
        // Manejar errores
        console.error("Ocurrió un error:", error);
      });
  }