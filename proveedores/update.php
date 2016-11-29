<?php
include('../connect.php');
$Id = $_POST['Id'];
$a = $_POST['codp'];
$b = $_POST['nomp'];
$c = $_POST['tlfp'];
$d = $_POST['tlfp2'];
$e = $_POST['mailp'];
$f = $_POST['dirp'];

$results = $mysqli->query("UPDATE proveedor SET
	nombre_proveedor = '$b', 
	tlf_proveedor ='$c', 
	telf_2 = '$d', 
	email_proveedor ='$e', 
	direccion_proveedor ='$f', 
	WHERE codigo_proveedor='$Id'");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../admindashboard.php");
?>