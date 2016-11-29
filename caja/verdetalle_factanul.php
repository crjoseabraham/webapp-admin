<?php 
require('../fpdf/fpdf.php');
$Id =  'ANULADA';
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$query="SELECT * FROM factura WHERE status = '$Id'";
$resultado=$mysqli->query($query);
$r = mysqli_num_rows($resultado);
$image1 = "../img/logo.png";
if($r>0){
	$pdf = new FPDF();
	$pdf->AddPage('P','Letter');
	$pdf->SetFont('Arial','',16);
	/*$pdf->Cell(65,1,' ',1,0,'L',0); */  // empty cell with left,top, and right borders
	$pdf->Cell(65,30,$pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 60.78),0,0,'c');
	$pdf->Ln();
	
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(140,30,'',0,0,'L');
	$pdf->Cell(40,5,'Fecha: '.date('d-m-Y'),0,0,'L');
    $pdf->Ln(10);

	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(65,30,'',0,0,'L');
	$pdf->Cell(90,18, utf8_decode('       REPORTES'),0,1,'c');
	
	
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(65,30,'',0,0,'L');
	$pdf->Cell(90,8,'FACTURAS ANULADAS',0,1,'c');
	$pdf->Ln();

	//$pdf->Cell(22,30,'',0,0,'L');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(30,12,utf8_decode('N° Factura'),1,0,'c');
	$pdf->Cell(42,12,'Fecha',1,0,'c');
	$pdf->Cell(30,12,'Cliente',1,0,'c');
	$pdf->Cell(30,12,'Cancelado',1,0,'c');
	$pdf->Cell(30,12,'Restante',1,0,'c');
	$pdf->Cell(30,12,'Total',1,1,'c');

	$k=1;
	//$pdf->Cell(22,30,'',0,0,'L');
	$pdf->SetFont('Arial','',12);
	while($row=$resultado->fetch_assoc()){ 
		$pdf->Cell(30,12,$row['idfactura'],1,0,'c');
		$pdf->Cell(42,12,$row['fecha'],1,0,'c');
		$pdf->Cell(30,12,$row['idcliente'],1,0,'c');
		$pdf->Cell(30,12,$row['ingreso'],1,0,'c');
		$pdf->Cell(30,12,$row['restante'],1,0,'c');		
		$pdf->Cell(30,12,$row['total'],1,1,'c');
		if($k==16){
			$pdf->AddPage('P','Letter');
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(0,18,'FACTURAS ANULADAS',0,1,'c');

			$pdf->Ln();
			$pdf->SetFont('Arial','B',14);
			$pdf->Cell(30,12,utf8_decode('N° Factura'),1,0,'c');
			$pdf->Cell(42,12,'Fecha',1,0,'c');
			$pdf->Cell(30,12,'Cliente',1,0,'c');
			$pdf->Cell(30,12,'Cancelado',1,0,'c');
			$pdf->Cell(30,12,'Restante',1,0,'c');
			$pdf->Cell(30,12,'Total',1,1,'c');
		}
		$k=$k+1;
	}

	$pdf->Output();
}

mysqli_close();
?>