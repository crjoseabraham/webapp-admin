<?php
require_once("../connect.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM proveedor WHERE codigo_proveedor like '%" . $_POST["keyword"] . "%' OR nombre_proveedor like '%" . $_POST["keyword"] . "%' ORDER BY nombre_proveedor ASC";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<table class="responsive-table">
<thead>
	<tr>
		<th>RIF</th>
		<th>Nombre</th>
		<th>Teléfono 1</th>
		<th>Teléfono 2</th>
		<th>E-mail</th>
		<th>Dirección</th>
	</tr>
	</thead>
	<tbody>
<?php
foreach($result as $row) {
?>
	<td><?php echo $row['codigo_proveedor']; ?></td>
	<td><?php echo $row['nombre_proveedor']; ?></td>
	<td><?php echo $row['tlf_proveedor']; ?></td>
	<td><?php echo $row['telf_2']; ?></td>
	<td><?php echo $row['email_proveedor']; ?></td>
	<td><?php echo $row['direccion_proveedor']; ?></td>
	<td><form action='proveedores/modificar_proveedor.php' method='POST'><input type='hidden' name='Id' value='".$row['codigo_proveedor']."'/><button type='submit' class='tooltipped waves-effect waves-light btn-floating light-blue darken-2' name='submit-btn' data-position='top' data-delay='50' data-tooltip='Modificar datos básicos' style='width: 25px; height: 25px; line-height: normal;'> <i class='fa fa-pencil' style='color:#fff;font-size: 15px; line-height: normal;'></i></button></form>
	</td>
		
<?php } ?>
</tbody>
</table>
<?php } } ?>