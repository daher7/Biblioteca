<?php 

// LOGIN.
function comprobarUsuario($conexion, $usuario, $contrasena){
	$consulta="SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena ='$contrasena';";
	$resultado=mysqli_query($conexion, $consulta);
	$numero=mysqli_num_rows($resultado);
	return $numero;
}



// ALTAS EN LA BIBLIOTECA.
function grabarAutor($conexion, $nombre, $apellidos){
	$consulta="INSERT INTO autores (nombre, apellidos) VALUES ('$nombre', '$apellidos');";
	mysqli_query($conexion, $consulta);
	$codigo=mysqli_insert_id($conexion);
	return $codigo;
}

function grabarLibro($conexion, $titulo, $fecha, $genero, $editorial, $portada, $argumento){
	$consulta="INSERT INTO libros (titulo, fecha, genero, editorial, portada, argumento) VALUES ('$titulo', '$fecha', '$genero', '$editorial', '$portada', '$argumento');";
	mysqli_query($conexion, $consulta);
	$codigo=mysqli_insert_id($conexion);
	return $codigo;
}

function codAutor($conexion, $nombre, $apellidos){
	$consulta="SELECT cod_autor FROM autores WHERE nombre='$nombre' AND apellidos='$apellidos';";
	$resultado=mysqli_query($conexion, $consulta);
	while($dato=mysqli_fetch_array($resultado)){  // Recogemos el valor de cod_autor.
			$codigo=$dato['cod_autor'];
	}
	return $codigo;
}

function codLibro($conexion, $titulo){
	$consulta="SELECT cod_libro FROM libros WHERE titulo='$titulo';";
	$resultado=mysqli_query($conexion, $consulta);
	while($dato=mysqli_fetch_array($resultado)){  // Recogemos el valor de cod_libro.
			$codigo=$dato['cod_libro'];
	}
	return $codigo;
}

function grabarTerceraTabla($conexion, $cod_autor, $cod_libro){
	$consulta="INSERT INTO autores_libros (cod_autor, cod_libro) VALUES ('$cod_autor','$cod_libro');";
	mysqli_query($conexion, $consulta);
}

function comprobarTerceraTabla($conexion, $cod_autor, $cod_libro){
	$consulta="SELECT * FROM autores_libros WHERE cod_autor='$cod_autor' AND cod_libro='$cod_libro';";
	$resultado=mysqli_query($conexion, $consulta);
	$numero=mysqli_num_rows($resultado);
	return $numero;
}

// BAJAS EN LA BIBLIOTECA:
function comprobarAutor($conexion, $nombre, $apellidos){
	$consulta="SELECT * FROM autores WHERE nombre='$nombre' AND apellidos='$apellidos';";
	$resultado=mysqli_query($conexion, $consulta);
	$numero=mysqli_num_rows($resultado);
	return $numero;
	}

function comprobarLibro($conexion, $titulo){
	$consulta="SELECT * FROM libros WHERE titulo='$titulo';";
	$resultado=mysqli_query($conexion, $consulta);
	$numero=mysqli_num_rows($resultado);
	return $numero;
}

function soloCodLibro($conexion){
	$consulta="SELECT cod_libro FROM libros ORDER BY cod_libro;";
	$resultado=mysqli_query($conexion, $consulta);
	while($datos=mysqli_fetch_array($resultado)){
		$codigos[]=$datos['cod_libro'];
	}
	return $codigos;
}

function soloCodAutor($conexion){
	$consulta="SELECT cod_autor FROM autores ORDER BY cod_autor;";
	$resultado=mysqli_query($conexion, $consulta);
	while($datos=mysqli_fetch_array($resultado)){
		$codigos[]=$datos['cod_autor'];
	}
	return $codigos;
}

function codLibroConAutores($conexion){
	$consulta="SELECT cod_libro FROM autores_libros GROUP BY cod_libro;";
	$resultado=mysqli_query($conexion, $consulta);
	while($datos=mysqli_fetch_array($resultado)){
		$codigos[]=$datos['cod_libro'];
	}
	return $codigos;
}

function codAutorConLibros($conexion){
	$consulta="SELECT cod_autor FROM autores_libros GROUP BY cod_autor;";
	$resultado=mysqli_query($conexion, $consulta);
	while($datos=mysqli_fetch_array($resultado)){
		$codigos[]=$datos['cod_autor'];
	}
	return $codigos;
}

function borrarAutor($conexion, $cod_autor){
	$consulta="DELETE FROM autores WHERE cod_autor='$cod_autor';";
	mysqli_query($conexion, $consulta);
}

function borrarLibro($conexion, $cod_libro){
	$consulta="DELETE FROM libros WHERE cod_libro='$cod_libro';";
	mysqli_query($conexion, $consulta);
}

function comprobarUltimoLibro ($conexion){
	$consulta="SELECT * FROM libros ";
	$resultado=mysqli_query($conexion, $consulta);
	$numero=mysqli_num_rows($resultado);
	if($numero==0){
		borrarBiblioteca($conexion);
	}
}

// BUSQUEDA BIBILIOTECA:

function buscarAutor($conexion, $nombre){
	$consulta="SELECT * FROM autores WHERE nombre LIKE '%$nombre%' OR apellidos LIKE '%$nombre%' ORDER BY nombre, apellidos;";
	$resultado=mysqli_query($conexion, $consulta);
	$autores=mysqli_num_rows($resultado);
	echo "<h1>Se han encontrado $autores autores</h1>";
	while($datos=mysqli_fetch_array($resultado)){
		$nombre=	$datos['nombre'];
		$apellidos=	$datos['apellidos'];
		$nombres=	$nombre." ".$apellidos."<br/>";
	}
	return $nombres;
}

// BORRAR BIBLIOTECA:

function borrarBiblioteca($conexion){
	$consulta1="DELETE FROM autores;";
	$consulta2="ALTER TABLE autores AUTO_INCREMENT=1;";
	$consulta3="DELETE FROM libros;";
	$consulta4="ALTER TABLE libros AUTO_INCREMENT=1;";

	mysqli_query($conexion, $consulta1);
	mysqli_query($conexion, $consulta2);
	mysqli_query($conexion, $consulta3);
	mysqli_query($conexion, $consulta4);
}


 ?>