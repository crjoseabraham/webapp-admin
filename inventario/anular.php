<?php
include("../connect.php");
$Id = $_POST['Id'];

$get = "SELECT * FROM factura WHERE idfactura='$Id'";
$get2 = "SELECT * FROM factura_detalle WHERE idfactura='$Id'";
$resultado=$mysqli->query($get);
$resultado2=$mysqli->query($get2);

while($row=$resultado->fetch_assoc()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title> ANULAR UN PEDIDO </title>
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
          <a href="../cajadashboard.php">
          <i class="fa fa-arrow-left"></i> Volver a la página principal</a>
          </li>
        <li class="active">
          <a href="#">
          <i class="fa fa-close"></i> Anular un pedido </a>
        </li>
      </ul>
    </div>
  </nav>
      
	<div class="row">
    <div class="col l6 m6 s12">
      <div class="row">
        <div class="col l12 s12 m12">
          <div class="card-panel">
            <fieldset>
              <legend> Datos básicos </legend>
              Código: <?php echo $row['idfactura']; ?> <br>
              Fecha/Hora: <?php echo $row['fecha']; ?> <br>
              Cliente: <?php echo $row['idcliente']; ?> <br>
              Forma de pago: <?php echo $row['forma_pago']; ?> <br>
              <hr>
              Importe: <?php echo $row['importe']; ?> Bs. <br>
              IVA: <?php echo $row['impuesto']; ?> <br>
              Total: <?php echo $row['total']; ?> Bs. <br>
              <hr>
              Ingreso: <?php echo $row['ingreso']; ?> Bs. <br>
              Restante: <?php echo $row['restante']; ?> Bs. <br>
              Status: <?php echo $row['status']; ?> Bs. <br>
            </fieldset>
            <hr>
            <fieldset>
            <legend> Detalle </legend>
            <table class="responsive-table highlight">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Cantidad</th>
					<th>Importe</th>
				</tr>
			</thead>
				<tbody>
				<?php 
				while($row2=$resultado2->fetch_assoc()){
					echo "
						<tr>
							<td>".$row2['idarticulo']."</td>
							<td>".$row2['descripcion']."</td>
							<td>".$row2['cantidad']." ".$row2['unidad_tipo']."</td>
							<td>".$row2['importe']."</td>
						";
					}
				?>
				</tbody>
			</table>
            </fieldset>
          </div>
        </div>  
    </div>
    </div>


        <div class="col l6 s12 m6">
          <div class="card-panel">
            <fieldset>
              <legend> Motivo de la anulación: </legend>
                <form action="anular-php.php" method="POST">
                <input type="hidden" name="Id" value="<?php echo $Id; ?>"/>
                
                <div class="input-field col s12">
		          <textarea name="textarea1" id="txt" class="materialize-textarea"></textarea>
		          <label for="txt">Mensaje</label>
		        </div>
				
				<br><br><br>
                <button class="btn waves-effect waves-light red" type="submit" name="action"> 
                <i class="fa fa-check"></i>
                Confirmar
                </button>
                </form>
            </fieldset>
          </div>
        </div>
  </div>


<script type="text/javascript">
$(document).ready(function(){
    $('select').material_select();
    $('#textarea1').val('New Text');
  	$('#textarea1').trigger('autoresize');
})
</script>
</body>
</html>
<?php
}
?>