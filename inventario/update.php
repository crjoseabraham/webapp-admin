<?php
include('../connect.php');
$ID = $_POST['Id'];
$a = $_POST['codigo'];
$b = $_POST['descripcion'];
$c = $_POST['stockmin'];
$l = $_POST['provcod'];
$m = date('Y-m-d H:i:s');

$results = $mysqli->query("UPDATE articulo SET
	ultim_mod = '$m', 
	descripcion ='$b', 
	stockmin = '$c', 
	tipo_unidad ='$d', 
	codigo_proveedor='$l' 
	WHERE codigoart='$ID'");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../admindashboard.php");
?>