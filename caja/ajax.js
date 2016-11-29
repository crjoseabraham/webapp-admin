// JavaScript Document
 
// Función para recoger los datos de PHP según el navegador, se usa siempre.
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
 
//Función para recoger los datos del formulario y enviarlos por post  
function enviarDatosEmpleado(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs
  cod=document.form.codigo.value;
  des=document.form.descripcion.value;
  can=document.form.cantidad.value;
  pre=document.form.precio.value;
  utp=document.form.utp.value;
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "caja/registro.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		LimpiarCampos();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("codigo="+cod+"&descripcion="+des+"&cantidad="+can+"&precio="+pre+"&utp="+utp)
}
 
//función para limpiar los campos
function LimpiarCampos(){
  document.form.codigo.value="";
  document.form.descripcion.value="";
  document.form.cantidad.value="";
  document.form.precio.value="";
  document.form.codigo.focus();
  document.getElementById('codigo').disabled = false;
  document.getElementById('descripcion').disabled = false;
  document.getElementById('cantidad').disabled = false;
  document.getElementById('precio').disabled = false;



}