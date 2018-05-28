<?php 

echo "<meta charset='UTF-8'/>";

if(isset($_POST['grabar_btn'])){    // Venimos del formulario.
	$nombre		=$_POST['nombre'];
	$apellidos	=$_POST['apellidos'];
	$titulo		=$_POST['titulo'];
	$fecha		=$_POST['fecha'];
	$genero		=$_POST['genero'];
	$editorial	=$_POST['editorial'];
	$argumento	=$_POST['argumento'];

	// Variables para la portada.
	$archivo=$_FILES['portada_fls']['tmp_name'];
	$destino="media/img/portadas/".$_FILES['portada_fls']['name'];
	$formatos=array("image/jpeg", "image/gif");
	

	//1.- Llamamos al fichero conexion.php. 
	require_once('conexion.php');

	//2.- Llamamos a las funciones:
	require('funciones.php');

	//3.- Ejecutamos las funciones y recogemos mensajes para control de errores:
	//	a.-Al ejecutar grabarAutor, grabamos autor y recogemos el cod_autor.
	$cod_autor=grabarAutor($conexion, $nombre, $apellidos);
						
	if(mysqli_errno($conexion)==1062){
		$mensaje_autor="1";	// Quiere decir que el autor ya existe.
	} else if(mysqli_errno($conexion)==1054 OR mysqli_errno($conexion)==1064 OR mysqli_errno($conexion)==1146){
		$mensaje_autor="2"; //Quiere decir que hay un error grave.
	} else {
		$mensaje_autor="0";	// El autor no existe, por lo que lo grabamos.	
	}

	// b.- Comprobamos si se selecciona portada, y si se sube correctamente
	if($_FILES['portada_fls']['name']==""){ // No se ha elegido portada ya que el índice de nombre está vacío.
		//echo "No se seleccionó portada.";
		$mensaje_portada=2;
	} else {	// Se ha seleccionado portada.
		if(in_array($_FILES['portada_fls']['type'], $formatos) AND $_FILES['portada_fls']['size']<=500000){  
			if(move_uploaded_file($archivo, $destino)){
				$mensaje_portada=0; 
				//echo "Se añadio correctamente";
			} else {
				$mensaje_portada=1; 
				//echo "No se pudo subir el arhivo.";
			}
		} else {	
			$mensaje_portada=3;		
			//echo "El archivo no tiene el formato correcto o pesa mas.";
		}		
	}

	//Control de errores de portada:
	// Creamos un array de portadas, para que en el caso de que haya algun error, se incluya una portada aleatoria.
	$portadas=[	"media/img/portadas/default.jpg", "media/img/portadas/default1.jpg", "media/img/portadas/default2.jpg", 
				"media/img/portadas/default3.jpg", "media/img/portadas/default4.jpg"];
	$aleatorio=rand(0,4);

	switch($mensaje_portada){
		case 0:		// Portada se graba
			$mensa_p=1;
			$portada=$destino;  
			break;
		case 1:		//No se sube el archivo
			$mensa_p=2;
			$portada=$portadas[$aleatorio];
			break;
		case 2:		//No se seleccionó portada
			$mensa_p=3;
			$portada=$portadas[$aleatorio];
			break;
		case 3:		//Formato no admitido
			$mensa_p=4;
			$portada=$portadas[$aleatorio];
			break;
		default:
			$mensa_p=5;
			$portada=$portadas[$aleatorio];
			break;
	}
	
	//	Al ejecutar grabarLibro, grabamos el libro y recogemos el cod_libro.
	$cod_libro=grabarLibro($conexion, $titulo, $fecha, $genero, $editorial, $portada, $argumento);
				
	if(mysqli_errno($conexion)==1062){
		$mensaje_libro="1";	// El libro ya existe.
	} else if(mysqli_errno($conexion)==1054 OR mysqli_errno($conexion)==1064 OR mysqli_errno($conexion)==1146){
		$mensaje_libro="2"; //Quiere decir que hay un error grave.
	} else {
		$mensaje_libro="0";	// El libro no existe, lo grabamos.
	}

	//4.- Hacemos el control de errores:
	$resultado=$mensaje_autor.$mensaje_libro;
		
	switch($resultado){
		case "00":
			//a. No existen autor ni libro por lo que grabamos en tercera tabla.
			grabarTerceraTabla($conexion, $cod_autor, $cod_libro);
			$mensaje=1;
			break;
		case "01":
			//b. El autor no existe, pero sí el libro.
			$cod_libro=codLibro($conexion, $titulo);
			grabarTerceraTabla($conexion, $cod_autor, $cod_libro);
			$mensaje=2;
			unset($mensa_p);  // Para que no se mande un mensaje de portada.
			break;
		case "10":
			//c.- El autor ya existe, pero no el libro.
			$cod_autor=codAutor($conexion, $nombre, $apellidos);
			grabarTerceraTabla($conexion, $cod_autor, $cod_libro);
			$mensaje=3;
			break;
		case "11":
			//d.- Autor y libros ya existentes en la biblioteca. Hay que ver la situación.
			$cod_autor=codAutor($conexion, $nombre, $apellidos);
			$cod_libro=codLibro($conexion, $titulo);
			// Comprobamos en tercera tabla si hay vinculación de cod_autor y cod_libro
			$comprueba=comprobarTerceraTabla($conexion, $cod_autor, $cod_libro);
			if($comprueba==1){	// El autor y el libro coinciden. No grabamos
				$mensaje=4;
				unset($mensa_p); // Para que no se mande un mensaje de error de portada.
			} else {
				grabarTerceraTabla($conexion, $cod_autor, $cod_libro); // Grabamos nuevo autor en libro.
				$mensaje=5;
			}
			break;

			//e. Errores graves que hay que solucionar con la mayor rapidez posible.	
		case "02":
			$mensaje=6;
			break;
		case "12":
			$mensaje=6;
			break;
		case "20":
			$mensaje=6;
			break;
		case "21":
			$mensaje=6;
			break;
		case "22":
			$mensaje=6;
			break;
		default:
			$mensaje=7;
			break;
	}
	//5.- Cerramos la conexion con la base de datos.
	mysqli_close($conexion);

} else {

	// No venimos por el formulario. Lo reenviamos a él.
	header("Location:01_formulario_altas.php");
}

// Devolvemos los mensajes al formulario mediante un array:
$mensajes=array('mensaje'=>$mensaje, 'mensa_p'=>$mensa_p, 'titulo'=>$titulo, 'fecha'=>$fecha, 
				'genero'=>$genero, 'editorial'=>$editorial, 'portada'=>$portada, 'nombre'=>$nombre, 'apellidos'=>$apellidos);
$mensajes=serialize($mensajes);
header("Location:01_formulario_altas.php?mensajes=$mensajes");

 ?>