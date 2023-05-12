<?php
require_once "GestionarPeticiones.php";

class crearProcesoModelo extends GestionarPeticiones
{
  /***
   * Modelo para ejecutar la peticion SQL
   */
  protected static function crear_proceso_modelo($clavesTabla, $datosValidados)
  {
    $registros = [];
    foreach ($datosValidados as $dato) {
      if (is_numeric($dato)) {
        array_push($registros, $dato);
      } else {
        array_push($registros, "'" . $dato . "'");
      }
    }
    $registros = implode(",", $registros);

    $sql = "INSERT INTO prueba.procesos (" . $clavesTabla . ") VALUES (" . $registros . ");";
    $peticion = GestionarPeticiones::conectar()->prepare($sql);
    $peticion->execute();
    return $peticion;
  }
}
