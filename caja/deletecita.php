<?php
include('../connect.php');
$a = $_POST['idcita'];

$results = $mysqli->query("DELETE FROM eventos WHERE id='".$a."'");

if($results);
else{
    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
}

header("location: ../cajadashboard.php#tab3");
?>