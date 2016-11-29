<?php 
//abrimos la sesión
session_start();

//Si la variable sesión está vacía
if (!isset($_SESSION['caja'])) {
//nos envía a la siguiente dirección en el caso de no poseer autorización
	header("location: index.php"); 
}
require("connect.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>CAJA</title>
<meta charset="utf-8">

<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="caja/ajax.js"></script>
<script type="text/javascript" src="js/jquery.simple-dtpicker.js"></script>

<link type="text/css" rel="stylesheet" href="css/materialize.css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link type="text/css" href="css/jquery.simple-dtpicker.css" rel="stylesheet" />

<style>
	@import "calendario/style.css";
	#suggestions-list{float: left;
	list-style: none;
	margin: 0;
	padding: 0;
	width: 100%;
	z-index: 9999 !important;
	height: 100px;
	overflow: auto;}
	#suggestions-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
	#suggestions-list li:hover{background:#F0F0F0;}
</style>
</head>
<body>
		
		<div class="col s12">
			<div class="row">
				<nav>
				    <div class="nav-wrapper">
				      <a href="#" class="brand-logo center"><img src="img/logo-1.png"></a>
				      <ul id="nav-mobile" style="height: inherit;" class="right">
				        <li><a href="checklogout.php"><i class="fa fa-power-off"></i> <span class="hide-on-med-and-down"> Salir del sistema </span></a></li>
				      </ul>
				    </div>
				</nav>
			</div>
			<div class="row">
			<ul class="tabs">
		        <li class="tab col s3"><a href="#tab1" title="Facturación"><i class="fa fa-credit-card-alt fa-lg"></i> <span class="hide-on-small-only">Facturación</span></a></li>
		        <li class="tab col s3"><a href="#tab2" title="Ventas"><i class="fa fa-list fa-lg"></i> <span class="hide-on-small-only">Pedidos</span></a></li>
		        <li class="tab col s3"><a href="#tab3" title="Citas"><i class="fa fa-clock-o fa-lg"></i> <span class="hide-on-small-only">Citas</span></a></li>
		        <li class="tab col s3"><a href="#tab4" title="Reportes"><i class="fa fa-book fa-lg"></i> <span class="hide-on-small-only">Reportes</span></a></li>
		    </ul>
		    </div>
		</div>

		<div class="container">
			<div id="tab1">
				<form name="factura" id="factura" action="registrofactura.php" method="POST"></form>
				<form name="form" id="form" method="POST" onsubmit="enviarDatosEmpleado(); return false"></form>
				<form name="cita" id="cita" action="caja/cita.php" method="POST"></form>
				<form name="buscaF" id="buscaF" action="" method="POST"></form>
				<div class="row">
					<div class="col l4 s12">
						<div class="col l12 s12">
					    <div class="card-panel hoverable">
					    <fieldset>
						<legend> <b>Datos del cliente</b></legend>
							<div class="row">
							<div class="input-field col l3 m1 s1">&nbsp;</div>
							<div class="input-field col l2 m2 s6">										
							    <select id="letra" class ="letra" name="letra" form="factura">
								<option value="V">V</option>
								<option value="E">E</option>
								<option value="P">P</option>
								<option value="G">G</option>
								<option value="J">J</option>
								<option value="C">C</option>
								</select>
								<label style="top: 2px; left: -48px; font-size: 13px;">C.I. / RIF</label>
							</div>

							<div class="input-field col l5 m3 s6">
							    <input id="iden" name="iden" type="text" class="validate" form="factura" min="1000000" pattern="[0-9]+" title="Solo se permiten NÚMEROS" required>
							    <label for="iden">N°</label>
							    <div id="sugerencias"></div>
							</div>							      
							</div>

							<div class="row">
					        <div class="input-field col l6 s6" style="margin-top: 0px;">
					        	Nombre
					        	<input id="nom" name="nom" type="text" class="validate" form="factura" pattern="[A-Za-z]+" title="Solo se permiten LETRAS" required>
					        </div>					        
					        <div class="input-field col l6 s6" style="margin-top: 0px;">
					        	Apellido
					          	<input id="ape" name="ape" type="text" class="validate" form="factura" pattern="[A-Za-z]+" title="Solo se permiten LETRAS" required>
					        </div>
					        </div>

					        <div class="row">
					        <div class="input-field col l6 s6" style="margin-top: 0px;">
					        	Teléfono
					          	<input id="telef" name="telef" type="text" class="validate" form="factura" pattern="[0-9]+" title="Solo se permiten NÚMEROS" required>
					        </div>
					        <div class="input-field col l6 s6" style="margin-top: 0px;">
					        	Teléfono 2 (opcional)
					          	<input id="telef2" name="telef2" type="text" class="validate" form="factura" pattern="[0-9]+" title="Solo se permiten NÚMEROS">
					        </div>
					        </div>

					        <div class="row">
					        <div class="input-field col l6 s6" style="margin-top: 0px;">
					          	Dirección
					          	<input id="direccion" name="direccion" type="text" class="validate" form="factura" required>
					        </div>
					       
					        <div class="input-field col l12 s12" style="margin-top: 0px;">
					          	Email (opcional)
					          	<input id="email_cliente" name="email_cliente" type="email" class="validate" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Formato e-mail inválido. Formato correcto: AAA123@BBB.DOMINIO" form="factura">
					        </div>
					        </div>					    
						</fieldset>
					    </div>
					    </div>					
						
					    <div class="col l12 s12">
				    	<div class="card-panel hoverable">
				        <fieldset>
						<legend> <b>Factura</b></legend>							
						<div class="row">
						<div class="input-field col l6 s6">
						        	<?php 
						        	$link = mysqli_connect("localhost","root","","mbellorin");
						        	$value = mysqli_query($link,"SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'mbellorin' AND   TABLE_NAME   = 'factura'") or die(mysqli_error($link));
						        	if ($value)
									{										   
									   while ($row=mysqli_fetch_row($value))
									   { echo "<input id='idfactura' name='idfactura' type='text' class='validate' readonly value='" .$row[0]. "'>"; }
									}
						        	?>
						    <label for="idfactura">Código de factura</label>
						</div>
						<div class="input-field col l6 s6">
						        	<?php echo "<input id='fecha' name='fecha' type='text' class='validate' readonly value='". date("d/m/Y") . "'>"; ?> 
						    <label for="fecha">Fecha</label>
						</div>
						</div>

						<div class="row">
						<div class="input-field col l6 s6">&nbsp;</div>
				        <div class="input-field col l6 s6">
					    	<select name="tipocom" form="factura">
					      		<option value="EXHIBICIÓN" selected>Exhibición</option>
					      		<option value="PEDIDO">Pedido</option>
					    	</select>
					    	<label style="top: 2px; left: -111px; font-size: 13px;">Tipo de compra</label>
					  	</div>
					  	</div>
						
						<div class="row">
						<div class="input-field col l6 s6">&nbsp;</div>
					  	<div class="input-field col l6 s6">
					        <select name="tipopago" form="factura">
					    		<option value="EFECTIVO" selected>Efectivo</option>
					      		<option value="CHEQUE">Cheque</option>
					      		<option value="TRANSFERENCIA">Transferencia</option>
					    	</select>
					    	<label style="top: 2px; left: -111px; font-size: 13px;">Tipo de pago</label>
					  	</div>	
					  	</div>						  
						</fieldset>
				        </div>
				      	</div>

				    </div>
			    	

			      		<div class="col l8 s12">
			      		<div class="row">
			        	<div class="card hoverable">
			        	<div class="card-content">
			        	<fieldset>
						<legend> <b>Detalle de factura</b></legend>					    
					        <div class="row">
					        <div class="input-field col l6 s3">
					        	Buscar por código o descripción
					        	<input id="codigo" name="codigo" type="text" class="validate" form="form" required>					          	
					          	<div id="suggesstion-box"></div>
					        </div>
							
							<div class="input-field col l2 s6">
					          	Cantidad
					          	<input id="cantidad" name="cantidad" type="text" class="validate" form="form" pattern="[.0-9]+" title="Solo se permiten NÚMEROS" required>					          	
					        </div>
							
							<button type="submit" name="Submit" form="form" class="waves-effect waves-light btn green col l1 s2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Agregar al carrito" style="text-align: initial; width: auto; height: auto;">
							<i class="fa fa-cart-plus"></i>
							</button>
							</div>

							<div class="row">
					        <div class="input-field col l6 s9">
					        	Descripción
					         	<input id="descripcion" name="descripcion" type="text" class="validate" form="form" readonly required>		      
					        </div>

					        <div class="input-field col l2 s6">
				          		P.V.P
				          		<input id="precio" name="precio" type="text" class="validate" form="form" readonly required>
				          	</div>

					        <div class="input-field col l3 s10">
					        	Unidad
					        	<input id="utp" name="utp" type="text" class="validate" form="form" readonly required>
					        </div>
					        </div>
					       	
					       	
						
						<div id="resultado" class="col l12 m12 s12">
						<?php include('caja/consulta.php');?>
						</div>
						<div class="input-field col s6">
				          	<i class="fa fa-money prefix"></i>
				          	<input id="ingreso" name="ingreso" type="number" class="validate" min="0" step="any" pattern="[0-9]+" title="Solo se permiten NÚMEROS" onkeyup="calcularrestante(this.value, document.getElementById('totals').value)" form="factura" style="height: 50px !important;font-size: 20px !important;text-align: right;" required>
				          	<label for="ingreso">Ingreso</label>
				        </div>
				        <div class="input-field col s6">
				          	<i class="fa fa-hand-paper-o prefix"></i>
				          	<input id="restante" name="resto" type="number" readonly form="factura" style="height: 50px !important;font-size: 20px !important;text-align: right; color:#000 !important;" placeholder="Restante">				          	
				        </div>
						</fieldset>
					    </div>			    
			        	</div>
			        	</div>
			      		</div>
				</div>

				<div class="row">
					<div class="col l3 m3 s6 offset-l7 offset-m4 offset-s3">
				    	<button type="submit" form="factura" class="waves-effect waves-light btn-large green accent-4" style="font-size:20px;" download /> Registrar </button>
				    </div>
				</div>

		    </div>

			<div id="tab2">
				<div class="col l12 s12">
		        <div class="card">
			    	<div class="card-content">
			    	<fieldset>
			    	<legend><b>Buscar un pedido</b></legend>
  						<div class="row">
  							<div class="col l12 s12">
  								<div class="input-field">
								<input type="text" id="buscarFactura" placeholder="Buscar factura por código o por C.I. / RIF del cliente" />
								<br><br>
								<div id="tabla-busq"></div>
								</div>
  							</div>	
  						</div>
  					</fieldset>
					</div>
				</div>
				</div>

				<div class="col l12 s12">
		        <div class="card">
			    	<div class="card-content">
			    	<fieldset>
			    	<legend><b>Lista de pedidos</b></legend>
  						<div class="row">
  							<div class="col l12 s12">
  							<div style="height: 400px; overflow: auto;">
  								<?php include('caja/consultafactura.php'); ?>
  							</div>
  							</div>	
  						</div>
					</fieldset>
					</div>
				</div>
				</div>
			</div>

			<div id="tab3">
			<div class="row">
			    <div class="col l6 m6 s12">
			    <div class="row">
			    	<div class="col l6 m12 s12">
			        <div class="card" style="height: 380px; width: 430px;">			        	
			        	<?php

							include("calendario/YourCalendar.php");
							include("calendario/functions.inc.php");
							mysql_connect('localhost',"root","");
							mysql_select_db("mbellorin");

							function viewDayEvents($result)
							{
							$return="<table class='responsive-table highlight'>
						        		<thead>
						        			<th>ID</th>
						        			<th>Fecha/Hora</th>
						        			<th>Descripción</th>
						        			<th></th>
						        		</thead>
						        		<tbody>";
							while ($row=mysql_fetch_array($result))
							{
								$return.="	<tr>
											<td>".$row['id']."</td>
											<td>".$row['date']."</td>
											<td>".$row['text']."</td>
											<td>
												<form action='caja/deletecita.php' method='post'>
												<input type='hidden' name='idcita' value='".$row['id']."' />
												<button type='submit' class='tooltipped btn-floating waves-effect waves-light deep-orange' name='submit-btn' data-position='left' data-delay='50' data-tooltip='Borrar cita' style='height: 30px;width: 30px;line-height: initial;'>
												<i class='fa fa-trash' style='font-size:20px;line-height: initial;'></i></button>
												</form>
											</td>
											</tr>
										";
							}
							$return.="	</tbody>
									</table>";
							return $return;
							}

							$cal=new YourCalendar('eventos','date','date,text,id','viewDayEvents',false,date('n'),date('Y'));
							echo "<div style=\"float:left\">";
							echo $cal->getCalendar();
							echo "</div>";
							?>
					</div>	
			        </div>
			    </div>			    	
			    </div>

		    	<div class="col l6 m12 s12">
		    	<div class="row">
		    	<div class="card" style="height:300px;">
		    	<div class="card-content">
		        	<?php
						echo "<div class=\"mostrarEventos\">";
						echo "<center>Citas del día: </center><br>";
						echo $cal->getDayEvents();
						echo "</div>";	
					?>
				</div>
				</div>
				</div>
				<div class="row">
		    	<div class="card" style="height:300px;">
		    	<div class="card-content">
		    	<fieldset>
		    	<legend>Programar Cita</legend>
		        	<div class="col l12 m12 s12">
		        		<div class="input-field col l12 s12">
		        			<i class="fa fa-calendar prefix"></i>
						    <input id="datecita" name="datecita" type="text" class="validate" form="cita" required>
							<script type="text/javascript">
								$(function(){
									$('*[name=datecita]').appendDtpicker({
										"futureOnly": true
									});
								});
							</script>
						</div>

						<div class="input-field col l12 s12">
					        <i class="fa fa-pencil prefix"></i>
					        <textarea id="textarea1" name="textarea1" class="materialize-textarea" form="cita"></textarea>
					        <label for="textarea1">Descripción</label>
				        </div>			        		
						<button class="btn waves-effect waves-light deep-orange col l12 s12" type="submit" form="cita">
							ENVIAR <i class="fa fa-send"></i>
							</button>
		        	</div>
				</fieldset>
				</div>
				</div>
				</div>
				</div>
			</div>
			</div>

			<div id="tab4">	
				<div class="row">
			      <div class="col l6 s12 m5">
			        <div class="card-panel">
			          <h4>Reportes de caja</h4>
			          <ul class="collapsible" data-collapsible="accordion">
					    <li>
					      <div class="collapsible-header"><i class="fa fa-dollar"></i> Ventas por período</div>
					      <div class="collapsible-body">
					      	<p><a class="btn blue">GENERAR REPORTE</a></p>
					      </div>
					    </li>
					    <li>
					      <div class="collapsible-header"><i class="fa fa-user"></i> Facturas por cliente</div>
					      <div class="collapsible-body">
					      	<?php
							$cli = "SELECT * FROM cliente ORDER BY nombre_cliente ASC";
							$resultado=$mysqli->query($cli);
							$optcli = '';
							while($row=$resultado->fetch_assoc()){
							  $optcli .= '<option value = "'.$row['idcliente'].'">'.$row['idcliente'].' | '.$row['nombre_cliente'].' '.$row['apellido_cliente'].' </option>';
							}
							?>
							<form action="caja/fporcli.php" method="POST">
							<div class="row">
						      <div class="input-field col s12">
						        <select name="cliente" id="cliente">
						          <?php echo $optcli; ?>
						        </select>
						        <label>Cliente</label>
						      </div>
						    </div>  
					      	<button type="submit" class="btn blue">GENERAR REPORTE</button>
							</form>
					      </div>
					    </li>
					    <li>
					      <div class="collapsible-header"><i class="fa fa-check"></i> Facturas pendientes</div>
					      <div class="collapsible-body"><p><a href="caja/verdetalle_factpend.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					    <li>
					      <div class="collapsible-header"><i class="fa fa-close"></i> Facturas anuladas</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					    </ul>
			        </div>
			      </div>
			      <div class="col l6 s12 m5">
			        <div class="card-panel">
			          <h4>Reportes de Citas</h4>
			          <ul class="collapsible" data-collapsible="accordion">
					    <li>
					      <div class="collapsible-header"><i class="fa fa-calendar"></i> Citas del mes</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					    <li>
					      <div class="collapsible-header"><i class="fa fa-list"></i> Lista completa</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>					    
					    </ul>
			        </div>
			      </div>
			    </div>			
			</div>
		</div>    

