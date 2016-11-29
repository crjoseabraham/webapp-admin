<?php
include('/connect.php');
$a = $_POST['codp'];
$b = $_POST['nomp'];
$c = $_POST['tlfp'];
$d = $_POST['tlfp2'];
$e = $_POST['mailp'];
$f = $_POST['dirp']; 

$link = mysqli_connect("localhost","root","","mbellorin");
mysqli_query($link,"INSERT INTO proveedor VALUES ('$a','$b','$c','$d','$e', '$f')") or die(mysqli_error($link));
header("location: ../admindashboard.php#tab4");
?>