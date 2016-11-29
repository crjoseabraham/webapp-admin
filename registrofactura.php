<?php
require('fpdf/fpdf.php');
include('connect.php');
$letra = $_POST['letra'];
$a = $letra . $_POST['iden'];
$b = $_POST['nom'];
$c = $_POST['ape'];
$d = $_POST['telef'];
$e = $_POST['direccion'];
$f = date('Y-m-d H:i:s');
$g = $_POST['tipocom'];
$h = $_POST['sum'];
$i = $_POST['impuesto'];
$j = $_POST['total'];
$k = $_POST['ingreso'];
$l = $_POST['email_cliente'];
$resto = $j - $k;
if ($resto == 0) 
	$m = "APROBADA";
if ($resto < 0) 
	$m = "APROBADA";
if ($resto > 0) 
	$m = "PENDIENTE";
$o = $_POST['tipopago'];
$p = $_POST['descuento'];
$q = $_POST['telef2'];
$link = mysqli_connect("localhost","root","","mbellorin");

mysqli_query($link,"INSERT IGNORE INTO cliente VALUES ('$a','$b','$c','$d','$q','$l','$e')") or die(mysqli_error($link));

mysqli_query($link,"INSERT INTO factura VALUES (null,'$f','$a','$h','$i','$j','$k','$resto','$m',null,'$o','$p')") or die(mysqli_error($link));
$id = mysqli_insert_id($link);

mysqli_query($link,"INSERT INTO factura_detalle (idarticulo, descripcion, cantidad, precio, unidad_tipo, importe) SELECT codigoarticulo, descripcion, cantidad, punit, unidad_tipo, importe from factura_auxiliar") or die(mysqli_error($link));

mysqli_query($link,"UPDATE factura_detalle SET idfactura = '$id' WHERE idfactura is null") or die(mysqli_error($link));

mysqli_query($link,"TRUNCATE TABLE factura_auxiliar") or die(mysqli_error($link));
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$query="SELECT *
		FROM factura_detalle 
		WHERE idfactura = '$id'";
$resultado=$mysqli->query($query);


	$image1 = "img/logo.png";
	$pdf = new FPDF();
	$pdf->AddPage('P','Letter');
	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Cell(65,15, utf8_decode('SENIAT'),0,0,'C');
	$pdf->Ln();

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Cell(65,5,'RIF: J-31136509-5',0,0,'C');
	$pdf->Ln();

	$pdf->SetFont('Arial','',14);
    $pdf->Cell(65,1,' ',0,0,'L',0);   // empty cell with left,top, and right borders
	$pdf->Cell(45,30,$pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 60.78),0,0,'C');
    $pdf->Ln();

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Cell(65,5,'Maracaibo: Barrio Indio Mara con Av.30A #32-11','R',1,'C',0);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Cell(70,5,'TELF: 0261-7446220',0,0,'C');
    $pdf->Ln();
	
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(90,5,'Factura N#: 0'.$id,0,1,'c');
    $pdf->Cell(90,5,utf8_decode('N° de control: 00-000'.$id),0,1,'c');
    $pdf->Cell(90,5,'Fecha/Hora: '.date('d-m-Y H:i:s'),0,1,'c');
    $pdf->Ln();
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(90,5,'Informacion Del Cliente',0,1,'c');
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(90,5,'Nombre del Cliente: '.$b.' '.$c,0,1,'c');
	$pdf->Cell(90,5,'RIF/CI: '.$letra.$a,0,1,'c');
	$pdf->Cell(90,5,'Modalidad de Pago: '.$g,0,1,'c');
	$pdf->Ln();

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Ln();


	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,12,('#'),1,0,'c');
	$pdf->Cell(60,12,'Producto',1,0,'c');
	$pdf->Cell(30,12,'Precio',1,0,'c');
	$pdf->Cell(20,12,'Cantidad',1,0,'c');
	$pdf->Cell(30,12,'Unidad',1,0,'c');
	$pdf->Cell(30,12,'Importe',1,0,'c');
	$pdf->Ln();
	

	//
	$pdf->SetFont('Arial','',12);
		while($row=$resultado->fetch_assoc()){
			$pdf->Cell(10,12,$row['idarticulo'],1,0,'c');
			$pdf->Cell(60,12,$row['descripcion'],1,0,'c');
			$pdf->Cell(30,12,$row['precio'],1,0,'c');
			$pdf->Cell(20,12,$row['cantidad'],1,0,'c');
			$pdf->Cell(30,12,$row['unidad_tipo'],1,0,'c');
			$pdf->Cell(30,12,$row['importe'],1,1,'c');
		}
	$pdf->Ln();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(80,5,'Importe: '.number_format($h,2,',','.').' Bs.',0,1,'c');
	$pdf->Ln();
	$pdf->Cell(90,5,'Impuesto: '.number_format($i,2,',','.').' Bs.',0,1,'c'); 
	$pdf->Ln();
	$pdf->Cell(90,5,'Total: '.number_format($j,2,',','.').' Bs.',0,1,'c'); 
	$pdf->Ln();
	$pdf->Output();
$mysqli->close();
?>