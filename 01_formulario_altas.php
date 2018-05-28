<!DOCTYPE html>
<html lang="es">
<head>
	<title>Alta de Autores y Libros</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/estilos_biblioteca.css" />
</head>
<body>
	<section id="contenedor"> <!-- *************** Abrimos el contenedor ****************************** -->

		<?php 
			 
			require 'cabecera.php';
		 
		 ?>

		<section id="portada"> <!-- *************** Abrimos la portada ****************************** -->

			<section id="juntos"> <!-- *************** Abrimos juntos ****************************** -->

					<form name="formulario" action="02_procesar_altas.php" method="post" enctype="multipart/form-data">
						<div class="formulario_altas">
							<p class="titular">Alta de Autor</p>
								<label>Nombre:</label>				
								<input type="text" name="nombre" required>
								<label>Apellidos:</label>
								<input type="text" name="apellidos">
							<p class="titularlibro">Alta de Libro</p>
								<label>Título:</label>
								<input type="text" name="titulo" required>
								<label>Año:</label>
								<input type="text" name="fecha" required>
								<label>Género:</label>
								<input type="text" name="genero" required>
								<label>Editorial:</label>
								<input type="text" name="editorial" required>
								<label>Argumento:</label>
								<input type="text" name="argumento" required>
								<label>Portada:</label>
								<input type="file" name="portada_fls">
								<input type="submit" name="grabar_btn" value="Grabar">
								<input type="reset" value="Borrar">
						</div>
						

						<div class="mensajes">
						<?php 
								if(isset($_GET['mensajes'])){
									$mensajes=$_GET['mensajes'];
									// Desserializamos el array.
									$mensajes=unserialize($mensajes);
									
									$mensaje=	$mensajes['mensaje'];
									$mensa_p=	$mensajes['mensa_p'];
									$nombre= 	$mensajes['nombre'];
									$apellidos= $mensajes['apellidos'];
									$titulo= 	$mensajes['titulo'];
									$fecha=		$mensajes['fecha'];
									$genero=	$mensajes['genero'];
									$editorial=	$mensajes['editorial'];
									$portada=	$mensajes['portada'];

									echo "<div class='imagen'>";
										echo "<img src=$portada alt='Error al cargar la imagen' title='$titulo'/>";
									echo "</div>";

									echo "<div class='resumen'>";
										echo "<p class=''>$titulo</p>";
										echo "<p class=''>$nombre&nbsp$apellidos</p>";
										echo "<p class=''>$fecha</p>";
										echo "<p class=''>$genero</p>";
										echo "<p class=''>$editorial</p>";
										
									echo "</div>";
									
									echo "<div class='palabras'>";
										if($mensaje==1){
											echo "Libro y autor añadidos correctamente a la biblioteca.<br/>";
										} else if($mensaje==2){
											echo "Añadido nuevo autor al libro.<br/>";
										} else if($mensaje==3){
											echo "Autor ya existente en la biblioteca. Añadido un libro nuevo a su bibliografía.<br/>";
										} else if($mensaje==4){
											echo "El Autor ya ha escrito el libro.<br/>";
										} else if($mensaje==5){
											echo "Nuevo Autor añadido al libro.<br/>";
										} else if($mensaje==6){
											echo "Ufff.... Algo pasa. Volvemos en unos minutos. Permanezca a la espera.<br/>";
										} else if($mensaje==7){
											echo "Biblioteca borrada satisfactoriamente.<br/>";
										}
										
										if($mensa_p==1){
											echo "Portada añadida correctamente.<br/>";
										}else if($mensa_p==2){
											echo "Error. No se ha podido subir el archivo.<br/>";
										} else if($mensa_p==3){
											echo "No se seleccionó ninguna portada.<br/>";		
										} else if($mensa_p==4){
											echo "Formato no admitido o excede de 500 Kb.<br/>";
										} else if($mensa_p==5) {
											echo "Algo más pasa.<br/>";
										}
									echo "</div>";
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