<?php 
require('../fpdf/fpdf.php');
include("../connect.php");

$START_DATE=$_POST['start_date'];
$END_DATE=$_POST['date'];


$link = mysqli_connect("localhost","root","","mbellorin");
$mysqli = new mysqli("localhost", "root", "", "mbellorin");
$query = "SELECT * FROM factura WHERE fecha BETWEEN '$START_DATE' AND '$END_DATE'";
$sql= " SELECT idfactura, fecha, idcliente,total from factura";
$sql2= " SELECT sum(total) as completo from factura WHERE fecha BETWEEN '$START_DATE' AND '$END_DATE'";
  

$resultado=$mysqli->query($query);
$r = mysqli_num_rows($resultado);
$resultado2=$mysqli->query($sql);
$r2 = mysqli_num_rows($resultado2);
$resultado3=$mysqli->query($sql2);
$r3 = mysqli_num_rows($resultado3);


$image1 = "../img/logo.png";

	$pdf = new FPDF();
	$pdf->AddPage('P','Letter');
	

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


	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(65,15,' ',0,0,'L',0);
	$pdf->Ln();


	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,12,('codigo'),1,0,'c');
	$pdf->Cell(60,12,'fecha',1,0,'c');
	$pdf->Cell(30,12,'cliente',1,0,'c');
	$pdf->Cell(20,12,'Total a pagar',1,0,'c');
	$pdf->Ln();



	//
	$pdf->SetFont('Arial','',12);
	
			if($r2>0){
		
        	while($row=$resultado2->fetch_assoc()){
			$pdf->Cell(10,12,$row['idfactura'],1,0,'c');
			$pdf->Cell(60,12,$row['fecha'],1,0,'c');
			$pdf->Cell(30,12,$row['idcliente'],1,0,'c');
			$pdf->Cell(20,12,$row['total'],1,0,'c');
			
			$pdf->Ln();
		}

	   }
	   
	
   	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,12,'sumatoria',1,0,'c');
	$aux=$resultado3->fetch_assoc();
	$pdf->Ln();




	$pdf->Output();
	

	$mysqli->close();
?>