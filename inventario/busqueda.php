<?php
   $busqueda=$_POST['busqueda'];
   if ($busqueda<>''){
   	//numero de palabras
   	$trozos=explode(" ",$busqueda);
   	$numero=count($trozos);
   	if ($numero==1) {
   		$cadbusca="SELECT * FROM articulo WHERE codigoart LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' LIMIT 10;";
   	} elseif ($numero>1) {
   		$cadbusca="SELECT * , MATCH ( articulo, codigoart ) AGAINST ( '$busqueda' ) AS Score FROM post WHERE MATCH ( articulo, descripcion ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50;";
   	}
   
   	function limitarPalabras($cadena, $longitud, $elipsis = "..."){
   	$palabras = explode(' ', $cadena);
   	if (count($palabras) > $longitud)
   		return implode(' ', array_slice($palabras, 0, $longitud)) . $elipsis;
   	else
   	return $cadena;
   	}
?>
<br><br>
<h4> Resultados de la búsqueda </h4>
<hr> 
<table class="responsive-table">
<tbody>
	<tr>
	<th class="id">Codigo</th>
	<th class="des">Descripción</th>
	<th class="pvp">Precio venta</th>
   <th class="pco">Precio costo</th>
   <th class="exi">Existencia</th>
   <th class="fra">Fecha de registro</th>
   <th class="pro">Proveedor</th>
	</tr>
<?php
      $connect = mysqli_connect("localhost", "root", "", "mbellorin");
   	$result= mysqli_query($connect, $cadbusca);
   	$i=1;
   	while($row = mysqli_fetch_array($result)){
	   echo "
	   <tr>
	   <td class=\"id\">".$row['codigoart']."</td>
	   <td class=\"des\">".limitarPalabras($row['descripcion'],20)."</td>
	   <td class=\"pvp\">Bs. ".$row['precio_venta']."</td>
      <td class=\"pco\">Bs. ".$row['precio_costo']."</td>
      <td class=\"exi\">".$row['existencia']."</td>
      <td class=\"fra\">".$row['fecha_ingreso_art']."</td>
      <td class=\"pro\">".$row['codigo_proveedor']."</td>
	   </tr>";
	   $i++;
   	}
?>
</tbody>
</table>
<?php
	//cierra el if inicial
	}
?> 