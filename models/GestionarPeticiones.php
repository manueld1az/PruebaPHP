<?php
if ($peticion) {
  require_once "../../config/Conexion.php";
} else {
  require_once "./config/Conexion.php";
}

class GestionarPeticiones
{
  /***
   * Método para gestionar conexiones desde controladores
   */
  protected static function conectar()
  {
    $conexion = new PDO(GESTOR, USUARIO, CONTRASEÑA);
    $conexion->exec("SET CHARACTER SET utf8");
    return $conexion;
  }

  /**
   * Método para validar datos y limpiar datos dependiendo su tipo
   */
  protected static function sanear_valor_input($valoresInputs)
  {
    foreach ($valoresInputs as $valorInput) {
      if (is_numeric($valorInput)) {
        $valoresValidados = filter_input(INPUT_POST, $valorInput, FILTER_VALIDATE_INT);
      } else if (is_string($valorInput)) {
        $valoresValidados = filter_input(INPUT_POST, $valorInput, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }
    return $valoresValidados;
  }
}
