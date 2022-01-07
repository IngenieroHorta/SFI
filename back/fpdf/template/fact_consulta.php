<?php

// require_once "../../Models/Fpdf.php";
require('../fpdf.php');

// C:\Users\robinsonh\Documents\sftp botanika\fpdf\fpdf.php
// C:\Users\robinsonh\Documents\sftp botanika\backBotanika\fpdf\template\fact_consulta.php
$host = '172.16.15.160';
$user = 'robinson';
$pass = 'Google123#';
$db = 'botanikagcb';
$x = new mysqli($host, $user, $pass, $db) or die($mysqli->error);


//$citas = new citas();
$query = "SELECT t1.*,t2.*,t1.id as n_cita
                    FROM citas t1
                    INNER JOIN client t2
                    ON t1.code_client = t2.code WHERE t1.id=" . $_GET['id'] . " ";
$datosreceta = $x->query($query);
// $row2=mysqli_fetch_assoc($datosreceta);

// $query2="SELECT * FROM pagos_cita WHERE id_cita=" . $_GET['id'] . " AND concepto_pago=" . $row2['2'] . "";
// Creación del objeto de la clase heredada
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

setlocale(LC_MONETARY, 'en_US');
$row = mysqli_fetch_assoc($datosreceta);
$query2 = "SELECT * FROM pagos_citas WHERE id_cita=" . $_GET['id'] . " AND concepto_pago='2'";
$datos_pagos = $x->query($query2);

if ($row['atendido'] == 1) {
    $cita_con = "VICTOR FLORENCIO";
} elseif ($row['atendido'] == 2) {
    $cita_con = "AGUSTINA";
}

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

$pdf->Ln(15);
$pdf->Cell(190, 1, '', 1, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 0, 'Orden #. BNP-' . $row['n_cita'], 0, 0, 'L');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 0, 'Cliente: ' . $row['firstname_c'] . " " . $row['lastname_c'], 0, 0, 'L');
$pdf->Ln(8);
$pdf->Cell(190, 1, '', 1, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 0, 'SERVICIO', 0, 0, 'L');
$pdf->Cell(-10, 0, 'PRECIO', 0, 0, 'R');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 0, 'CONSULTA CON : ' . $cita_con, 0, 0, 'L');
$pdf->Cell(-10, 0, "$" . money_format('%i', $row['total']), 0, 0, 'R');
$pdf->Ln(8);
$pdf->Cell(0, 0, 'FECHA DE CONSULTA : ' . $row['fecha_cita'], 0, 0, 'L');
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 0, 'HISTORIAL DE PAGO', 0, 0, 'L');
$pdf->Cell(-10, 0, 'MONTO', 0, 0, 'R');
while ($row2=mysqli_fetch_assoc($datos_pagos)) {
    if($row2['tipo_pago']==0){
        $tip_pago=" - EFC";
    }elseif ($row2['tipo_pago'] == 1) {
        $tip_pago = "- CC -XXX" . $row2['tarjeta'];
    }
    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(0, 0, $row2['fecha_registro'] . " " . $tip_pago, 0, 0, 'L');
    $pdf->Cell(-10, 0, "$" . money_format('%i', $row2['pago']), 0, 0, 'R');
}
$pdf->Ln(50);
$pdf->SetFont('Arial', 'B', 30);
$pdf->Cell(5);
$pdf->Cell(180, 10, 'BALANCE PENDIENTE: $' .  money_format('%i', $row['deuda']), 1, 0, 'C');




$pdf->Output();
