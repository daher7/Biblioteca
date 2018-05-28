<!DOCTYPE html>
<html lang="es">
<head>
	<title>Búsqueda de Autores o Libros</title>
	<meta charset="utf-8" />
	<script src="js/validacion_genero.js"></script>
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

					<form name="formulario" action="buscar_genero.php" method="get" enctype="application/x-form-www-urlencoded">
						<div class="formulario_busqueda">
							<div class="buscar_autor">
								<p class="titular">Buscar Género</p>
								<p class="opcion">a) Escribe el Género</p>
								<label>Género:</label>
								<input type="text" name="genero">

								<p class="desplegable">b) Selecciónalo del desplegable</p>
								<label>Género:</label>
								<?php 
									// 1- Establecemos la conexion con la base de datos.
									require_once('conexion.php');
									$consulta1="SELECT * FROM libros GROUP BY genero;";
									$resultado1=mysqli_query($conexion, $consulta1);
									if($resultado1=mysqli_query($conexion,$consulta1)){
										echo "<select name='generos'>
										 		<option value='0'>Seleccione un Género</option>";
										 			while($dato1=mysqli_fetch_array($resultado1)){
										 				echo "<option class='elegidos' value=$dato1[cod_libro] >$dato1[genero]</option>";
										 			}
									 	echo "</select>";
									
									}else {
										echo "error";
									}
									// Cerrar conexion
									

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
							// Buscamos el genero por formulario:
							if(isset($_GET["genero"]) && $_GET["genero"]!=""){
																
								$genero=$_GET["genero"];
								$consulta2="SELECT * FROM libros WHERE genero LIKE '%$genero%' ORDER BY titulo;";
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
									$genero=	$dato2["genero"];
									$cod_libro=	$dato2["cod_libro"];
									$titulo=	$dato2["titulo"];
									echo "<div class='columnas'>";
										echo "<a href='07_procesar_portada.php?cod_libro=$cod_libro'>*".$titulo."<br/></a>";
									echo "</div class>";
								}
							// Buscamos genero por desplegable:
							} else if(isset($_GET["generos"]) && $_GET["generos"]!=0){
								$cod_libro=$_GET["generos"];  // de generos sacamos el cod_libro
								$consulta2="SELECT * FROM libros WHERE genero IN (SELECT genero FROM libros WHERE cod_libro='$cod_libro');";
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
							// Cerramos la conexion.
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