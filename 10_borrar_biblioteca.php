<?php 

require_once('conexion.php');
require_once('funciones.php');

borrarBiblioteca($conexion);

mysqli_close($conexion);

$mensaje=7;
header("Location:01_formulario_altas.php?mensaje=$mensaje");

 ?>