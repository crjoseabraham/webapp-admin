<?php
$get = "SELECT * FROM proveedor";
$resultado=$mysqli->query($get);
$option = '';
while($row=$resultado->fetch_assoc()){
  $option .= '<option value = "'.$row['codigo_proveedor'].'">'.$row['codigo_proveedor'].' | '.$row['nombre_proveedor'].'</option>';
}
?>

<form action="proveedores/update.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <select id="codigo" class="codigo" name="codigo">
        <?php echo $option; ?>
      </select>          
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="codigonew" name="codigonew" type="text" pattern="^[V,E,P,G,J,C]\d{9}$" maxlength="10" class="validate" required>
            <label for="codigonew">Código</label>
        </div>
        <div class="input-field col s6">
          <input id="nombreprov" name="nombreprov" type="text"  maxlength="50" class="validate" value="<?php echo $row['nombre_proveedor']; ?>" required>
          <label for="nombreprov">Nombre del proveedor</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="telefono" name="telefono" type="text" pattern="^[0]\d{10}$" maxlength="11"  title="Ejemplo: 04146140943" class="validate" required>
          <label for="telefono"> Teléfono 1</label>
        </div>
        <div class="input-field col s6">
          <input id="telefono2" name="telefono2" type="text" pattern="^[0]\d{10}$" maxlength="11"  title="Ejemplo: 04146140943" class="validate" required>
          <label for="telefono2"> Teléfono 2</label>
        </div>
        <div class="input-field col s6">
          <input id="email" name="email" type="email" maxlength="50" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="direccion" name="direccion" type="text" maxlength="100" class="validate" required>
          <label for="direccion">Direccion</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <button type="submit" class="waves-effect waves-light btn light-green"><i class="fa fa-pencil"></i> Guardar cambios </button>
        </div>
      </div>
</form>