<script type="text/javascript">
	$(document).ready(function(){
		$(".button-collapse").sideNav();
		$('.modal-trigger').leanModal();
		$('select').material_select();
  		$('#textarea1').trigger('autoresize');
		$(".button-collapse").sideNav();
		$("#codigo").keyup(function(){
		$.ajax({
			type: "POST",
			url: "readCountry.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#codigo").css("background","#FFF url(img/LoaderIcon.gif) no-repeat 165px");
			},
			success: function(data){
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#codigo").css("background","#FFF");
			}
			});
		});
		$("#iden").keyup(function(){
		$.ajax({
			type: "POST",
			url: "buscarCliente.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#iden").css("background","#FFF url(img/LoaderIcon.gif) no-repeat 165px");
			},
			success: function(data){
				$("#sugerencias").show();
				$("#sugerencias").html(data);
				$("#iden").css("background","#FFF");
			}
			});
		});
		$(document).ready(function(){
		$("#buscarFactura").keyup(function(){
			$.ajax({
			type: "POST",
			url: "caja/buscarFactura.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#buscarFactura").css("background","#FFF url(LoaderIcon.gif) no-repeat");
			},
			success: function(data){
				$("#tabla-busq").show();
				$("#tabla-busq").html(data);
				$("#buscarFactura").css("background","#FFF");
			}
			});
			});
		});

	function selectFactura(val) {
	$("#buscarFactura").val(val);
	$("#suggesstion-box").hide();
	}

	})

	function selectCountry(val,val2,val3,val4) {
	$("#suggesstion-box").hide();
	$("#codigo").val(val);
	$("#cantidad").focus();
	$('#descripcion').val(val2);
	document.getElementById("descripcion").readonly = true;
    $('#precio').val(val3);
    document.getElementById("precio").readonly = true;
    $('#utp').val(val4);
    document.getElementById("utp").readonly = true;
	}

	function selectPersona(val,val2,val3,val4,val5,val6) {
	$("#sugerencias").hide();
	var letter = val.charAt(0);
	$('#letra option').filter(function(){
    return this.value == letter;
	}).prop("selected", true);
	$("#iden").val(val2);
	$('#nom').val(val3);
    $('#ape').val(val4);
    $('#telef').val(val5);
    $('#direccion').val(val6);
	}

	function calcularrestante (ingreso, total) {
	var restante = 0;
    restante = parseFloat(total).toFixed(2) - parseFloat(ingreso).toFixed(2);
    restante = restante.toFixed(2);
    if (restante < 0) {
    	$("#restante").val("");
    	document.getElementById("restante").placeholder = "Cambio: " + restante*-1;
    }
    else 
    	$("#restante").val(restante);
    	document.getElementById("restante").readonly = true;
    }

    function calculartotal (descuento, importe, impuesto) {
    if (descuento >= 0) {
    	var subtotal = parseFloat(importe) + parseFloat(impuesto);
		var total = subtotal - ((descuento / 100) * subtotal);
		total = total.toFixed(2);
	    $("#totals").val(total);
	    document.getElementById("totals").readonly = true;
    }
	
	}
</script>
</body>
</html>