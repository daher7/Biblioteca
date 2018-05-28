
function validar(){
	//Empezamos a validar, ANTES DE ENVIARLO!!

	//1.- Ningun campo escrito.
	if(document.formulario.titulo.value=="" && document.formulario.libros.value==0){
	  	alert("Tienes que introducir un titulo");
	} else if(document.formulario.titulo.value!="" && document.formulario.libros.value!=0){ 
		alert("Tienes que escribir el título o seleccionarlo del desplegable");
	//4.- Resto de los casos son correctos:
	} else {
		document.formulario.submit(); // Ya está validado, lo enviamos.
	}
}