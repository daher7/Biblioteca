
function validar(){
	//Empezamos a validar, ANTES DE ENVIARLO!!

	//1.- Ningun campo escrito.
	if(document.formulario.genero.value=="" && document.formulario.generos.value==0){
	  	alert("Tienes que introducir un genero");
	} else if(document.formulario.genero.value!="" && document.formulario.generos.value!=0){ 
		alert("Tienes que escribir el género o seleccionarlo del desplegable");
	//4.- Resto de los casos son correctos:
	} else {
		document.formulario.submit(); // Ya está validado, lo enviamos.
	}
}