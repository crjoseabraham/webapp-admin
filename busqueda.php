<?php
   require('connect.php');
   $busqueda=$_POST['busqueda'];
   if ($busqueda<>''){
   	//numero de palabras
   	$trozos=explode(" ",$busqueda);
   	$numero=count($trozos);
   	if ($numero==1) {
   		$cadbusca="SELECT * FROM empleado WHERE idempleado LIKE '%$busqueda%' OR apellido_empleado LIKE '%$busqueda%' LIMIT 10;";
   	} elseif ($numero>1) {
   		$cadbusca="SELECT * , MATCH ( empleado, idempleado ) AGAINST ( '$busqueda' ) AS Score FROM post WHERE MATCH ( empleado, apellido_empleado ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50;";
   	}
   
   	function limitarPalabras($cadena, $longitud, $elipsis = "..."){
   	$palabras = explode(' ', $cadena);
   	if (count($palabras) > $longitud)
   		return implode(' ', array_slice($palabras, 0, $longitud)) . $elipsis;
   	else
   	return $cadena;
   	}
?>
<table class="table table-bordered table-condensed table-striped">
<tbody>
	<tr>
	<td class="id">ID</td>
	<td class="nom">Nombre</td>
	<td class="ape">Apellido</td>
   <td class="tlf">Teléfono</td>
   <td class="dir">Dirección</td>
   <td class="car">Cargo</td>
   <td class="fie">Fecha de ingreso</td>
	</tr>
<?php
      $connect = mysqli_connect("localhost", "root", "", "mbellorin");
   	$result= mysqli_query($connect, $cadbusca);
   	$i=1;
   	while($row = mysqli_fetch_array($result)){
	   echo "
	   <tr>
	   <td class=\"id\">".$row['idempleado']."</td>
	   <td class=\"nom\">".limitarPalabras($row['nombre_empleado'],20)."</td>
	   <td class=\"ape\">".$row['apellido_empleado']."</td>
      <td class=\"tlf\">".$row['tlf_empleado']."</td>
      <td class=\"dir\">".$row['direccion_empleado']."</td>
      <td class=\"car\">".$row['cargo']."</td>
      <td class=\"fie\">".$row['fechaingreso_empleado']."</td>
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