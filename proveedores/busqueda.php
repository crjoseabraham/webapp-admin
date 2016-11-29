<?php
   $busqueda=$_POST['busqueda'];
   if ($busqueda<>''){
   	//numero de palabras
   	$trozos=explode(" ",$busqueda);
   	$numero=count($trozos);
   	if ($numero==1) {
   		$cadbusca="SELECT * FROM proveedor WHERE codigo_proveedor LIKE '%$busqueda%' OR nombre_proveedor LIKE '%$busqueda%' LIMIT 10;";
   	} elseif ($numero>1) {
   		$cadbusca="SELECT * , MATCH ( proveedor, codigo_proveedor ) AGAINST ( '$busqueda' ) AS Score FROM post WHERE MATCH ( proveedor, nombre_proveedor ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50;";
   	}
   
   	function limitarPalabras($cadena, $longitud, $elipsis = "..."){
   	$palabras = explode(' ', $cadena);
   	if (count($palabras) > $longitud)
   		return implode(' ', array_slice($palabras, 0, $longitud)) . $elipsis;
   	else
   	return $cadena;
   	}
?>
<hr> 
<h4> Resultados de la búsqueda </h4>
<hr> 
<table class="tabla">
<tbody>
	<tr>
	<th class="rif">RIF</th>
	<th class="nom">Nombre</th>
	<th class="tlf">Teléfono</th>
   <th class="mail">Email</th>
   <th class="dir">Direccion</th>
	</tr>
<?php
      $connect = mysqli_connect("localhost", "root", "", "mbellorin");
   	$result= mysqli_query($connect, $cadbusca);
   	$i=1;
   	while($row = mysqli_fetch_array($result)){
	   echo "
	   <tr>
	   <td class=\"rif\">".$row['codigo_proveedor']."</td>
	   <td class=\"nom\">".limitarPalabras($row['nombre_proveedor'],20)."</td>
	   <td class=\"tlf\">Bs. ".$row['tlf_proveedor']."</td>
      <td class=\"mail\">Bs. ".$row['email_proveedor']."</td>
      <td class=\"dir\">".$row['direccion_proveedor']."</td>
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