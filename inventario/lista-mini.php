<?php
	$query="SELECT *  FROM articulo INNER JOIN proveedor WHERE articulo.codigo_proveedor = proveedor.codigo_proveedor";
	$resultado=$mysqli->query($query);	
?>
	<div id="cuadro">		
		<table class="responsive-table">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Existencia</th>
					<th>Área</th>
					<th>Acción</th>
				</tr>

				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ 
						echo "
						<tr>
							<td>".$row['codigoart']."</td>
							<td>".$row['descripcion']."</td>
							<td>".$row['existencia']."</td>
							<td>".$row['area']."</td>
							<td><form action='inventario/detailform.php' method='POST'><input type='hidden' name='Id' value='".$row['codigoart']."'/><button type='submit' class='waves-effect waves-light btn light-green' name='submit-btn'><i class='fa fa-history'></i> Historial</button></form></td>
						</tr>";
					 } ?>
				</tbody>
			</table>	
		</div>