<?php
include ('../connect.php');
$link = mysqli_connect("localhost","root","","mbellorin");

$a=$_POST['codigo'];
$c=$_POST['cantidad'];

$query="SELECT * FROM articulo WHERE codigoart = '$a'";
$resultado=$mysqli->query($query);
$r = mysqli_num_rows($resultado);
if($r>0){
  $aux=$resultado->fetch_assoc();

  //variables POST  
  $b=$aux['descripcion'];
  $d=$aux['precio_venta'];
  $e=$aux['tipo_unidad'];
  $f= $c * $d;

  mysqli_query($link,"INSERT INTO factura_auxiliar VALUES ('$a', '$b', '$c', '$d', '$e','$f') ON DUPLICATE KEY UPDATE cantidad='$c', unidad_tipo='$e', importe='$c'*'$d'") or die(mysqli_error($link));
}

else {
  echo "<span class='red-text'> Código inválido </span> <br>";
}

include('consulta.php');
?>