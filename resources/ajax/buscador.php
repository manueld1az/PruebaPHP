<?php
session_start(['name' => 'Prueba']);
require_once "../../config/App.php";

/**
 * Buscador de procesos que recibe los inputs de la interfaz a traves de sesiones
 */
if (isset($_POST)){

  if (isset($_POST)){
    session_unset();
    $_SESSION['codigo_proceso'] = $_POST['codigo_proceso'];
    $_SESSION['objeto'] = $_POST['objeto'];
    $_SESSION['responsable'] = $_POST['responsable'];
    $_SESSION['estado'] = $_POST['estado'];
    
    $parametros = [
      "codigo_proceso" => $_POST['codigo_proceso'],
      "objeto" => $_POST['objeto'],
      "responsable" => $_POST['responsable'],
      "estado" => $_POST['estado']];
      
      $_SESSION['parametros'] = $parametros;

    header("location: " . SERVER . "consultarProcesos/");
    exit();

  }
} else {

  session_unset();
  session_destroy();
  header("location: " . SERVER . "home/");
  exit();
}