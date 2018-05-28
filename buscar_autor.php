<!DOCTYPE html>
<html lang="es">
<head>
	<title>Búsqueda de Autores o Libros</title>
	<meta charset="utf-8" />
	<script src="js/validacion_autor.js"></script>
	<link rel="stylesheet" href="css/estilos_biblioteca.css" />
</head>
<body>
	<section id="contenedor"> <!-- *************** Abrimos el contenedor ****************************** -->
		<?php 
			
			if(isset($login)){
				require 'cabecera.php'; // Llamamos a cabecera si nos hemos logueado.
			} else {
				require 'cabecera1.php'; // Llamamos a la cabecera1 si no nos hemos logueado.
			}
		 ?>

		<section id="portada"> <!-- *************** Abrimos la portada ****************************** -->

			<section id="juntos"> <!-- *************** Abrimos juntos ****************************** -->

					<form name="formulario" action="buscar_autor.php" method="get" enctype="application/x-form-www-urlencoded">
						<div class="formulario_busqueda">
							<div class="buscar_autor">
								<p class="titular">Buscar Autor</p>
								<p class="opcion">a) Escribe su nombre</p>
								<label>Nombre:</label>				
								<input type="text" name="nombre">
								<label>Apellidos:</label>
								<input type="text" name="apellidos">

								<p class="desplegable">b) Selecciónalo del desplegable</p>
								<label>Autor:</label>
								<?php 
									// 1- Establecemos la conexion con la base de datos.
									require_once('conexion.php');
									// 2- Ejecutamos las querys.
									$consulta1="SELECT * FROM autores GROUP BY nombre, apellidos;";
									$resultado1=mysqli_query($conexion, $consulta1);
									if($resultado1=mysqli_query($conexion,$consulta1)){
										echo "<select name='autores'>
										 		<option value='0'>Seleccione un Escritor</option>";
										 			while($dato1=mysqli_fetch_array($resultado1)){
										 				echo "<option class='elegidos' value=$dato1[cod_autor]> $dato1[nombre] $dato1[apellidos]</option>";
										 			}
									 	echo "</select>";
										
									}else {
										echo "error";
									}
								 ?>
								
								 <p class="volver"><a href="05_formulario_busqueda.php">--Volver a la búsqueda--</a></p>

							</div>
							
							<div class="inputes_busqueda">	
								<input type="button" name="buscar_btn" value="Buscar" onclick="validar()">
								<input type="reset" value="Limpiar">
							</div>

						</div>
						
						<div class="mensajes">
							
						<?php 
							// Buscamos el autor por formulario:
							if(isset($_GET["nombre"]) && $_GET["nombre"]!=""){
																
								$nombre=	$_GET["nombre"];
								$apellidos=	$_GET["apellidos"];
								$consulta2="SELECT * FROM autores WHERE nombre LIKE '%$nombre%' AND apellidos LIKE '%$apellidos%';";
								$resultado2=mysqli_query($conexion, $consulta2);
								$total=mysqli_num_rows($resultado2);
								echo "<h1 class=''>";
									if($total==1){
										echo "Se ha encontrado 1 resultado";
									} else {
										echo "Se han encontrado ".$total." resultados";
									}
								echo "</h1>";

								while($dato2=mysqli_fetch_array($resultado2)){
									//$cod_autor=	$dato2["cod_autor"];
									$nombre=	$dato2["nombre"];
									$apellidos=	$dato2["apellidos"];

									echo "<div class='columnas'>";
										echo "-".$nombre." ".$apellidos;
									echo "</div class>";
								}
							// Buscamos autor por desplegable:
							} else if(isset($_GET["autores"]) && $_GET["autores"]!=0){
								
								$cod_autor=	$_GET["autores"];  // de autores sacamos el cod_autor
								$consulta2="SELECT * FROM autores, libros, autores_libros
											WHERE autores.cod_autor=autores_libros.cod_autor
											AND libros.cod_libro=autores_libros.cod_libro
											AND autores.cod_autor='$cod_autor' GROUP BY titulo;";
								$resultado2=mysqli_query($conexion, $consulta2);
								$total=mysqli_num_rows($resultado2);
								echo "<h1 class=''>";
									if($total==1){
										echo "Se ha encontrado 1 resultado";
									} else {
										echo "Se han encontrado ".$total." resultados";
									}
								echo "</h1>";
								while($dato2=mysqli_fetch_array($resultado2)){
									$cod_libro=$dato2["cod_libro"];
									$titulo=$dato2["titulo"];

									echo "<div class='columnas'>";
										echo "<a href='07_procesar_portada.php?cod_libro=$cod_libro'>*".$titulo."<br/></a>";
									echo "</div class>";
								}
								
							}
							// Cerramos la conexion
							mysqli_close($conexion);
							?>
						</div>
					</form>
				</section>
		
			</section>	<!-- *************** Cerramos juntos ****************************** -->
			
		</section> <!-- *************** Cerramos la portada ****************************** -->
				
	</section> <!-- ***************  Cerramos el contenedor      ****************************** -->

</body>
</html>