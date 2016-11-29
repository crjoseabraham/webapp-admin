<?php 
session_start();
/* comprobamos que un usuario registrado es el que accede al archivo, sino no tendría sentido que pasara por este archivo */
if (!isset($_SESSION['admin'])) { header("location:index.php"); }

/* usamos la función session_unset() para liberar la variable de sesión que se encuentra registrada */
if ($_SESSION['admin']) {
	session_unset($_SESSION['admin']);
	session_destroy();
	header("location:index.php"); 
}


if ($_SESSION['cajero']) {
	session_unset($_SESSION['cajero']);
	session_destroy();
	header("location:index.php"); 
}

?>