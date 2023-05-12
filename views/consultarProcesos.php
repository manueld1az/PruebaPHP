<?php
require_once "./config/Conexion.php";
session_start(['name' => 'Prueba']);
?>
<header>
  <h3 class="titulo">Procesos / Evento Participación Cerrada</h3>

  <!-- CREAR BOTONES PARA VOLVER AL INDEX -->
  <!-- REVISAR LA CALIDAD DEL CÓDIGO LUEGO MIRAR SI SE MIGRA A LARAVEL -->
  <button class="btn btn-secondary ml-1">
    <a href="<?php echo SERVER; ?>" class="text-white"><i class="bi bi-arrow-left"></i>&nbsp;Volver</a>
  </button>
</header>

<h5>Búsqueda</h5>
<hr class="delimitadorSuperior">

<form action="<?php echo SERVER; ?>resources/ajax/buscador.php" method="POST" class="formulario">
  <div class="row row-cols-3">

    <div class="col">
      <label for="idCerrada" class="form-label">ID cerrada</label>
      <input type="number" class="form-control" name="codigo_proceso" id="idCerrada" aria-describedby="idCerrada" placeholder="Numero id proceso / evento">
    </div>

    <div class="col">
      <label for="objeto" class="form-label">Objeto / Descripción</label>
      <input type="text" class="form-control" name="objeto" id="objeto" aria-describedby="objeto" placeholder="Objeto / Descripción">
    </div>

    <div class="col">
      <label for="creador" class="form-label">Comprador</label>
      <input type="number" class="form-control" name="responsable" id="creador" aria-describedby="creador" placeholder="Responsable Evento">
    </div>

    <div class="col">
      <label for="estado" class="form-label">Estado</label>
      <select class="form-select" id="estado" name="estado">
        <option value="" selected>Todos</option>
        <option value="activo">Activo</option>
        <option value="publicado">Publicado</option>
        <option value="evaluacion">Evaluacion</option>
      </select>
    </div>

  </div>

  <div class="contendorBotones">
    <button type="submit" name="busqueda" value="busqueda" class="btn btn-secondary mx-3">Buscar</button>
    <button type="button" name="" class="btn btn-success">Generar Excel</button>
  </div>
</form>
</section>

<?php
$filtrado = false;
if (isset($_SESSION['parametros'])) {

  $busqueda = $_SESSION['parametros'];

  if (isset($busqueda)) {

    $nombresParametros = array_keys($busqueda);

    $longitud = count($nombresParametros);

    $parametros = [];
    for ($i = 0; $i < $longitud; $i++) {
      $valorPrametro = $busqueda[$nombresParametros[$i]];

      if ($valorPrametro != "") {
        $parametro = $nombresParametros[$i] . ' = "' . $valorPrametro . '" ';
        array_push($parametros, $parametro);
      }
    }
    $parametros = implode("or ", $parametros);

    $sql = "SELECT * FROM prueba.procesos WHERE " . $parametros;
  }
  $conexion = new PDO(GESTOR, USUARIO, CONTRASEÑA);
  $datos = $conexion->query($sql);
  $datos = $datos->fetchAll();

  $filas = "";
  if (count($datos) == 0 || count($datos) == NULL) {
    $filas = "<tr><h3>No hay registros disponibles<h3></tr>";
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
  $filtrado = true;
  session_unset();
}
?>

<!-- TABLA DE PROCESOS -->
  <div class="col-12 mt-1 table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>Id</th>
        <th>Objeto</th>
        <th>Descripción</th>
        <th>Fecha inicio</th>
        <th>Fecha cierre</th>
        <th>Estado</th>
        <th>Responsable de evento</th>
        <th>Acciones</th>
      </tr>
      <tbody id="registros">
        <?php
        if ($filtrado == true) {
          echo $filas;
        } else {
          require_once "./controllers/CrearProcesoControlador.php";
          $selecionarProcesos = new CrearProcesoControlador();
          echo $selecionarProcesos->seleccionar_procesos_controlador();
        }
        ?>
      </tbody>
    </table>
  </div>
</section>