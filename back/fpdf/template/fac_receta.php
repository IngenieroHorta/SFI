<?php

require('../fpdf.php');



    $pdf->SetFont('Arial', 'B', 30);
    // Movernos a la derecha
    $pdf->Cell(80);
    // Título
    $pdf->Cell(30, 10, utf8_decode('Botanika By Niño Prodigio'), 0, 0, 'C');
    $pdf->Ln(10);
    $pdf->Cell(70);
    $pdf->Cell(45, 10, '1175 Jerome Ave Bronx, NY 10452', 0, 0, 'C');
    $pdf->Ln(10);
    $pdf->Cell(70);
    $pdf->Cell(45, 10, '718 588-1407', 0, 0, 'C');
    $pdf->Ln(10);
    $pdf->Cell(70);
    $pdf->Cell(45, 10, 'Lunes a Viernes - 10am-8pm', 0, 0, 'C');
    $pdf->Ln(10);
    $pdf->Cell(70);
    $pdf->Cell(45, 10, 'Sabados                10am-7pm', 0, 0, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 30);

    $pdf->Ln(8);
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(0, 25, 0);
$pdf->Output();
