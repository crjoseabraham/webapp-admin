<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8" /> 
<title>Iniciar Sesión | SMB 1.0</title> 
<link rel="stylesheet" href="css/loginstyle.css">
<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script src="js/validar_campos.js"></script>

</head> 

<body> 
<hgroup>
  <center><img src="img/logo-lg.png"></a></center>
  <h1>Sistema Administrativo</h1>
  <h3>Marmolería Bellorin, C.A.</h3>
</hgroup>

<form name="form1" method="post" action="checklogin.php">
  <div class="group">
    <input name="username" type="text" id="username">
    <span class="highlight"></span><span class="bar"></span>
    <label>Usuario</label>
  </div>
  <div class="group">
    <input name="password" type="password" id="password">
    <span class="highlight"></span><span class="bar"></span>
    <label>Contraseña</label>
  </div>

  <input class="button buttonBlue" type="submit" name="Submit" value="Entrar"> 
</form>
<script src="js/index.js"></script>
</body> 
</html> 