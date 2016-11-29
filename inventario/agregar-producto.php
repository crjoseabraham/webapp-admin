<?php
$get = "SELECT * FROM proveedor ORDER BY nombre_proveedor ASC";
$resultado=$mysqli->query($get);
$option = '';
while($row=$resultado->fetch_assoc()){
  $option .= '<option value = "'.$row['codigo_proveedor'].'">'.$row['codigo_proveedor'].' | '.$row['nombre_proveedor'].' | '.$row['email_proveedor'].'</option>';
}
?>

<form action="inventario/registro.php" method="post">
    <div class="row">
      <div class="input-field col s4">
        <label for="Cod">Código</label>
        <input type="text" id="Cod" name="codigo" class="validate" Required/>
      </div>
        
      <div class="input-field col s8">
        <label for="Des">Descripción</label>                
        <input type="text" id="Des" class="validate" name="descripcion" Required/>
      </div>
    </div>
    
    <div class="row">
      <div class="input-field col s6">
        <label for="Cant">Cantidad Inicial</label>
        <input type="text" id="Cant" name="existencia" class="validate" Required/>
      </div>

      <div class="input-field col s6">
        <select name="area">
          <option value="CUADRADOS" selected="">CUADRADOS</option>
          <option value="LINEALES">LINEALES</option>
        </select>
        <label>Metros (tipo)</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s6">
        <label for="pco">Precio compra</label>
        <input type="text" id="pco" name="pcom" class="validate" Required/>
      </div>
        
      <div class="input-field col s6">
        <label for="pvp">Precio venta</label>                
        <input type="text" id="pvp" name="pven" class="validate" Required/>
      </div>
    </div>    

    <div class="row">
      <div class="input-field col s12">
        <select name="provcod" id="select_catalog">
          <?php echo $option; ?>
        </select>
        <label>Proveedor</label>
      </div>
    </div>               

    <center>
      <button type="submit" class="btn btn-success" id="registrar">Registrar</button>
    </center>
    <br><br>
</form>