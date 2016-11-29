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

function buscarDato2(){
	resul = document.getElementById('resultado2');
	bus=document.formbusqueda.dato2.value;
   
	ajax=nuevoAjax();
	ajax.open("POST", "inventario/busqueda.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			resul.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("busqueda="+bus)
}