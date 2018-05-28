
function validar(){
	//Empezamos a validar, ANTES DE ENVIARLO!!

	//1.- Ningun campo escrito.
	if(document.formulario.nombre.value=="" && document.formulario.apellidos.value=="" && document.formulario.autores.value==0
	   && document.formulario.titulo.value==0 && document.formulario.libros.value==0){
		alert("Tienes que introducir un autor o un libro");
	//2.- Apellidos solo.
	} else if(document.formulario.nombre.value=="" && document.formulario.apellidos.value!="" && document.formulario.autores.value==0
			&& document.formulario.titulo.value==0 &&  document.formulario.libros.value==0){
				alert("Tienes que escribir el nombre del autor");
				document.formulario.nombre.focus(); // Para que el cursor se situe en el campo nombre.
	//3.- Nombre o apellidos y desplegable.
	} else if((document.formulario.nombre.value!="" || document.formulario.apellidos.value!="") && document.formulario.autores.value!=0 
			&& document.formulario.titulo.value==0 && document.formulario.libros.value==0){
				alert("Tienes que escribir el nombre o seleccionarlo del desplegable");
	//5.-  Escrito algún campo del autor y escrito algún campo del libro.
	} else if((document.formulario.nombre.value!="" || document.formulario.apellidos.value!="" || document.formulario.autores.value!=0) 
			&& (document.formulario.titulo.value!=0 || document.formulario.libros.value!=0)){
				alert("Tienes que elegir un autor o un libro");
	//7.- Titulo escrito y seleccionado del desplegable.
	} else if(document.formulario.nombre.value=="" && document.formulario.apellidos.value=="" && document.formulario.autores.value==0 
			&& document.formulario.titulo.value!=0 && document.formulario.libros.value!=0){
				alert("No se permite escribir el titulo y seleccionarlo del desplegable");
	//8.- Resto de los casos son correctos:
	} else {
		document.formulario.submit(); // Ya está validado, lo enviamos.
	}
}