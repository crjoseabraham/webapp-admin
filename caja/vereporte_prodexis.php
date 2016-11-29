<?php 
require('../fpdf/fpdf.php');
$Id =  'SELECT codigoart,descripcion,existencia,precio_venta,codigo_proveedor FROM articulo where existencia>=1 order by codigoart ASC';
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$resultado=$mysqli->query($Id);
$r = mysqli_num_rows($resultado);
$image1 = "../img/logo.png";
if($r>0){
	$pdf = new FPDF();
	$pdf->AddPage('P','Letter');
	$pdf->SetFont('Arial','',16);
	/*$pdf->Cell(65,1,' ',1,0,'L',0); */  // empty cell with left,top, and right borders
	$pdf->Cell(65,30,$pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 60.78),0,0,'c');
	$pdf->Ln();
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(25,5,'',0,0,'R');
	$pdf->Cell(25,-15,'RIF: J-31136509-5');
    $pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(150,30,'',0,0,'L');
	$pdf->Cell(40,5,'Fecha: '.date('d-m-Y'),0,0,'L');
    $pdf->Ln(10);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(75,30,'',0,0,'L');
	$pdf->Cell(90,18, utf8_decode('    REPORTE'),0,1,'c');
		
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(65,30,'',0,0,'L');
	$pdf->Cell(90,8,'PRODUCTOS EXISTENTES',0,1,'c');
	$pdf->Ln();

	//$pdf->Cell(22,30,'',0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,12,utf8_decode('Código'),1,0,'c');
	$pdf->Cell(120,12,utf8_decode('Descripción'),1,0,'c');
	$pdf->Cell(20,12,'Existencia',1,0,'c');
	$pdf->Cell(15,12,'P.V.P',1,0,'c');
	$pdf->Cell(25,12,'Proveedor',1,1,'c');

	$k=1;
	//$pdf->Cell(22,30,'',0,0,'L');
	$pdf->SetFont('Arial','',10);
	while($row=$resultado->fetch_assoc()){ 
		$pdf->Cell(20,12,$row['codigoart'],1,0,'c');
		$pdf->Cell(120,12,$row['descripcion'],1,0,'c');
		$pdf->Cell(20,12,$row['existencia'],1,0,'c');
		$pdf->Cell(15,12,$row['precio_venta'],1,0,'c');
		$pdf->Cell(25,12,$row['codigo_proveedor'],1,1,'c');		
		if($k==16){
			$pdf->AddPage('P','Letter');
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(0,10,'INVENTARIO DE TODOS LOS PRODUCTOS',0,1,'c');

			$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(20,12,utf8_decode('Código'),1,0,'c');
			$pdf->Cell(120,12,utf8_decode('Descripción'),1,0,'c');
			$pdf->Cell(20,12,'Existencia',1,0,'c');
			$pdf->Cell(15,12,'Precio Venta',1,0,'c');
			$pdf->Cell(25,12,'Proveedor',1,1,'c');
		}
		$k=$k+1;
	}

	$pdf->Output();
}

mysqli_close();
?>