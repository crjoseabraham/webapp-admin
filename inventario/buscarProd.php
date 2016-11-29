<?php
require_once("../connect.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT *  FROM articulo INNER JOIN proveedor WHERE articulo.codigo_proveedor = proveedor.codigo_proveedor AND articulo.codigoart like '%" . $_POST["keyword"] . "%' OR articulo.descripcion like '%" . $_POST["keyword"] . "%' ORDER BY ultim_mod DESC";
$result=$mysqli->query($query);
if(!empty($result)) {
?>
<table class="responsive-table highlight" style="font-size: 11px ! important;">
<thead>
	<tr>
		<th>Código</th>
		<th>Últim. Modificación</th>
		<th>Descripción</th>
		<th>Stock</th>
		<th>Stock mínimo</th>
		<th>Tipo de unidad</th>
		<th>Costo unitario</th>
		<th>Costo adicional</th>
		<th>Precio compra</th>
		<th>Ganancia</th>
		<th>Subtotal</th>
		<th>IVA</th>
		<th>Precio venta</th>
		<th>Proveedor</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
<?php while($row=$result->fetch_assoc()){ 
						echo "
						<tr>
							<td>".$row['codigoart']."</td>
							<td>".$row['ultim_mod']."</td>
							<td>".$row['descripcion']."</td>
							<td>".$row['existencia']."</td>
							<td>".$row['stockmin']."</td>
							<td>".$row['tipo_unidad']."</td>
							<td>".number_format($row['costo_unidad'],2,',','.')."</td>
							<td>".number_format($row['costo_adicional'],2,',','.')."</td>
							<td>".number_format($row['precio_compra'],2,',','.')."</td>
							<td>".$row['margen_ganancia']."%</td>
							<td>".number_format($row['base_imponible'],2,',','.')."</td>
							<td>".$row['iva']."%</td>
							<td>".number_format($row['precio_venta'],2,',','.')."</td>
							<td>".$row['nombre_proveedor']."</td>
							<td><form action='inventario/detailform.php' method='POST'><input type='hidden' name='Id' value='".$row['codigoart']."'/><button type='submit' class='tooltipped waves-effect waves-light btn-floating deep-purple' name='submit-btn' data-position='top' data-delay='50' data-tooltip='Ver historial de entradas y salidas' style='width: 25px; height: 25px; line-height: normal;'> <i class='fa fa-history' style='color:#fff;font-size: 15px; line-height: normal;'></i></button></form>
							</td>
							<td><form action='inventario/salida.php' method='POST'><input type='hidden' name='Id' value='".$row['codigoart']."'/><button type='submit' class='tooltipped waves-effect waves-light btn-floating red' name='submit-btn' data-position='top' data-delay='50' data-tooltip='Registrar salida por defectos o pérdida' style='width: 25px; height: 25px; line-height: normal;'> <i class='fa fa-sign-out' style='color:#fff;font-size: 15px; line-height: normal;'></i></button></form>
							</td>
							<td><form action='inventario/modificar.php' method='POST'><input type='hidden' name='Id' value='".$row['codigoart']."'/><button type='submit' class='tooltipped waves-effect waves-light btn-floating light-blue darken-2' name='submit-btn' data-position='top' data-delay='50' data-tooltip='Modificar datos básicos' style='width: 25px; height: 25px; line-height: normal;'> <i class='fa fa-pencil' style='color:#fff;font-size: 15px; line-height: normal;'></i></button></form>
							</td>
						</tr>";
					 } ?>
</tbody>
</table>
<?php } } ?>