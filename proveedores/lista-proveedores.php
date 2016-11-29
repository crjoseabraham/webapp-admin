<?php
	$query="SELECT *  FROM proveedor";
	$resultado=$mysqli->query($query);	
?>
	<div id="cuadro">		
		<table class="responsive-table">
			<thead>
				<tr>
					<th>RIF</th>
					<th>Nombre</th>
					<th>Teléfono 1</th>
					<th>Teléfono 2</th>
					<th>E-mail</th>
					<th>Dirección</th>
					<th></th>
				</tr>

				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ 
						echo "
						<tr>
							<td>".$row['codigo_proveedor']."</td>
							<td>".$row['nombre_proveedor']."</td>
							<td>".$row['tlf_proveedor']."</td>
							<td>".$row['telf_2']."</td>
							<td>".$row['email_proveedor']."</td>
							<td>".$row['direccion_proveedor']."</td>							
						</tr>";
					 } ?>
				</tbody>
			</table>	
		</div>
			
