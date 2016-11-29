<?php
include("../connect.php");
$Id = $_POST['Id'];

$get = "SELECT * FROM proveedor WHERE codigo_proveedor='$Id'";
$resultado=$mysqli->query($get);
while($row=$resultado->fetch_assoc()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title> Modificar datos de un proveedor </title>
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
          <i class="fa fa-pencil"></i> Modificar datos básicos de un proveedor</a>
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
                  <input type="text" id="codp" name="codp" class="validate" value="<?php echo $row['codigo_proveedor']; ?>" readonly Required/>
                  </div>

                  <div class="input-field col s8">
                  Nombre
                  <input type="text" id="nomp" class="validate" name="nomp" value="<?php echo $row['nombre_proveedor']; ?>" Required/>
                  </div>

                  <div class="input-field col s8">
                  Teléfono 1
                  <input type="text" pattern="^[0]\d{10}$"  title="Ejemplo: 04146140943" id="tlfp" class="validate" name="tlfp" value="<?php echo $row['tlf_proveedor']; ?>" Required/>
                  </div>

                  <div class="input-field col s8">
                  Teléfono 2
                  <input type="text" pattern="^[0]\d{10}$"  title="Ejemplo: 04146140943" id="tlfp2" class="validate" name="tlfp2" value="<?php echo $row['telf_2']; ?>" Required/>
                  </div>

                  <div class="input-field col s8">
                  E-mail
                  <input type="email" id="mailp" class="validate" name="mailp" value="<?php echo $row['email_proveedor']; ?>" Required/>
                  </div>

                   <div class="input-field col s8">
                  Dirección
                  <input type="text" maxlength="100" id="dirp" class="validate" name="dirp" value="<?php echo $row['direccion_proveedor']; ?>" Required/>
                  </div>

                  </div>

                  <center>
                  <button type="submit" class="btn btn-success blue" id="registrar">Guardar cambios</button>
                  </center>
                  </form>
            </div>  
        </div>
      </div>            
      </div>

</body>
</html>


<?php
}
?>
