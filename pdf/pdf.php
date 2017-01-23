<?php
define('FPDF_FONTPATH','/pdf/font/');

require_once 'fpdf.php';

$pdf = new FPDF();
$pdf->SetFont('Arial','',72);
$pdf->AddPage();
$pdf->Cell(40,10,"Hello World!",0,1);
//$pdf->Cell(80);
$pdf->Ln(100);
$pdf->Cell(40,10,'Title',0,1,'C');
$pdf->Output();