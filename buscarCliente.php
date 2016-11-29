<?php
require_once("connect.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM cliente WHERE idcliente like '%" . $_POST["keyword"] . "%' ORDER BY nombre_cliente LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="suggestions-list">
<?php
foreach($result as $persona) {
?>
<li onClick="selectPersona('<?php echo $persona["idcliente"]; ?>','<?php echo substr($persona["idcliente"], 1); ?>','<?php echo $persona["nombre_cliente"]; ?>','<?php echo $persona["apellido_cliente"]; ?>','<?php echo $persona["tlfcelular_cliente"]; ?>','<?php echo $persona["direccion_cliente"]; ?>');"><?php echo $persona["idcliente"]." | ".$persona["nombre_cliente"]." ".$persona["apellido_cliente"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>