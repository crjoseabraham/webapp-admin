<?php
include('../connect.php');
$a = $_POST['select_catalog'];

$results = $mysqli->query("DELETE FROM articulo WHERE codigoart='".$a."'");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../admindashboard.php#prod");
?>