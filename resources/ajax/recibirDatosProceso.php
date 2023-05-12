<?php
$peticion = true;
require_once "../../config/App.php";

/**
 * Recibe los datos del formulario para pasar al controlador de creación
 */
if (isset($_POST)){

  require_once "../../controllers/CrearProcesoControlador.php";
  $proceso = new CrearProcesoControlador();

  echo $proceso->crear_proceso_controlador($_POST);

} else {
    session_start(['name' => 'sistemaProcesos']);
    session_unset();
    session_destroy();
    header("location: " . SERVER . "home/");
    exit();
}