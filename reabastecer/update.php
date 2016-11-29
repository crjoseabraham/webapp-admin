<?php
include('../connect.php');
$a = $_POST['Id'];
$e = $_POST['valor'];

$results = $mysqli->query("UPDATE articulo SET existencia= existencia + '$e' WHERE codigoart='$a'");

$link = mysqli_connect("localhost","root","","mbellorin");
mysqli_query($link,"INSERT INTO operacion VALUES (null, '$a', '$e', 1, null, now());") or die(mysqli_error($link));

header("location: ../admindashboard.php#reab");
?>