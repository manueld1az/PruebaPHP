<?php
if ($peticion) {
  require_once '../../models/CrearProcesoModelo.php';
} else {
  require_once './models/CrearProcesoModelo.php';
}

class CrearProcesoControlador extends CrearProcesoModelo
{
  /**
   * Metodo para crear nuevos procesos
   */
  public function crear_proceso_controlador($datos)
  {
    $valoresInputs = array_values($datos);
    $nombresInputs = array_keys($datos);
    $clavesTabla = implode(",", $nombresInputs);

    $datosValidados = GestionarPeticiones::sanear_valor_input($valoresInputs);
    $crearProceso = CrearProcesoModelo::crear_proceso_modelo($clavesTabla, $valoresInputs);

    if ($crearProceso->rowCount() == 1) {
      $alerta = [
        "Alerta" => "limpiar",
        "Mensaje" => "Proceso creado correctamente",
        "Tipo" => "succes"
      ];
    } else {
      $alerta = [
        "Alerta" => "Error",
        "Mensaje" => "NO se creo el proceso",
        "Tipo" => "error"
      ];
    }
    session_start();
    $_SESSION['alerta'] = json_encode($alerta);
    header("location: " . SERVER . "consultarProcesos/");
    exit();
  }

  /**
   * Metodo para seleccionar todos los registros
   */
  public function seleccionar_procesos_controlador()
  {
    $sql = "SELECT * FROM procesos ORDER BY codigo_proceso ASC";
    $conexion = GestionarPeticiones::conectar();
    $datos = $conexion->query($sql);
    $datos = $datos->fetchAll();

    $filas = "";
    if (count($datos) == 0 || count($datos) == NULL) {
      $filas = "<tr><td>No hay registros disponibles</td></tr>";
    } else {
      foreach ($datos as $key => $value) {
        $filas = $filas . "<tr>
          <td>" . $value['codigo_proceso'] . "</td>
          <td>" . $value['objeto'] . "</td>
          <td>" . $value['descripcion'] . "</td>
          <td>" . $value['fecha_inicio'] . "</td>
          <td>" . $value['fecha_cierre'] . "</td>
          <td>" . $value['estado'] . "</td>
          <td>" . $value['responsable'] . "</td>
          <td>
            <div class='contendorBotones'>
              <a href='' class='btn btn-warning'>Editar</a>
              <form action='' method='POST' class='d-inline'>
                <button type='submit' class='btn btn-danger mx-1'>Eliminar</button>
              </form>
            </div>
          </td></tr>";
      }
    }
    return $filas;
  }
}
