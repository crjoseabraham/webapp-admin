<?php
include('../connect.php');
$Id = $_POST['id'];
$a = $_POST['iden'];
$b = $_POST['nom'];
$c = $_POST['ape'];
$d = $_POST['telef'];
$e = $_POST['telef2'];
$f = $_POST['email'];
$g = $_POST['direccion'];

$results = $mysqli->query("UPDATE cliente SET
	nombre_proveedor = '$b', 
	apellido_cliente ='$c', 
	tlfcelular_cliente = '$d', 
	tlf_2 ='$e', 
	email ='$f', 
	direccion_cliente ='$g',
	WHERE idcliente='$Id'");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../admindashboard.php");
?>