<?php
require '../connect.php'; 
$identificador = $_POST['Id'];
$query="SELECT *  FROM operacion WHERE codigoart =".$identificador.";";
$resultado=$mysqli->query($query);	

//sumatoria de entradas
$e = "SELECT SUM(cantidad) as total FROM operacion WHERE tipo_operacion = 1 AND codigoart = ".$identificador.";";	
$en = $mysqli->query($e);
$entradas = $en->fetch_array(MYSQLI_ASSOC);

//sumatoria de salidas
$s = "SELECT SUM(cantidad) as total FROM operacion WHERE tipo_operacion = 2 AND codigoart = ".$identificador.";";	
$sa = $mysqli->query($s);
$salidas = $sa->fetch_array(MYSQLI_ASSOC);

//consulta de disponibilidad
$d = "SELECT existencia as cant FROM articulo WHERE codigoart = ".$identificador.";";	
$di = $mysqli->query($d);
$disponibles = $di->fetch_array(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Historial</title>

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
            <a href="#historia">
            <i class="fa fa-history"></i> Historia</a>
        </li>
      </ul>
    </div>
  </nav>
  
    <div class="row">
      <div class="col l6 s12 m12 offset-l3">
        <div class="card-panel">
          <div id="historia" class="tab-pane fade in active">
                <center><h4><u>Historial del producto</u></h4></center>
                <br><br>
                <div class="row">
                <div class="col s4">
                <div class="card-panel cyan darken-1" style="box-shadow: unset;">
                  <span class="white-text">Entradas: <br><span style="font-size:20px;font-weight:bold;"> <?php echo $entradas["total"]; ?></span></span>
                </div>
                </div>
                <div class="col s4">
                <div class="card-panel cyan darken-1" style="box-shadow: unset;">
                  <span class="white-text">Disponibles: <br><span style="font-size:20px;font-weight:bold;"> <?php echo $disponibles["cant"]; ?></span></span>
                </div>
                </div>
                <div class="col s4">
                <div class="card-panel cyan darken-1" style="box-shadow: unset;">
                  <span class="white-text">Salidas: <br><span style="font-size:20px;font-weight:bold;"> <?php if($salidas["total"] == "") echo "0"; else echo $salidas['total']; ?></span></span>
                </div>
                </div>
                </div>

				<div id="cuadro">		
					<table class="responsive-table">
						<thead>
						<tr>
							<th>Cantidad</th>
							<th>Tipo</th>
							<th>Fecha de la operación</th>
							<th>Observación</th>
						</tr>
						</thead>

						<tbody>
							<?php while($row=$resultado->fetch_assoc()){ 
								switch ($row['tipo_operacion']) {
										case 1:	$op = "Entrada"; break;
										case 2:	$op = "Salida"; break;
									}
								echo "
								<tr>
									<td>".$row['cantidad']."</td>
									<td>".$op."</td>
									<td>".$row['fecha']."</td>
									<td>".$row['observacion']."</td>
								</tr>";
							 } ?>
						</tbody>
					</table>	
				</div>
            </div>
        </div>
      </div>
    </div>
            

	
</body>
</html>