

document.addEventListener("DOMContentLoaded", function () {
  //Cargar roles
  let url = base_url + "plazas/getPlazas/";
  axios
    .get(url)
    .then(function (response) {
      // Llenar Select
      if((response.data.plazas == undefined && response.data.plazas == null)){
        const row = document.createElement("div");
        const h6 = document.createElement("h6");
        h6.textContent=(`No hay premios ganados`);
        row.appendChild(h6);
      }

      response.data.plazas.forEach((opcion) => {
        let row = document.querySelector('.contenedor-plazas');
        const columna = document.createElement("div");
        columna.classList.add('col-md-4');

        const card = document.createElement("div");
        card.classList.add('card', 'p-3', 'mb-2');

        const contenedorFlex = document.createElement("div");
        contenedorFlex.classList.add('d-flex', 'justify-content-between');

        const contenedorFlex2 = document.createElement("div");
        contenedorFlex2.classList.add('d-flex', 'flex-row', 'align-items-center');

        const contenedorIcono = document.createElement("div");
        contenedorIcono.classList.add('icon');

        const Icono = document.createElement("i");
        Icono.classList.add('bx', 'bx-briefcase');

        const contenedorArea = document.createElement("div");
        contenedorArea.classList.add('ms-2', 'c-details');

        const h6 = document.createElement("h6");
        h6.classList.add('mb-0');
        h6.textContent=opcion.AREA;


        const botonAplicar = document.createElement("div");
        botonAplicar.classList.add('badge');
        const spanAplicar = document.createElement("span");
        spanAplicar.textContent='Disponible';

        const otroContenedor = document.createElement("div");
        otroContenedor.classList.add('mt-5');

        const h3 = document.createElement("h3");
        h3.classList.add('heading');
        h3.textContent=opcion.NOMBRE;

        const enlace = document.createElement('a');
        enlace.href = base_url + "usuarios/verOferta?id="+opcion.ID_PLAZA;

        const botonPostulacion= document.createElement("button");
        botonPostulacion.classList.add('btn', 'btn-primary');
        botonPostulacion.textContent='Ver Oferta';
        enlace.appendChild(botonPostulacion);

        otroContenedor.appendChild(h3);
        otroContenedor.appendChild(enlace);

        contenedorIcono.appendChild(Icono);
        contenedorFlex2.appendChild(contenedorIcono);

        contenedorArea.appendChild(h6);
      
        contenedorFlex2.appendChild(contenedorArea);
        
        botonAplicar.appendChild(spanAplicar);
        contenedorFlex2.appendChild(botonAplicar);
        contenedorFlex.appendChild(contenedorFlex2);

        card.appendChild(contenedorFlex);
        card.appendChild(otroContenedor);

        columna.appendChild(card);
        row.appendChild(columna);
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });

    let id=document.querySelector('#id_plaza')
    let url2 = base_url + "usuarios/getPlaza/"+id;
  axios
    .get(url2)
    .then(function (response) {
      // Llenar Select
      document.querySelector('#nombre-plaza').textContent=data.plazas.NOMBRE;

     
      });
    })
    .catch(function (error) {
      // Maneja errores
      console.error("Ocurrió un error:", error);
    });
