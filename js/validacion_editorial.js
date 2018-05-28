
function validar(){
	//Empezamos a validar, ANTES DE ENVIARLO!!

	//1.- Ningun campo escrito.
	if(document.formulario.editorial.value=="" && document.formulario.editoriales.value==0){
	  	alert("Tienes que introducir una editorial");
	} else if(document.formulario.editorial.value!="" && document.formulario.editoriales.value!=0){ 
		alert("Tienes que escribir la editorial o seleccionarla del desplegable");
	//4.- Resto de los casos son correctos:
	} else {
		document.formulario.submit(); // Ya está validado, lo enviamos.
	}
}