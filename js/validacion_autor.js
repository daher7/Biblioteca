
function validar(){
	//Empezamos a validar, ANTES DE ENVIARLO!!

	//1.- Ningun campo escrito.
	if(document.formulario.nombre.value=="" && document.formulario.apellidos.value=="" && document.formulario.autores.value==0){
	  	alert("Tienes que introducir un autor");
	//2.- Apellidos solo.
	} else if(document.formulario.nombre.value=="" && document.formulario.apellidos.value!="" && document.formulario.autores.value==0){
		alert("Tienes que escribir el nombre del autor");
		document.formulario.nombre.focus(); // Para que el cursor se situe en el campo nombre.
	//3.- Nombre o apellidos y desplegable.
	} else if((document.formulario.nombre.value!="" || document.formulario.apellidos.value!="") && document.formulario.autores.value!=0){ 
		alert("Tienes que escribir el nombre o seleccionarlo del desplegable");
	//4.- Resto de los casos son correctos:
	} else {
		document.formulario.submit(); // Ya está validado, lo enviamos.
	}
}