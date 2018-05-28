<!DOCTYPE html>
<html lang="es">
<head>
	<title>Baja de Autores o Libros</title>
	<meta charset="utf-8" />
	<script src="js/validacion_formulario.js"></script>
	<link rel="stylesheet" href="css/estilos_biblioteca.css" />
</head>
<body>
	<section id="contenedor"> <!-- *************** Abrimos el contenedor ****************************** -->

		<?php 
			require 'cabecera.php'; // Llamamos a cabecera si nos hemos logueado.
			
		 ?>

		<section id="portada"> <!-- *************** Abrimos la portada ****************************** -->

			<section id="juntos"> <!-- *************** Abrimos juntos ****************************** -->

					<form name="formulario" action="04_procesar_bajas.php" method="post" enctype="multipart/form-data">
						<div class="formulario_bajas">
							<div class="baja_autor">
								<p class="titular">Eliminar Autor</p>
								<label>Nombre:</label>				
								<input type="text" name="nombre">
								<label>Apellidos:</label>
								<input type="text" name="apellidos">

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
										 				echo "<option class='elegidos' value=$dato1[cod_autor]>$dato1[nombre] $dato1[apellidos]</option>";
										 			}
									 	echo "</select>";
									
									}else {
										echo "error";
									}
								 ?>

								<p class="aclaracion">Al eliminar un autor se eliminará su bibliografía.</p>
							</div>
							<div class="baja_libro">
								<p class="titular">Eliminar Libro</p>
								<label>Titulo:</label>
								<input type="text" name="titulo">
								<label>Título:</label>
								<?php 
									$consulta2="SELECT * FROM libros ORDER BY titulo;";
									$resultado2=mysqli_query($conexion, $consulta2);
									if($resultado2=mysqli_query($conexion,$consulta2)){
										echo "<select name='libros'>
										 		<option value='0'>Seleccione un Libro</option>";
										 			while($dato2=mysqli_fetch_array($resultado2)){
										 				echo "<option class='elegidos' value=$dato2[cod_libro]>$dato2[titulo]</option>";
										 			}
									 	echo "</select>";
									
									}else {
										echo "error";
									}
									// Cerrar conexion
									mysqli_close($conexion);

								 ?>
							</div>
							<div class="inputes_bajas">	
								<input type="button" name="eliminar_btn" value="Eliminar" onclick="validar()">
								<input type="reset" value="Limpiar">
							</div>

						</div>
						<div class="mensajes_bajas">
							
						<?php 
							if(isset($_GET['mensaje'])){
								$mensaje=$_GET['mensaje'];
								switch ($mensaje){
									case 1:
										echo "El autor no existe en la biblioteca";
										break;
									case 2:
										echo "El autor y su bibliografia han sido borrados correctamente";
										break;
									case 3:
										echo "El libro no existe en la biblioteca.";
										break;
									case 4:
										echo "El libro ha sido borrado de la biblioteca.";
										break;
									default:
										echo "Otros";
										break;
								}
							}
						?>
						</div>
					</form>
				</section>
		
			</section>	<!-- *************** Cerramos juntos ****************************** -->
			
		</section> <!-- *************** Cerramos la portada ****************************** -->
				
	</section> <!-- ***************  Cerramos el contenedor      ****************************** -->

</body>
</html>