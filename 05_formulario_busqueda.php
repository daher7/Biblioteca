<!DOCTYPE html>
<html lang="es">
<head>
	<title>Búsqueda de Autores o Libros</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/estilos_biblioteca.css" />
</head>
<body>
	<section id="contenedor"> <!-- *************** Abrimos el contenedor ****************************** -->
		<?php 
			
			// Vamos a comprobar si nos hemos logueado.  
			// De ser así, podremos acceder a todos las opciones de la biblioteca, sino, solo podemos mirarla.
			if(isset($login)){
				require 'cabecera.php'; // Llamamos a cabecera si nos hemos logueado.
			} else {
				require 'cabecera1.php'; // Llamamos a la cabecera1 si no nos hemos logueado.
			}
		 ?>
		
		<section id="portada"> <!-- *************** Abrimos la portada ****************************** -->

			<section id="juntos"> <!-- *************** Abrimos juntos ****************************** -->

					
						<div class="busqueda">
							<p class="titulo"><u>Búsqueda</u></p>
							<ul>
								<li><a href="buscar_autor.php"><em>1.- Autor</em></a></li>	
								<li><a href="buscar_libro.php"><em>2.- Título</em></a></li>
								<li><a href="buscar_fecha.php"><em>3.- Año</em></a></li>
								<li><a href="buscar_genero.php"><em>4.- Género</em></a></li>
								<li><a href="buscar_editorial.php"><em>5.- Editorial</em></a></li>
							</ul>
						</div>
						
					
				</section>
		
			</section>	<!-- *************** Cerramos juntos ****************************** -->
			
		</section> <!-- *************** Cerramos la portada ****************************** -->
				
	</section> <!-- ***************  Cerramos el contenedor      ****************************** -->

</body>
</html>