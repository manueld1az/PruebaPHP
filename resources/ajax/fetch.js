const formularios = document.querySelectorAll(".formulario");

/**
 * Función para enviar datos de formulario hacia PHP para procesarlos,
 * a través de FETCH API, de JavaScript y generar alertas.
 */
function eviar_formulario(e) {
  e.preventDefault();

  let data = new FormData(this);
  let method = this.getAttribute("method");
  let action = this.getAttribute("action");
  let tipo = this.getAttribute("data-form");

  let headers = new Headers();

  let config = {
    method: method,
    headers: headers,
    mode: "cors",
    cache: "no-cache",
    body: data,
  };

  let contenidoAlerta;

  if (tipo == "SAVE") {
    contenidoAlerta = "El registro se ha creado correctamente";
  }else if (alerta.Alerta === "redireccion"){
    window.location.href=alerta.URL;
  }

  /***
   *AQUI SE ENVIA LA ALERTA A LA INTERFAZ
   */
  (() => {
    fetch(action, config)
      .then((respuesta) => respuesta.json())
      .then(() => {
        document.getElementById("contenidoAlerta").innerText = contenidoAlerta;
      });
  })();
}

formularios.forEach((formulario) => {
  formulario.addEventListener("submit", eviar_formulario(e));
});
