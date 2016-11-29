<?php
include("../connect.php");
$Id = $_POST['Id'];

$get = "SELECT * FROM articulo WHERE codigoart='$Id'";
$resultado=$mysqli->query($get);

while($row=$resultado->fetch_assoc()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title>Registrar salida de un producto</title>

      <meta charset="UTF-8">
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
            <i class="fa fa-sign-out"></i> Registrar salida de un producto o material</a>
        </li>
      </ul>
    </div>
  </nav>




  <div class="row">
    <div class="col l6 m12 s12 offset-l2">
      <div class="row">
        <div class="col l6 s12 m12">
          <div class="card-panel">
            <fieldset>
              <legend> Datos básicos </legend>
              Código: <?php echo $row['codigoart']; ?> <br>
              Descripción: <?php echo $row['descripcion']; ?> <br>
              Tipo de unidad: <?php echo $row['tipo_unidad']; ?> <br>
              <b><u> Stock actual: <?php echo $row['existencia']; ?> </u></b> <br>
              <b><u> Stock mínimo: <?php echo $row['stockmin']; ?> </u></b> <br>
              Costo unitario: <?php echo $row['costo_unidad']; ?> Bs. <br>
              Costos adicionales: <?php echo $row['costo_adicional']; ?> Bs. <br>
              Margen de ganancia: <?php echo $row['margen_ganancia']; ?> % <br>
              Precio de compra: <?php echo $row['precio_compra']; ?> Bs. <br>
              <hr>
              Subtotal: <?php echo $row['base_imponible']; ?> Bs. <br>
              IVA: <?php echo $row['iva']; ?> Bs. <br>
              P.V.P: <?php echo $row['precio_venta']; ?> Bs. <br>
            </fieldset>
          </div>
        </div>  


        <div class="col l6 s12 m12">
          <div class="card-panel">
            <fieldset>
              <legend> Registrar salida </legend>
                <form action="regsalida.php" method="POST">
                <input type="hidden" name="Id" value="<?php echo $Id; ?>"/>
                <div class="input-field col s12">
                Cantidad:
                <input type="number" id="cant" class="validate" name="cant-salida" Required/>
                </div>
                <hr>
                Motivo de la salida:
                <div class="input-field col s12">
                  <select name="motivo" required>           
                  <option value="" disabled selected="">Seleccione:</option>
                  <option value="PERDIDA">Pérdida del material</option>
                  <option value="DEFECTO">Unidad/es con defectos</option>
                  </select>
                </div>

                <button class="btn waves-effect waves-light red" type="submit" name="action"> 
                <i class="fa fa-sign-out"></i>
                Guardar cambios
                </button>
                </form>
            </fieldset>
          </div>
        </div>          
      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function(){
      $('select').material_select();
})
</script>
</body>
</html>
<?php } ?>