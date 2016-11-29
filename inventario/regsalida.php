<?php
include('../connect.php');
$ID = $_POST['Id'];
$a = $_POST['cant-salida'];
$b = $_POST['motivo'];
$d = date('Y-m-d H:i:s');

$results = $mysqli->query("UPDATE articulo SET ultim_mod = '$d', existencia = existencia - '$a' WHERE codigoart='$ID'");
$history = $mysqli->query("INSERT INTO operacion VALUES (null,'$ID','$a',2,null,'$d','$b')");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../admindashboard.php");
?>