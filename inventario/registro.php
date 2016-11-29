<?php
include('../connect.php');
$codigo = $_POST['codigo'];
$ultim_mod = date('Y-m-d H:i:s');
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stockmin = $_POST['stockmin'];
$tipoU = $_POST['tipoU'];
$CxUnidad = $_POST['cxu'];
$CAdicional = $_POST['cadd'];
$PrecioCompra = $_POST['pcom'];
$margen = $_POST['margen'];
$subtotal = $_POST['subtotal'];
$iva = $_POST['iva'];
$PVP = $_POST['pvp'];
$proveedor = $_POST['provcod'];

$link = mysqli_connect("localhost","root","","mbellorin");
mysqli_query($link,"INSERT INTO articulo VALUES ('$codigo','$ultim_mod','$descripcion','$stock','$stockmin','$tipoU','$CxUnidad','$CAdicional','$PrecioCompra','$margen','$subtotal','$iva','$PVP','$proveedor')") or die(mysqli_error($link));
header("location: ../admindashboard.php");
?>