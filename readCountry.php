<?php
require_once("connect.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM articulo WHERE codigoart like '" . $_POST["keyword"] . "%' OR descripcion like '" . $_POST["keyword"] . "%' ORDER BY descripcion ASC";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="suggestions-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["codigoart"]; ?>','<?php echo $country["descripcion"]; ?>','<?php echo $country["precio_venta"]; ?>','<?php echo $country["tipo_unidad"]; ?>');"><?php echo $country["codigoart"]." | ".$country["descripcion"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>