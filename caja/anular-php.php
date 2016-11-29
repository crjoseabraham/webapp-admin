<?php
include("../connect.php");
$Id = $_POST['Id'];
$txt = $_POST['textarea1'];
$date = date('Y-m-d H:i:s');

$get = "UPDATE factura SET status = 'ANULADA', ifanulada_motivo = '$txt' WHERE idfactura='$Id'";
$resultado=$mysqli->query($get);

$slc = "SELECT * FROM factura_detalle WHERE idfactura='$Id'";
$r=$mysqli->query($slc);
while($row=$r->fetch_assoc()){
	$cantidad = $row['cantidad'];
	$idarticulo = $row['idarticulo'];
	$exe = "UPDATE articulo SET existencia = existencia + '$cantidad', ultim_mod='$date' WHERE codigoart = '$idarticulo'";
	$res=$mysqli->query($exe);	
	$exe2 = "INSERT INTO operacion VALUES(null,'$idarticulo','$cantidad',1,'$Id','$date','ANULACION')";
	$res2=$mysqli->query($exe2);	

	$cantidad = 0;
	$idarticulo = 0;
}

header("location: ../cajadashboard.php");
?>