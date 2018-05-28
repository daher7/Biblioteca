<!DOCTYPE html>
<html lang="es">
<head>
	<title>Mi colección de Novela Negra</title>
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
			<?php 
				// 1.- Realizamos la conexion con la base de datos.
				require_once('conexion.php');
				// 2.- Recogemos la variable de cod_libro.
				$cod_libro=$_GET['cod_libro'];
				// 3.- Ejecutamos la query y guardamos la informacion.
				$consulta1="SELECT * FROM libros WHERE cod_libro='$cod_libro';";
				$resultado1=mysqli_query($conexion, $consulta1);
				while($datos1=mysqli_fetch_array($resultado1)){
					$titulo=	$datos1['titulo'];
					$fecha=		$datos1['fecha'];
					$genero=	$datos1['genero'];
					$editorial=	$datos1['editorial'];
					$portada=	$datos1['portada'];
					$argumento=	$datos1['argumento'];
					
					//Div para la portada.
					echo "<div class='caratula'>";
						echo "<img src=$portada alt='Error al cargar la imagen' title='$titulo'/>";
					echo "</div>";
					//Div para el resto de la información.
					echo "<div class='descripcion'>";
						echo "<p class='titulo'>$titulo</p>";
						$consulta2=	"SELECT * FROM autores, libros, autores_libros 
									WHERE autores.cod_autor=autores_libros.cod_autor 
									AND libros.cod_libro=autores_libros.cod_libro
									AND libros.cod_libro='$cod_libro' ORDER BY nombre, apellidos;";
						$resultado2=mysqli_query($conexion, $consulta2);
						$autores=	mysqli_num_rows($resultado2); // Para saber si el libro está escrito por un escritor o por varios.
						echo "<p class='linea'><span class='negrita'>Autor:</span>&nbsp;"."</p>";
						while($datos2=mysqli_fetch_array($resultado2)){
							$nombre=	$datos2['nombre'];
							$apellidos=	$datos2['apellidos'];
							
								if($autores!=1){ // Cuando haya mas de un autor.
									echo "<p class='linea'>".$nombre."".$apellidos.",&nbsp;</p>";
									$autores--;
								} else { // Entra por aqui cuando haya solo un autor.
									echo "<p class='linea'>".$nombre." ".$apellidos.".</p>";
								}
						}
						echo "<p class='datos'><span class='negrita'>Año:</span>&nbsp;$fecha</p>";
						echo "<p class='datos'><span class='negrita'>Género:</span>&nbsp;$genero</p>";
						echo "<p class='datos'><span class='negrita'>Editorial:</span>&nbsp;$editorial</p>";
						echo "<p class='datos'><span class='negrita'>Sinópsis:</span>&nbsp;$argumento</p>";

					echo "</div>";
				}
				
			
				mysqli_close($conexion);
			 ?>
			</section>	<!-- *************** Cerramos juntos ****************************** -->
			
		</section> <!-- *************** Cerramos la portada ****************************** -->
				
	</section> <!-- ***************  Cerramos el contenedor      ****************************** -->

</body>
</html>

</body>
</html>