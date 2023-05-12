<?php
class ObtenerVistas
{
  /**
   * Método orquestador de rutas
   */
  protected static function obtener_vistas_modelo($vista)
  {

    $vistasPermitidas = [
      "base",
      "crearProceso",
      "consultarProcesos"
    ];

    if (in_array($vista, $vistasPermitidas)) {
      $contenido = "./views/" . $vista . ".php";
    } else if ($vista == "home" || $vista == "index" || $vista == "") {
      $contenido = "home";
    } else {
      $contenido = "404";
    }

    return $contenido;
  }
}
