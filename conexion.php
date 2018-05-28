<?php

	session_start(); // Para iniciar la sesión.

	$conexion=mysqli_connect("localhost", "root", "", "biblioteca") or die ("Problemas con la conexion");

	mysqli_query($conexion, "SET NAMES 'utf8'");

?>