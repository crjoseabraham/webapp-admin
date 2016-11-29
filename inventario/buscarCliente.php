<?php
require_once("../connect.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT *  FROM cliente WHERE idcliente like '%" . $_POST["keyword"] . "%' OR nombre_cliente like '%" . $_POST["keyword"] . "%' OR apellido_cliente like '%" . $_POST["keyword"] . "%' ORDER BY nombre_cliente ASC";
$result=$mysqli->query($query);
if(!empty($result)) {
?>
<table class="responsive-table highlight">
<thead>
	<tr>
		<th>C.I. / RIF</th>
		<th>Nombre</th>
		<th>Teléfono</th>
		<th>Dirección</th>
		<th>E-mail</th>
	</tr>
	</thead>
	<tbody>
<?php while($row=$result->fetch_assoc()){ 
						echo "
						<tr>
							<td>".$row['idcliente']."</td>
							<td>".$row['nombre_cliente']." ".$row['apellido_cliente']."</td>
							<td>".$row['tlfcelular_cliente']."</td>
							<td>".$row['direccion_cliente']."</td>
							<td>".$row['email']."</td>
						</tr>";
					 } ?>
</tbody>
</table>
<?php } } ?>