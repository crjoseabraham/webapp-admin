<?php 
/* start the session */ 
session_start(); 
?> 

<?php 
include "connect.php";

// datos del formulario
$username = $_POST['username']; 
$password = $_POST['password']; 
$sql= "SELECT * FROM usuario WHERE username = '$username' and password='$password'"; 
$result = $mysqli->query($sql);

// counting table row 
$count = mysqli_num_rows($result); 

// Si hay resultados

if($count == 1){ 
	
	while ($fila = $result->fetch_assoc()) {

        if($fila["rol"] == 1) {
		/* Si entra en este if significa que el que intenta acceder es un ADMINISTRADOR*/
		session_start();
		$_SESSION['admin']= "$username";
		header("Location: admindashboard.php");
		mysql_free_result($sql);
		exit(); 
		}

		if($fila["rol"] == 2) {

		/* Si entra en este if significa que el que intenta acceder es un CAJERO (NIVEL 3)*/
		session_start();
		$_SESSION['caja']= "$username";
		header("Location: cajadashboard.php");
		mysql_free_result($sql);
		exit();
		}
    }
	

	
	/*$_SESSION['loggedin'] = true; 
	$_SESSION['username'] = $username; 
	$_SESSION['start'] = time();
	echo " Bienvenido! " . $_SESSION['username']; */
} 
else { 
	header("location: index.php");
} 

?>


