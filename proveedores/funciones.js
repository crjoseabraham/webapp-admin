function nuevoAjax(){
	var xmlhttp=false;
 	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
 			xmlhttp = false;
 		}
 	}
	
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
   
	return xmlhttp;
}

function buscarDato4(){
	resul = document.getElementById('resultado4');
	bus=document.formprov.dato4.value;
   
	ajax=nuevoAjax();
	ajax.open("POST", "proveedores/busqueda.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("busqueda="+bus)
}