<?php
require_once "./models/ObtenerVistas.php";

class ControladorVistas extends ObtenerVistas
{

  /***
   * Controlador para obtener la plantilla base
   */
  public function obtener_plantilla_controlador()
  {
    return require_once "./views/base.php";
  }

  /***
   * Controlador para obtener vistas
   */
  public function obtener_vistas_controlador()
  {
    if (isset($_GET['view'])) {
      $ruta = explode("/", $_GET['view']);
      $respuesta = ObtenerVistas::obtener_vistas_modelo($ruta[0]);
    } else {
      $respuesta = "home";
    }
    return $respuesta;
  }
}
