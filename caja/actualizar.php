<?php
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$link = mysqli_connect("localhost","root","","mbellorin");
$factura = $_POST['Id'];
$fecha = date('Y-m-d H:i:s');

$resultado = mysqli_query($link,"UPDATE factura SET status = 'APROBADA', fecha = '$fecha', ingreso = total, restante = 0 WHERE idfactura='$factura'") or die(mysqli_error($link));

header("location: ../cajadashboard.php#tab2");
?>