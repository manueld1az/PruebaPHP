<?php
require_once "./config/App.php";
require_once "./controllers/ControladorVistas.php";

$plantilla = new ControladorVistas();
$plantilla ->obtener_plantilla_controlador();
