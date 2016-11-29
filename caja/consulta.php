<?php
 
//Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "root"; 
  $bd_password = ""; 
  $bd_base = "mbellorin"; 
 
	$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
	mysql_select_db($bd_base, $con); 
 
//consulta todos los empleados
$sql=mysql_query("SELECT * FROM factura_auxiliar",$con);

$query = mysql_query('SELECT SUM(importe) AS value_sum FROM factura_auxiliar'); 
$resultadoquery = mysql_fetch_assoc($query); 
$sum = $resultadoquery['value_sum'];
$impuesto = $sum * 0.12;
?>
<div id="detalle" style="height: 200px;overflow: auto;">
<table class="responsive-table">
  <tr>
  <th>Codigo</th>
  <th>Descripcion</th>
  <th>Cantidad</th>
  <th>Precio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
  <th>Unidad</th>
  <th>Importe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
  </tr>
<?php
  while($row = mysql_fetch_array($sql)){
  echo "<tr>";
    echo "<td><center>".$row['codigoarticulo']."</center></td>";
    echo "<td>".$row['descripcion']."</td>";
    echo "<td>".$row['cantidad']."</td>";
    echo "<td>".$row['punit']." Bs. </td>";
    echo "<td>".$row['unidad_tipo']."</td>";
    echo "<td>".$row['importe']."</td>";
    echo "<td>
                <form action='caja/auxiliardelete.php' method='POST'><input type='hidden' name='Id' value='".$row['codigoarticulo']."'/>
                <button type='submit' class='tooltipped btn-floating waves-effect waves-light red' name='submit-btn' data-position='right' data-delay='50' data-tooltip='Eliminar'><i class='fa fa-trash-o'></i></button>
                </form>
          </td>";
    echo "</tr>";
  }
?>
</table>
</div>
<div class="row">
  <div class="col l4 m4 s12">
                <input id='sum' name='sum' type='hidden' class='validate' form='factura' readonly value='<?php echo $sum ;?>'>
                <div class='card-panel grey darken-4' style='box-shadow: unset;'>
                  <span class='white-text'>Importe: <br><span style='font-size:20px;font-weight:bold;'><?php echo number_format($sum, 2, ',', '.');?> Bs.</span></span>
                </div>
      
  </div>
  <div class="col l4 m4 s12">
    <?php echo "<input id='impuesto' name='impuesto' type='hidden' class='validate' form='factura' readonly value='". $impuesto . "'>
                <div class='card-panel grey darken-4' style='box-shadow: unset;'>
                  <span class='white-text'>IVA: <br><span style='font-size:20px;font-weight:bold;'>".number_format($impuesto, 2, ',', '.')." Bs.</span></span>
                </div>"; ?> 
      
  </div>
  <div class="col l4 m4 s12">
                <div class='card-panel grey darken-1' style='box-shadow: unset;'>
                  <span class='white-text'> Descuento (%): <input name='descuento' id='descuento' type='number' class='validate' form='factura' value='0' min='0' max='100' onkeyup='calculartotal(this.value, document.getElementById("sum").value, document.getElementById("impuesto").value)'  style='background: none;font-size: 20px !important;font-weight: bold;text-align: right;'/> </span>
                </div>
      
  </div>
</div>
<div class="row">
  <div class="col l4 m4 s12 offset-l8">
                <div class='card-panel green accent-4' style='box-shadow: unset;'>
                  <span class='white-text'>Total: <input name='total' id='totals' type='number' class='validate' form='factura' value='<?php echo $sum + $impuesto; ?>' style='background: none;font-size: 20px !important;font-weight: bold;text-align: right;' readonly required /> </span>
                </div>
      
  </div>
</div>