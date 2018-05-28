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
			if(isset($_SESSION["logged"])){
				require 'cabecera.php'; // Llamamos a cabecera si nos hemos logueado.
			} else {
				require 'cabecera1.php'; // Llamamos a la cabecera1 si no nos hemos logueado.
			}
		 ?>
		<section id="principal"> <!-- *************** Abrimos el principal ****************************** -->
			<?php 
				// 1.- Realizamos la conexion con la base de datos.
				require_once 'conexion.php';

				// 2.- Ejecutamos la query y guardamos la informacion.
				$consulta1="SELECT * FROM libros ORDER BY titulo;";
				if(isset($cod_usuario)){
					$consul="SELECT alias FROM usuarios WHERE cod_usuario='$cod_usuario';";
					$resul=mysqli_query($conexion, $consul);
				}
				$resultado1=mysqli_query($conexion, $consulta1);
				
				$libros_totales=mysqli_num_rows($resultado1); // Para saber el número de libros que hay en la base de datos.
				
			?>
			<section id="encabezado"> <!-- *************** Abrimos el encabezado ****************************** -->
			<?php 
				
				// Para mostrar el alias de quien está conectado.
				
				if(isset($login)){
					while($datos=mysqli_fetch_array($resul)){
						$alias=$datos["alias"];
						echo "<p class='alias'>Hola $alias</p>";
					}
				}
					
				// 3.- Programamos la paginación.
				// Para que haya paginación, tiene que haber libros en la base de datos.

				if($libros_totales>0){
					echo "<p class='totales'>Tienes $libros_totales libros en tu Biblioteca</p>"; // Mostramos el número de libros que hay en la base de datos.

					$libros_pagina=35; // Limitamos los libros que se van a mostrar en cada pagina.
					$pagina=FALSE;

					if(isset($_GET["pagina"])){
						$pagina=$_GET["pagina"];
					}

					if(!$pagina){ // Si no existe la pagina, la creamos y la inicializamos en 0.
						$start=0;
						$pagina=1;
					} else {
						$start=($pagina-1) * $libros_pagina; //
					}

					$total_paginas=ceil($libros_totales/$libros_pagina); // ceil redondea al siguiente número entero más alto.
					$consulta2="SELECT * FROM libros ORDER BY titulo LIMIT {$start}, {$libros_pagina};";
					$resultado2=mysqli_query($conexion, $consulta2);

				} else {
					echo "<p>No hay ningún libro en tu biblioteca</p>";
				}

			 ?>	
					
			</section> <!-- *************** Cerramos el encabezado ****************************** -->
			<section id="estanteria"> <!-- *************** Abrimos la estanteria ****************************** -->
				<?php 

					while($datos=mysqli_fetch_array($resultado2)){
						$cod_libro=	$datos["cod_libro"];
						$titulo=	$datos["titulo"];
						$portada=	$datos["portada"];

						// 4.- Mostramos la portadas de los libros, 7 x fila.
						echo "<div class='filas'>";
							echo "<a href='07_procesar_portada.php?cod_libro=$cod_libro'><img src='$datos[portada]' alt='Error al cargar la imagen' title='$titulo'/></a>";
						echo "</div>";
					}
				?>
			</section> <!-- *************** Cerramos la estaneria ****************************** --> 
			<section id="cajon"> <!-- *************** Abrimos el cajon ****************************** -->
				<?php
					// 5.- Dibujamos los botones de la paginacion.
					if($libros_totales > 35){ // Cuando haya más de 35 libros en la pagina.
						echo "<ul class='paginacion'>";
							$retroceder=$pagina-1;
							echo "<li><a href=?pagina=".$retroceder." title='pagina anterior'> << </a></li>"; // Avanzar pagina.
							// Para saber en la pagina que estamos.
							for($i = 1; $i<=$total_paginas; $i++){
									// Si estamos en la pagina actual, muestra un enlace vacío.
									if($pagina == $i){ 	
										echo "<li class=''><a href=# >$i</a></li>"; //Enlace vacío.
									} else {
										echo "<li class=''><a href=?pagina=$i>$i</a></li>"; // Enlace a las distintas páginas.
									}
							}
							
							$avanzar=$pagina+1;
							if($avanzar<=$total_paginas){ 
								echo "<li><a href=?pagina=".$avanzar." title='pagina siguiente'> >> </a></li>"; 
							} else { 	
								echo "<li><a href=?pagina=".$total_paginas." title='pagina siguiente'> >> </a></li>"; 
							}
							echo "</a></li>";
						echo "</ul>";
					}


					// 5.- Cerramos la conexion.
					mysqli_close($conexion);
				 ?>
			</section> <!-- *************** Cerramos el cajon ****************************** -->
	
		</section> <!-- *************** Cerramos el principal ****************************** -->

	</section> <!-- ***************  Cerramos el contenedor      ****************************** -->

</body>
</html>
