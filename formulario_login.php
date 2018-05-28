
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
			require('cabecera1.php');
		 ?>
		
		<section id="portada"> <!-- *************** Abrimos la portada ****************************** -->

			<section id="login"> <!-- *************** Abrimos juntos ****************************** -->
				<div class="acceso">
					<form name="formulario" action="procesar_login.php" method="post" enctype="multipart/form-data">
						<div class="formulario_login">
							<p class="titular">Acceso de Usuario</p>
								<label>Ususario:</label>				
								<input type="text" name="usuario" required>
								<label>Contraseña:</label>
								<input type="password" name="contrasena" required>
								<input type="submit" name="login_btn" value="Acceder">
								<input type="reset" value="Limpiar">
						</div>
				
					</form>
					<div class="mensajes_login">
						<?php 
							if(isset($_GET["mensaje"])){
								$mensaje=$_GET["mensaje"];
								echo $mensaje;
							}	
						?>
						</div>
				</div>	
			
			</section>	<!-- *************** Cerramos juntos ****************************** -->
			
		</section> <!-- *************** Cerramos la portada ****************************** -->
				
	</section> <!-- ***************  Cerramos el contenedor      ****************************** -->

</body>
</html>