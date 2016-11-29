<?php
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$link = mysqli_connect("localhost","root","","mbellorin");
$resultado = mysqli_query($link,"SELECT * FROM factura") or die(mysqli_error($link));
?>
	
			<table class="responsive-table" style="font-size: 11px;">
				<thead>
				<tr>
					<th>Código</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Importe</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Ingreso</th>
					<th>Restante</th>
					<th>Descuento</th>
					<th>Status</th>
					<th>Acción</th>
				</tr>
				</thead>

				<tbody>
					<?php 
					while($row=$resultado->fetch_assoc()){ 
						if($row['status'] == "PENDIENTE") echo "<tr class='yellow lighten-5'>";
						else echo "<tr>";
						echo "
							<td>".$row['idfactura']."</td>
							<td>".$row['fecha']."</td>
							<td>".$row['idcliente']."</td>
							<td>".$row['importe']."</td>
							<td>".$row['impuesto']."</td>
							<td>".$row['total']."</td>
							<td>".$row['ingreso']."</td>
							<td>".$row['restante']."</td>
							<td>".$row['descuento_adicional']."%</td>
							";
						if($row['status'] == "PENDIENTE") echo "<td><b>".$row['status']."</b></td>";
						elseif($row['status'] == "ANULADA") echo "<td><b><span class='red-text'>".$row['status']."</span></b></td>";
						else echo "<td>".$row['status']."</td>";
						echo "
								<td>								
									<form action='caja/verdetalle.php' method='POST'><input type='hidden' name='Id' value='".$row['idfactura']."'/>
									<button type='submit' class='tooltipped btn-floating waves-effect waves-light indigo darken-3' name='submit-btn' data-position='left' data-delay='50' data-tooltip='Ver detalles' style='height: 30px;width: 30px;line-height: initial;'>
									<i class='fa fa-list' style='font-size:20px;line-height: initial;'></i></button>
									</form>
								</td>";
							if($row['status'] !== "ANULADA")
							{	echo "
								<td>
									<form action='inventario/anular.php' method='POST'><input type='hidden' name='Id' value='".$row['idfactura']."'/>
									<button type='submit' class='tooltipped btn-floating waves-effect waves-light red' name='submit-btn' data-position='left' data-delay='50' data-tooltip='Anular pedido' style='height: 30px;width: 30px;line-height: initial;'>
									<i class='fa fa-close' style='font-size:20px;line-height: initial;'></i></button>
									</form>
								</td>
								";
							}
							if($row['status'] == "PENDIENTE")
							{   echo "
								<td>
								<form action='caja/actualizar.php' method='POST'><input type='hidden' name='Id' value='".$row['idfactura']."'/>
								<button type='submit' class='tooltipped btn-floating waves-effect waves-light green accent-4' name='submit-btn' data-position='left' data-delay='50' data-tooltip='Marcar como Aprobada' style='height: 30px;width: 30px;line-height: initial;'><i class='fa fa-check' style='font-size:20px;line-height: initial;'></i></button>
								</form>
								</td>";
							}						
							else{
								echo "</tr>";}
					 } ?>
				</tbody>
			</table>	