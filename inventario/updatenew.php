<?php
include('../connect.php');
$ID = $_POST['Id'];
$a = $_POST['codigo'];
$b = $_POST['descripcion'];
$c = $_POST['stockmin'];
$d = $_POST['tipoU'];
$e = $_POST['cxu'];
$f = $_POST['cadd'];
$g = $_POST['pcom'];
$h = $_POST['margen'];
$i = $_POST['subtotal'];
$j = $_POST['iva'];
$k = $_POST['pvp'];
$l = $_POST['provcod'];
$m = date('Y-m-d H:i:s');
$n = $_POST['stock'];

$results = $mysqli->query("UPDATE articulo SET
	codigoart = '$a',
	ultim_mod = '$m', 
	descripcion ='$b', 
	existencia = '$n',
	stockmin = '$c', 
	tipo_unidad ='$d', 
	costo_unidad ='$e', 
	costo_adicional ='$f', 
	precio_compra = '$g', 
	margen_ganancia = '$h', 
	base_imponible = '$i', 
	iva = '$j', 
	precio_venta='$k', 
	codigo_proveedor='$l' 
	WHERE codigoart='$ID'");

$results = $mysqli->query("INSERT INTO operacion VALUES(null,'$a','$n',1,null,'$m',null)");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../admindashboard.php");
?>