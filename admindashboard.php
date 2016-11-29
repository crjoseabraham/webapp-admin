<?php 
//abrimos la sesión
session_start();

//Si la variable sesión está vacía
if (!isset($_SESSION['admin'])) {
//nos envía a la siguiente dirección en el caso de no poseer autorización
	header("location: index.php"); 
}
require("connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>ADMIN</title>
<meta charset="UTF-8">
<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
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
	width: 158px;
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
				        <li><a href="checklogout.php"><i class="fa fa-power-off"></i> <span class="hide-on-med-and-down">Salir del sistema </span></a></li>
				      </ul>
				    </div>
				</nav>
			</div>
			<div class="row">
			<ul class="tabs">
		        <li class="tab col s3"><a href="#tab1" title="Productos"><i class="fa fa-shopping-basket fa-lg"></i> <span class="hide-on-small-only">Productos</span></a></li>
				<li class="tab col s3"><a href="#tab2" title="Ventas"><i class="fa fa-dollar fa-lg"></i> <span class="hide-on-small-only">Pedidos</span></a></li>		        
		        <li class="tab col s3"><a href="#tab4" title="Proveedores"><i class="fa fa-users fa-lg"></i> <span class="hide-on-small-only">Proveedores</span></a></li>
		        <li class="tab col s3"><a href="#tab5" title="Clientes"><i class="fa fa-user fa-lg"></i> <span class="hide-on-small-only">Clientes</span></a></li>
		        <li class="tab col s3"><a href="#tab5-1" title="Citas"><i class="fa fa-clock-o fa-lg"></i> <span class="hide-on-small-only">Citas</span></a></li>
		        <li class="tab col s3"><a href="#tab6" title="Reportes"><i class="fa fa-book fa-lg"></i> <span class="hide-on-small-only">Reportes</span></a></li>
		    </ul>
		    </div>
	</div>


			<div id="tab5-1">
			<div class="row">
			    <div class="col l6 m6 s12">
			    <div class="row">
			    	<div class="col l6 m12 s12">
			        <div class="card" style="height: 380px; width: 430px;">			        	
			        <form name="cita" id="cita" action="inventario/cita.php" method="POST"></form>
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
												<form action='inventario/deletecita.php' method='post'>
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

			<div id="tab1">
				<div class="row">
				<div class="col l3 s12 m12">
					<div class="row">
					<div class="col l12 s12 m12">
				    <div class="card">
				    	<div class="card-content">
				      	<fieldset>
				      	<legend>Registrar un Producto</legend>
				      	<?php
						$get = "SELECT * FROM proveedor ORDER BY nombre_proveedor ASC";
						$resultado=$mysqli->query($get);
						$option = '';
						while($row=$resultado->fetch_assoc()){
						  $option .= '<option value = "'.$row['codigo_proveedor'].'">'.$row['codigo_proveedor'].' | '.$row['nombre_proveedor'].'</option>';
						}
						?>
						<form action="inventario/registro.php" method="post" style="font-size: 12px;">
						    <div class="row">
						      <div class="input-field col s4">
						        Código
						        <input type="number" id="Cod" name="codigo" class="validate" Required/>
						      </div>
						        
						      <div class="input-field col s8">
						        Descripción
						        <input type="text" id="Des" class="validate" maxlength="50" name="descripcion" Required/>
						      </div>
						    </div>
						    
						    <div class="row">
						      <div class="input-field col s6">
						        Stock
						        <input type="text" id="stock" name="stock" class="validate" pattern="[.0-9]+" maxlength="6" title="Ejemplo: 5.10" Required/>
						      </div>

						      <div class="input-field col s6">
						        Stock mínimo
						        <input type="text" id="stockmin" name="stockmin" class="validate" pattern="[.0-9]+" maxlength="6" title="Ejemplo: 5.10" value="2" Required/>
						      </div>
						    </div>

						    <div class="row">
						      <div class="input-field col s12">
						      	Tipo de unidad
						        <select name="tipoU">	          
						          <option value="" disabled selected="">Seleccione:</option>
						          <option value="M2">METROS CUADRADOS</option>
						          <option value="UND">UNIDAD</option>
						        </select>
						      </div>
						    </div>

						    <div class="row">
						      <div class="input-field col s4">
						        Costo unitario
						        <input type="number" id="cxu" name="cxu" pattern="[,0-9]+"  maxlength="10" class="validate" Required/>
						      </div>
						        
						      <div class="input-field col s4">
						      	Costo adicional
						        <input type="number" id="cad" name="cadd" class="validate"/>					         
						      </div>

						      <div class="input-field col s4">
								Precio compra
						      	<input type="number" id="pco" name="pcom" class="validate" readonly />						      
						      </div>
						    </div>    

						    <div class="row">
						      <div class="input-field col s6">
								Margen de ganancia (%)
						      	<input type="number" id="margen" name="margen" class="validate" value="30" max="60" Required/>
						      </div>

						      <div class="input-field col s6">
						        Subtotal<br>
						        <input type="number" id="subt" name="subtotal" class="validate" Required readonly /> 
						      </div>
						    </div>

						    <div class="row">
						      <div class="input-field col s6">
						      	IVA (%)
						        <input type="number" id="iva_producto" name="iva" class="validate" value="12" Required/>
						      </div>

						      <div class="input-field col s6">
						      	P.V.P
						        <input type="number" id="pvp_producto" name="pvp" class="validate" required readonly />				        
						      </div>
						    </div>

						    <div class="row">
						      <div class="input-field col s12">
						        <select name="provcod" id="proveedor" name="proveedor">
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
				</div>

				<div class="col l9 s12 m12">
					<div class="row">
				    <div class="card-panel">
				    	<fieldset>
				    	<legend>Buscador</legend>
				    	<div class="row">
  							<div class="col l12 s12">
  								<div class="input-field">
								<input type="text" id="buscarProd" placeholder="Buscar producto/material por código o descripción" />
								<br><br>
								<div id="tabla-busq-prod"></div>
								</div>
  							</div>
  						</div>
				    	</fieldset>
				     	<fieldset>
						<legend>Lista de productos registrados</legend>
						<div style="height: 235px; overflow: auto;">
						<?php include ('inventario/lista-productos.php'); ?>
						</div>
						</fieldset>
				    </div>
				    </div>			        
				</div>
				</div>		        
		    </div>


		    <div id="tab2">
		    	<div class="row">
				<div class="col l12 s12">
		        <div class="card">
			    	<div class="card-content">
			    	<fieldset>
			    	<legend><b>Buscar una factura</b></legend>
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
			    	<legend><b>Lista de facturas realizadas</b></legend>
  						<div class="row">
  							<div class="col l12 s12">
  							<div style="height: 400px; overflow: auto;">
  								<?php include('inventario/consultafactura.php'); ?>
  							</div>
  							</div>	
  						</div>
					</fieldset>
					</div>
				</div>
				</div>
				</div>
			</div>

		    <div id="tab4">
		    <div class="row">
			    <div class="col l4 s12 m12">

			    <div class="col l12 s12">
		        <div class="card">
			    	<div class="card-content">
			    	<fieldset>
			    	<legend><b>Buscar un proveedor</b></legend>
  						<div class="row">
  							<div class="col l12 s12">
  								<div class="input-field">
								<input type="text" id="buscarProveedor" placeholder="Buscar proveedor por RIF o nombre de la empresa" />
								<br><br>
								</div>
  							</div>	
  						</div>
  					</fieldset>
					</div>
				</div>
				</div>


			    <div class="row">
			    	<div class="col l12 s12 m12">
			        <div class="card">
			        	<div class="card-content">
			          	<fieldset>
			          		<legend>Registrar un Proveedor</legend>			          
						<form action="proveedores/registro.php" method="post">
					      <div class="row">
					        <div class="input-field col s12">
					        	<input id="codp" name="codp" type="text" pattern="^[V,E,P,G,J,C]\d{9}$" maxlength="10" class="validate" required>
					          	<label for="codp">Código</label>
					        </div>
					        <div class="input-field col s6">
					          <input id="nomp" name="nomp" type="text" maxlength="50" class="validate" required>
					          <label for="nomp">Nombre del proveedor</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s6">
					          <input id="tlfp" name="tlfp" type="text" pattern="^[0]\d{10}$" maxlength="11" class="validate" required>
					          <label for="tlfp"> Teléfono 1 </label>
					        </div>
					        <div class="input-field col s6">
					          <input id="tlfp2" name="tlfp2" type="text" pattern="^[0]\d{10}$" maxlength="11" title="Ejemplo: 04146140943" class="validate" required>
					          <label for="tlfp2"> Teléfono 2</label>
					        </div>					        
					        <div class="input-field col s6">
					          <input id="mailp" name="mailp" type="email"  maxlength="50" class="validate" required>
					          <label for="mailp">Email</label>
					        </div>
					      </div>
					      <div class="row">
					        <div class="input-field col s12">
					          <input id="dirp" name="dirp" type="text" maxlength="100" class="validate" required>
					          <label for="dirp">Direccion</label>
					        </div>
					      </div>
					      <div class="row">
					      	<div class="col s12">
					      	<button type="submit" class="waves-effect waves-light btn light-green"><i class="fa fa-pencil"></i> Registrar </button>
					      	</div>
					      </div>
						</form>
						</fieldset>
						</div>
			        </div>
			        </div>
			        </div>

			        <div class="row">
			        <div class="col l12 s12 m12">
					<div class="card">
			        	<div class="card-content">
			          	<fieldset>
			          		<legend>Modificar datos de un proveedor</legend>
			          		<?php include ('proveedores/actualizar-datos.php'); ?>
			          	</fieldset>						
						</div>
			        </div>
			        </div>
			        </div>
			    </div>

			    <div class="col l8 s12 m12">
			    	<div class="row">
			        <div class="card-panel" style="height: 400px;">
			         	<fieldset>
						<legend>Directorio de proveedores</legend>
						<div id="tabla-busqP"></div><br>
						<?php include ('proveedores/lista-proveedores.php'); ?>
						</fieldset>
			        </div>
			        </div>			        
			    </div>
			</div>
		    </div>

		<div id="tab5">
		    <div class="row">
			<div class="col l4 s12 m12">

			<div class="col l12 s12">
		        <div class="card">
			    	<div class="card-content">
			    	<fieldset>
			    	<legend><b>Buscar un cliente</b></legend>
  						<div class="row">
  							<div class="col l12 s12">
  								<div class="input-field">
								<input type="text" id="buscarCliente" placeholder="Buscar cliente por C.I. / RIF o nombre" />
								<br><br>
								</div>
  							</div>	
  						</div>
  					</fieldset>
					</div>
				</div>
				</div>


						   
			</div>

			<div class="col l8 s12 m12">
				<div class="row">
			    <div class="card-panel" style="height: 500px;">
			     	<fieldset>
					<legend>Lista de clientes</legend>
						<div style="height: 420px; overflow:auto;">
						<div id="tabla-busqC"></div><br>
						<table class="responsive-table">
						<thead>
						<tr>
						<th>C.I./RIF</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Teléfono 1</th>
						<th>Teléfono 2</th>
						<th>E-mail</th>
						<th>Dirección</th>

						</tr>
						</thead>	
						<tbody>
					<?php
					$getclientes = "SELECT * FROM cliente ORDER BY nombre_cliente ASC";
					$res=$mysqli->query($getclientes);
					while($row=$res->fetch_assoc()){				 
						echo "
						<tr>
						<td>".$row['idcliente']."</td>
						<td>".$row['nombre_cliente']."</td>
						<td>".$row['apellido_cliente']."</td>
						<td>".$row['tlfcelular_cliente']."</td>
						<td>".$row['tlf_2']."</td>
						<td>".$row['email']."</td>
						<td>".$row['direccion_cliente']."</td>
						</tr>";
						} ?>
						</tbody>
						</table>
						</div>						
					</fieldset>
			    </div>
			    </div>			        
			</div>
			</div>
		    </div>

		    <div id="tab6">
		       <div class="row">
			      <div class="col l12 s12 m12">
			        <div class="card-panel">
			        	<div class="row">
			        	<div class="col l6 s12 m6">
			          	<h5>Entradas y Salidas</h5>
			          	<ul class="collapsible" data-collapsible="accordion">
					    <li>
					      <div class="collapsible-header">Entradas por producto</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					     <li>
					      <div class="collapsible-header">Salidas por producto</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					       <li>
					      <div class="collapsible-header">Entradas por período</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					    <li>
					      <div class="collapsible-header">Salidas por período</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					      <li>
					      <div class="collapsible-header"> Ventas por periodo</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>	
					    <li>
					      <div class="collapsible-header"> Compras por periodo</div>
					      <div class="collapsible-body"><p><a class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>	


					    </ul>
					    </div>
					    <div class="col l6 s12 m5">
				        <h5>Inventario</h5>
				        <ul class="collapsible" data-collapsible="accordion">
					    <li>
					      <div class="collapsible-header"> Lista de productos</div>
					      <div class="collapsible-body"><p><a href="caja/vereporte_prod.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					    <li>
					      <div class="collapsible-header"> Lista de productos existentes</div>
					      <div class="collapsible-body"><p><a href="caja/vereporte_prodexis.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>

					    <li>
					      <div class="collapsible-header"> Lista de productos mas vendidos</div>
					      <div class="collapsible-body"><p><a href="caja/verpro_masven.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>

					    <li>
					      <div class="collapsible-header"> Lista de Productos con poca disponibilidad</div>
					      <div class="collapsible-body"><p><a href="caja/vereporte_prod_pocadisp.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>

					    </ul>

					    </div>
					   	</div>

					   	<div class="row">
					   	 <div class="col l6 s12 m6">
				        <h5>Pedidos</h5>
				        <ul class="collapsible" data-collapsible="accordion">
					    <li>
					      <div class="collapsible-header"> Aprobados</div>
					      <div class="collapsible-body"><p><a href="caja/verdetalle_factapro.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					    <li>
					      <div class="collapsible-header"> Pendientes</div>
					      <div class="collapsible-body"><p><a href="caja/verdetalle_factpend.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
					     <li>
					      <div class="collapsible-header"> Anulados</div>
					      <div class="collapsible-body"><p><a href="caja/verdetalle_factanul.php" class="btn blue">GENERAR REPORTE</a></p></div>
					    </li>
			      		</div>

			      		</div>
			        </div>
			      </div>			      
			    </div>
		    </div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.collapsible').collapsible({
		      accordion : false
		    });
			$('.modal-trigger').leanModal();
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

		$("#buscarProd").keyup(function(){
			$.ajax({
			type: "POST",
			url: "inventario/buscarProd.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#buscarProd").css("background","#FFF url(LoaderIcon.gif) no-repeat");
			},
			success: function(data){
				$("#tabla-busq-prod").show();
				$("#tabla-busq-prod").html(data);
				$("#buscarProd").css("background","#FFF");
			}
			});
			});

		});

		function selectFactura(val) {
		$("#buscarFactura").val(val);
		$("#suggesstion-box").hide();
		}

		//FUNCIONES BUSCAR PROVEEDOR

		$(document).ready(function(){
		$("#buscarProveedor").keyup(function(){
			$.ajax({
			type: "POST",
			url: "proveedores/buscarProveedor.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#buscarProveedor").css("background","#FFF url(LoaderIcon.gif) no-repeat");
			},
			success: function(data){
				$("#tabla-busqP").show();
				$("#tabla-busqP").html(data);
				$("#buscarProveedor").css("background","#FFF");
			}
			});
			});
		});

		function selectProveedor(val) {
		$("#buscarProveedor").val(val);
		$("#suggesstion-box").hide();
		}

		//FUNCIONES BUSCAR CLIENTE

$(document).ready(function(){
		$("#buscarCliente").keyup(function(){
			$.ajax({
			type: "POST",
			url: "caja/buscarCliente.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#buscarCliente").css("background","#FFF url(LoaderIcon.gif) no-repeat");
			},
			success: function(data){
				$("#tabla-busqC").show();
				$("#tabla-busqC").html(data);
				$("#buscarCliente").css("background","#FFF");
			}
			});
			});
		});

		function selectCliente(val) {
		$("#buscarProveedor").val(val);
		$("#suggesstion-box").hide();
		}

	</script>
</body>
</html>