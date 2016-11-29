<?php
require_once("../connect.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM cliente WHERE idcliente like '%" . $_POST["keyword"] . "%' OR nombre_cliente like '%" . $_POST["keyword"] . "%' ORDER BY nombre_cliente ASC";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<table class="responsive-table">
<thead>
	<tr>
		<th>C.I./RIF</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Teléfono 1</th>
		<th>Teléfono 2</th>
		<th>E-mail</th>
		<th>Dirección</th>
		<th></th>

	</tr>
	</thead>
	<tbody>
<?php
foreach($result as $row) {
?>
	<td><?php echo $row['idcliente']; ?></td>
	<td><?php echo $row['nombre_cliente']; ?></td>
	<td><?php echo $row['apellido_cliente']; ?></td>
	<td><?php echo $row['tlfcelular_cliente']; ?></td>
	<td><?php echo $row['tlf_2']; ?></td>
	<td><?php echo $row['email']; ?></td>
	<td><?php echo $row['direccion_cliente']; ?></td>
	<td><form action='caja/modificar_cliente.php' method='POST'><input type='hidden' name='Id' value='".$row['idcliente']."'/><button type='submit' class='tooltipped waves-effect waves-light btn-floating light-blue darken-2' name='submit-btn' data-position='top' data-delay='50' data-tooltip='Modificar datos básicos' style='width: 25px; height: 25px; line-height: normal;'> <i class='fa fa-pencil' style='color:#fff;font-size: 15px; line-height: normal;'></i></button></form></td>
<?php } ?>
</tbody>
</table>
<?php } } ?>