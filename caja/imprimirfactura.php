<?php 
require('../fpdf/fpdf.php');
$Id =  $_POST['Id'];
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$query="SELECT cliente.*, factura.*
		FROM cliente 
		INNER JOIN factura
		ON cliente.idcliente = factura.idcliente 
		WHERE factura.idfactura = '$Id'";
$sql = "SELECT factura.*, factura_detalle.*
		FROM factura
		INNER JOIN factura_detalle 
		ON factura.idfactura = factura_detalle.idfactura
		WHERE factura.idfactura = '$Id'";
$resultado=$mysqli->query($query);
$r = mysqli_num_rows($resultado);
$resultado2=$mysqli->query($sql);
$r2 = mysqli_num_rows($resultado2);
$image1 = "../img/logo.png";
if($r>0){
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

	/*$pdf->Cell(65,15,'',0,0,'L');  // empty cell with left,bottom, and right borders
	$pdf->Cell(90,15,'',0,0,'L');
	/*$pdf->Cell(30,5,'#',1,0,'L');*/
	
	$aux=$resultado->fetch_assoc();
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(90,5,'Factura N#: '.$aux['idfactura'],0,1,'c');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(90,5,'Informacion Del Cliente',0,1,'c');
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(90,5,'Nombre del Cliente: '.$aux['nombre_cliente'].' '.$aux['apellido_cliente'],0,1,'c');
	$pdf->Cell(90,5,'RIF/CI: '.$aux['idcliente'],0,1,'c');
	$pdf->Cell(90,5,'Modalidad de Pago:',0,1,'c');
	$pdf->Ln();

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Cell(65,5,'FACTURA',0,0,'C');
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
	if($r2>0){
		while($row=$resultado2->fetch_assoc()){
			$pdf->Cell(10,12,$row['idarticulo'],1,0,'c');
			$pdf->Cell(60,12,$row['descripcion'],1,0,'c');
			$pdf->Cell(30,12,$row['precio'],1,0,'c');
			$pdf->Cell(20,12,$row['cantidad'],1,0,'c');
			$pdf->Cell(30,12,$row['unidad_tipo'],1,0,'c');
			$pdf->Cell(30,12,$row['importe'],1,1,'c');
		}
	}
	$pdf->Ln();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(80,5,'Importe: '.number_format($aux['importe'],2,',','.').' Bs.',0,1,'c');
	$pdf->Ln();
	$pdf->Cell(90,5,'Impuesto: '.number_format($aux['impuesto'],2,',','.').' Bs.',0,1,'c'); 
	$pdf->Ln();
	$pdf->Cell(90,5,'Total: '.number_format($aux['total'],2,',','.').' Bs.',0,1,'c'); 
	$pdf->Ln();
	$pdf->Output();
}

$mysqli->close();
?>