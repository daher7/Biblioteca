<?php 

echo "<meta charset='UTF-8'>";

	$nombre=	$_POST['nombre'];
	$apellidos=	$_POST['apellidos'];
	$titulo=	$_POST['titulo'];
	$cod_autor=	$_POST['autores'];
	$cod_libro=	$_POST['libros'];

	//1.- Conexion con la base de datos.
	require_once('conexion.php');

	//2.- Llamamos a las funciones.
	require('funciones.php');
	
	
	//3.- Vemos por donde venimos para dar de baja autor o libro. 
	if($nombre!=""){ 			// Autor introducido.
		$valor=1;
	} else if($titulo!=""){ 	// Libro introducido.
		$valor=2;	
	} else if($cod_autor!=0){	// Autor del desplegable.
		$valor=3;
	} else if($cod_libro!=0){	// Libro del desplegable.
		$valor=4;
	}
 	
 	//4.- Ejecutamos las funciones y recogemos mensajes de errores.
 	switch($valor){
 		
 		case 1:
 			$autor=comprobarAutor($conexion, $nombre, $apellidos); // Para comprobar que el nombre y los apellidos estén bien escritos.
 			if($autor==0){
 				$mensaje=1; 
 			} else {
 				$cod_autor=codAutor($conexion, $nombre, $apellidos);
 				borrarAutor($conexion, $cod_autor);
 				// seleccionamos todos los cod_libro que hay en la tabla libros
				$cod_libros=soloCodLibro($conexion);
				// seleccionamos todos los cod_libro que hay en autores_libros. 
				$cod_libros_autores=codLibroConAutores($conexion);
				// Comparamos ambos arrays, y los cod_libro que no estén en la tabla autores_libros, son los libros no vinculados que hay que borrar.
				$codigos=array_diff($cod_libros, $cod_libros_autores);
				foreach($codigos AS $cod_libro){
					borrarLibro($conexion, $cod_libro);
				}
				$mensaje=2;
 			}
 			break;
 		case 2:
 			$libro=comprobarLibro($conexion, $titulo);	// Para comprobar que el titulo esté bien escrito.
 			if($libro==0){
 				$mensaje=3;
 			} else {
 				$cod_libro=codLibro($conexion, $titulo);
 				borrarLibro($conexion, $cod_libro);
 				// seleccionamos todos los cod_autor que hay en la tabla autores.
 				$cod_autores=soloCodAutor($conexion);
 				// seleccionamos todos los cod_autor que hay en autores_libros.
 				$cod_autores_libros=codAutorConLibros($conexion);
 				// Comparamos ambos arrays, y los cod_autores que no estén en la tabla autores_libros, son los autores no vinculados que hay que borrar.
 				$codigos=array_diff($cod_autores, $cod_autores_libros);
				foreach($codigos AS $cod_autor){
					borrarAutor($conexion, $cod_autor);
				}
				comprobarUltimoLibro($conexion);
 				$mensaje=4;
 			}
 			break;
 		case 3:
 			borrarAutor($conexion, $cod_autor);
			// seleccionamos todos los cod_libro que hay en la tabla libros
			$cod_libros=soloCodLibro($conexion);
			// seleccionamos todos los cod_libro que hay en autores_libros. 
			$cod_libros_autores=codLibroConAutores($conexion);
			// Comparamos ambos arrays, y los cod_libro que no estén en la tabla autores_libros, son los libros no vinculados que hay que borrar.
			$codigos=array_diff($cod_libros, $cod_libros_autores);
			foreach($codigos AS $cod_libro){
				borrarLibro($conexion, $cod_libro);
			}
			$mensaje=2;
			break;
		case 4:
			borrarLibro($conexion, $cod_libro);
			// seleccionamos todos los cod_autor que hay en la tabla autores.
			$cod_autores=soloCodAutor($conexion);
			// seleccionamos todos los cod_autor que hay en autores_libros.
			$cod_autores_libros=codAutorConLibros($conexion);
			// Comparamos ambos arrays, y los cod_autores que no estén en la tabla autores_libros, son los autores no vinculados que hay que borrar.
			$codigos=array_diff($cod_autores, $cod_autores_libros);
			foreach($codigos AS $cod_autor){
				borrarAutor($conexion, $cod_autor);
			}
			comprobarUltimoLibro($conexion);
			$mensaje=4;
			break;
 	}
	//5.- Cerramos la conexion con la base de datos.
	mysqli_close($conexion);

// Devolvemos la informacion al formulario.
header("Location:03_formulario_bajas.php?mensaje=$mensaje");


 ?>