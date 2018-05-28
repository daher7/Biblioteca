<!DOCTYPE html>
<html lang="es">
<head>
	<title>Listado de biblioteca</title>
	<link rel="stylesheet" href="css/estilos_biblioteca.css" />
	
</head>
<body>

	<section id="contenedor"> <!-- *************** Abrimos el contenedor ****************************** -->

		<section id="cabecera">

			<header>
				<a href="index.html">
					<img src="media/img/cabecera.jpg" alt="Logo" title="Ir a inicio">
				</a>
			</header>
			<nav>
				<ul>
					<li><a href="index.php">Inicio</a></li>
					<li><a href="01_formulario_altas.php">Altas</a></li>
					<li><a href="03_formulario_bajas.php">Bajas</a></li>
					<li><a href="diablo.html">Modificaciones</a></li>
					<li><a href="05_formulario_listado.php">Búsqueda</a></li>
					<li><a href="contacto.html">Contactar</a></li>

				</ul>
			</nav>
		</section> 
		<?php 

		
		if(isset($_POST['buscar_btn'])){
			$nombre=$_POST['nombre'];
			$titulo=$_POST['titulo'];

			//1.- Hacemos la conexion con la base de datos.
			require_once('conexion.php');

			//2.- Vemos por donde venimos para buscar autor o libro. 
			if(empty($nombre) && empty($titulo)){ 			// Ambos vacíos. Error.
				$valor=2;
			} else if(isset($nombre) && empty($titulo)){ 	// Autor introducido.
				$valor=2;
			} else if(isset($titulo) && empty($nombre)){ 	// Libro introducido.
				$valor=3;	
			} else if(isset($nombre, $titulo)){ 			// Ambos escritos. Error.
				$valor=4;
			} 

			//3.- Ejecutamos las funciones y recogemos mensajes de errores.
			switch($valor){
				case 1:
					echo "Escriba algún nombre o títutlo";
					break;
				case 2:
					$consulta="SELECT * FROM autores WHERE nombre LIKE '%$nombre%' OR apellidos LIKE '%$nombre%' ORDER BY nombre, apellidos;";
					$resultado=mysqli_query($conexion, $consulta);
					$autores=mysqli_num_rows($resultado);
					echo "<h1>Se han encontrado $autores autores</h1>";
					while($datos=mysqli_fetch_array($resultado)){
						$nombre=	$datos['nombre'];
						$apellidos=	$datos['apellidos'];
						echo $nombre." ".$apellidos."<br/>";
					}
					break;
				case 3:
					$consulta="SELECT * FROM libros WHERE titulo LIKE '%$titulo%' ORDER BY titulo;";
					$resultado=mysqli_query($conexion, $consulta);
					$libros=mysqli_num_rows($resultado);
					echo "<h1>Se han encontrado $libros libros</h1>";
					while($datos=mysqli_fetch_array($resultado)){
						$titulo=	$datos['titulo'];
						$portada=	$datos['portada'];
						
						echo "<div class='portada'>";
							echo "<img src='$datos[portada]' alt='Error al cargar la imagen'>";
						echo "</div>";
					}
					break;
				case 4:
					echo "Sólo se permite buscar un autor o un libro";
					break;
			}

			//4.- Cerramos la conexion con la base de datos.
			mysqli_close($conexion);
		} else {
			// No has venido por el formulario.
			echo "Mal sitio";
		}
		?>

	</section> <!-- ***************Cerramos el contenedor****************************** -->

</body>
</html>


