<?php

require_once 'fpdf186/fpdf.php'; // Asegúrate de que este archivo exista y esté correctamente ubicado
require_once 'models/conexion.php';

// Conexión a la base de datos
$conn = new Conexion();
$con = $conn->conectar();

$sqlSelect = "SELECT * FROM estudiantes";
$result = $con->query($sqlSelect);

// Cambié la instancia de PDF a FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', "B", 8);
$pdf->Cell(150, 10, "Estudiantes Cuarto");
$pdf->Ln();
$pdf->Cell(40, 10, 'Cedula', 1);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(40, 10, 'Apellido', 1);
$pdf->Cell(40, 10, 'Telefono', 1);
$pdf->Cell(30, 10, 'Direccion', 1);
$pdf->Ln();

while($fila = $result ->fetch_object())
{
    $cedula=$fila->CED_EST;
    $nombre=$fila->NOM_EST;
    $apellido=$fila->APE_EST;
    $telefono=$fila->TEL_EST;
    $direccion=$fila->DIR_EST;
    $pdf->Cell(40, 10, $cedula, 1);
    $pdf->Cell(40, 10, $nombre, 1);
    $pdf->Cell(40, 10, $apellido, 1);
    $pdf->Cell(40, 10, $telefono, 1);
    $pdf->Cell(30, 10, $direccion, 1);
    $pdf->Ln();

}


$pdf->Output();

?>
