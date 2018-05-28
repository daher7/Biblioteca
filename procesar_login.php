<?php 

		
// Vamos a comprobar si nos hemos logueado.  
// De ser así, podremos acceder a todos las opciones de la biblioteca, sino, solo podemos mirarla.
//1.- Conexion con la base de datos.
	require_once('conexion.php');

if(isset($_POST["login_btn"])){
	$usuario=		$_POST["usuario"];
	$contrasena=	$_POST["contrasena"];
	$consulta="SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena ='$contrasena';";
	$login=mysqli_query($conexion, $consulta);

	if($login && mysqli_num_rows($login)==1){
		$_SESSION["logged"]=mysqli_fetch_assoc($login); //Los datos del ususario.
		header("Location:index.php");
	} else {
		$mensaje="El usuario o la contraseña no son correctos";
		header("Location:formulario_login.php?mensaje=$mensaje");
	}
}

 ?>



 ?>