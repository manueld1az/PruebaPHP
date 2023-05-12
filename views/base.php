<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- CDN PARA PODER USAR BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- CDN PARA PODER USAR LOS ICONOS BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../resources/css/global.css">

  <title>Administración de Procesos</title>
</head>

<body>
    <?php
    $peticion = false;
    require_once "./controllers/ControladorVistas.php";

    $instanciaVista = new ControladorVistas();
    $vista = $instanciaVista->obtener_vistas_controlador();

    if ($vista == "404") {
      echo "<h1>ERROR 404:Not Found</h1>";
    } else if ($vista == "home") {
      require_once "./views/home.php";
    } else {
      include $vista;
    }
    ?>
  <!-- CDN PARA PODER USAR BOOTSTRAP -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>