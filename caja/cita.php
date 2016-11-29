<?php
 
//Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "root"; 
  $bd_password = ""; 
  $bd_base = "mbellorin"; 
 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
 
//variables POST
  $a=$_POST['datecita'];
  $b=htmlspecialchars($_POST['textarea1']);

//registra los datos de la cita
  $sql="INSERT INTO eventos VALUES (null, '$a', '$b')";
  mysql_query($sql,$con) or die('Error. '.mysql_error());

header('location: ../cajadashboard.php#tab3');
?>