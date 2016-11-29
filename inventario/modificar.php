<?php
include("../connect.php");
$Id = $_POST['Id'];

$get = "SELECT * FROM articulo WHERE codigoart='$Id'";
$resultado=$mysqli->query($get);


$get2 = "SELECT * FROM proveedor ORDER BY codigo_proveedor ASC";
$resultado2=$mysqli->query($get2);
$option2 = '';
while($row2=$resultado2->fetch_assoc()){
  $option2 .= '<option value = "'.$row2['codigo_proveedor'].'">'.$row2['codigo_proveedor'].' | '.$row2['nombre_proveedor'].'</option>';
}

while($row=$resultado->fetch_assoc()){
    if ($row['existencia']>0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title> Modificar datos de un producto </title>
      <script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../caja/ajax.js"></script>
      <script type="text/javascript" src="../js/jquery.simple-dtpicker.js"></script>

      <link type="text/css" rel="stylesheet" href="../css/materialize.css">
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="../css/estilos.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
      <link type="text/css" href="../css/jquery.simple-dtpicker.css" rel="stylesheet" />
</head>
<body>

  <nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li>
          <a href="../admindashboard.php">
          <i class="fa fa-arrow-left"></i> Volver a la página principal</a>
          </li>
        <li class="active">
          <a href="#">
          <i class="fa fa-pencil"></i> Modificar datos básicos de un producto o material</a>
        </li>
      </ul>
    </div>
  </nav>
      <div class="row">
      <div class="col l6 s12 m12 offset-l3">
        <div class="card-panel">
            <div class="row">
                <form action="update.php" method="post" style="font-size: 12px;">
                  <input type="hidden" name="Id" value="<?php echo $Id; ?>"/>

                  <div class="row">
                  <div class="input-field col s4">
                  Código
                  <input type="text" id="Cod" name="codigo" class="validate" value="<?php echo $row['codigoart']; ?>" readonly Required/>
                  </div>

                  <div class="input-field col s8">
                  Descripción
                  <input type="text" id="Des" class="validate" name="descripcion" value="<?php echo $row['descripcion']; ?>" Required/>
                  </div>
                  </div>

                  <div class="row">
                  <div class="input-field col s6">
                  Stock mínimo
                  <input type="text" id="stockmin" name="stockmin" class="validate" value="<?php echo $row['stockmin']; ?>" Required/>
                  </div>
                  </div>

                  <div class="row">
                  <div class="input-field col s12">
                  Tipo de unidad
                  <select name="tipoU" required>           
                  <option value="" disabled selected="">Seleccione:</option>
                  <option value="METROS CUADRADOS">METROS CUADRADOS</option>
                  <option value="METROS LINEALES">METROS LINEALES</option>
                  <option value="UNIDAD">UNIDAD</option>
                  </select>
                  </div>
                  </div>

                  <div class="row">
                  <div class="input-field col s12">
                  <select name="provcod" id="proveedor" name="proveedor" required>
                  <?php echo $option2; ?>
                  </select>
                  <label>Proveedor</label>
                  </div>
                  </div>
                  
                  <center>
                  <button type="submit" class="waves-effect waves-light btn light-green"><i class="fa fa-pencil"></i> Guardar </button>
                  </center>
                  </form>
            </div>  
        </div>
      </div>            
      </div>

<script type="text/javascript">
$(document).ready(function(){
      $('select').material_select();

      $("#cxu").keyup(function(){
      if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  
      
          if ($("#cad").val() == "") {var cad = 0;}
            else {var cad = parseFloat($("#cad").val());}

          costo = val + cad;
          $("#pco").val(costo);
      });
      $("#cad").keyup(function(){
      if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  

      if ($("#cxu").val() == "") {var cxu = 0;}
            else {var cxu = parseFloat($("#cxu").val());}

          costo = val + cxu;
          $("#pco").val(costo);
      });
      $("#margen").keyup(function(){
            if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  

          if ($("#pco").val() == "") {var pcom = 0;}
            else {var pcom = parseFloat($("#pco").val());}

          subtotal = pcom + (pcom * (val / 100));
          $("#subt").val(subtotal);
      });
      $("#iva_producto").keyup(function(){
      if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  
      
          if ($("#subt").val() == "") {var subt = 0;}
            else {var subt = parseFloat($("#subt").val());}

            if (val == 0) { pvp = subt; }
            else { pvp = (subt * (val / 100)) + subt; }                     
          $("#pvp_producto").val(pvp);
      });
})
</script>
</body>
</html>
<?php } 
elseif($row['existencia']==0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title> Modificar datos de un producto </title>
      <script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../caja/ajax.js"></script>
      <script type="text/javascript" src="../js/jquery.simple-dtpicker.js"></script>

      <link type="text/css" rel="stylesheet" href="../css/materialize.css">
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="../css/estilos.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
      <link type="text/css" href="../css/jquery.simple-dtpicker.css" rel="stylesheet" />
</head>
<body>

  <nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li>
          <a href="../admindashboard.php">
          <i class="fa fa-arrow-left"></i> Volver a la página principal</a>
          </li>
        <li class="active">
          <a href="#">
          <i class="fa fa-pencil"></i> Modificar datos básicos de un producto o material</a>
        </li>
      </ul>
    </div>
  </nav>
      <div class="row">
      <div class="col l6 s12 m12 offset-l3">
        <div class="card-panel">
            <div class="row">
                <fieldset>
                <legend>Actualizar datos</legend>
                <span class="red-text">
                  <b><i>"Este producto/material actualmente tiene 0 unidades en inventario, si se recibió mercancía debe actualizar los datos de dicho producto como costos y precios en el siguiente formulario, además de indicar la cantidad de mercancía que entra"</i><b>
                </span>
                <br><br>
                    <?php
                $get = "SELECT * FROM proveedor ORDER BY nombre_proveedor ASC";
                $resultado=$mysqli->query($get);
                $option = '';
                while($row=$resultado->fetch_assoc()){
                  $option .= '<option value = "'.$row['codigo_proveedor'].'">'.$row['codigo_proveedor'].' | '.$row['nombre_proveedor'].'</option>';
                }
                ?>
                <form action="updatenew.php" method="post" style="font-size: 12px;">
                    <div class="row">
                      <input type="hidden" name="Id" value="<?php echo $Id; ?>"/>
                      <div class="input-field col s4">
                        Código
                        <input type="text" id="Cod" name="codigo" class="validate" value="<?php echo $row['codigoart']; ?>" Required/>
                      </div>
                        
                      <div class="input-field col s8">
                        Descripción
                        <input type="text" id="Des" class="validate" name="descripcion" value="<?php echo $row['descripcion']; ?>" Required/>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="input-field col s6">
                        Stock
                        <input type="text" id="stock" name="stock" class="validate" Required/>
                      </div>

                      <div class="input-field col s6">
                        Stock mínimo
                        <input type="text" id="stockmin" name="stockmin" class="validate" value="<?php echo $row['stockmin']; ?>" Required/>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        Tipo de unidad
                        <select name="tipoU" required>           
                          <option value="" disabled selected="">Seleccione:</option>
                          <option value="METROS CUADRADOS">METROS CUADRADOS</option>
                          <option value="METROS LINEALES">METROS LINEALES</option>
                          <option value="UNIDAD">UNIDAD</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s4">
                        Costo unitario
                        <input type="number" id="cxu" name="cxu" class="validate" value="<?php echo $row['costo_unidad']; ?>" Required/>
                      </div>
                        
                      <div class="input-field col s4">
                        Costo adicional
                        <input type="number" id="cad" name="cadd" class="validate" value="<?php echo $row['costo_adicional']; ?>"/>                   
                      </div>

                      <div class="input-field col s4">
                        Precio compra
                        <input type="number" id="pco" name="pcom" class="validate" value="<?php echo $row['precio_compra']; ?>" readonly />                  
                      </div>
                    </div>    

                    <div class="row">
                      <div class="input-field col s6">
                        Margen de ganancia (%)
                        <input type="number" id="margen" name="margen" class="validate" value="30" required/>
                      </div>

                      <div class="input-field col s6">
                        Subtotal<br>
                        <input type="number" id="subt" name="subtotal" class="validate" value="<?php echo $row['base_imponible']; ?>" Required readonly /> 
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s6">
                        IVA (%)
                        <input type="number" id="iva_producto" name="iva" class="validate" value="12" Required />
                      </div>

                      <div class="input-field col s6">
                        P.V.P
                        <input type="number" id="pvp_producto" name="pvp" class="validate" required readonly />               
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12">
                        <select name="provcod" id="proveedor" name="proveedor" required>
                          <?php echo $option; ?>
                        </select>
                        <label>Proveedor</label>
                      </div>
                    </div>               

                    <center>
                      <button type="submit" class="btn btn-success blue" id="registrar">Registrar</button>
                    </center>
                </form>
                </fieldset>
            </div>  
        </div>
      </div>            
      </div>

<script type="text/javascript">
$(document).ready(function(){
      $('select').material_select();

      $("#cxu").keyup(function(){
      if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  
      
          if ($("#cad").val() == "") {var cad = 0;}
            else {var cad = parseFloat($("#cad").val());}

          costo = val + cad;
          $("#pco").val(costo);
      });
      $("#cad").keyup(function(){
      if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  

      if ($("#cxu").val() == "") {var cxu = 0;}
            else {var cxu = parseFloat($("#cxu").val());}

          costo = val + cxu;
          $("#pco").val(costo);
      });
      $("#margen").keyup(function(){
            if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  

          if ($("#pco").val() == "") {var pcom = 0;}
            else {var pcom = parseFloat($("#pco").val());}

          subtotal = pcom + (pcom * (val / 100));
          $("#subt").val(subtotal);
      });
      $("#iva_producto").keyup(function(){
      if ($(this).val() == "") {var val = 0;}
            else {var val = parseFloat($(this).val());}  
      
          if ($("#subt").val() == "") {var subt = 0;}
            else {var subt = parseFloat($("#subt").val());}

            if (val == 0) { pvp = subt; }
            else { pvp = (subt * (val / 100)) + subt; }                     
          $("#pvp_producto").val(pvp);
      });
})
</script>
</body>
</html>

<?php
}

} ?>