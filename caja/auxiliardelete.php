<?php
include('../connect.php');
$a = $_POST['Id'];

$results = $mysqli->query("DELETE FROM factura_auxiliar WHERE codigoarticulo='".$a."'");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../cajadashboard.php");
?>