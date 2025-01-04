<?php
require_once 'fpdf186/fpdf.php'; // Asegúrate de que este archivo exista y esté correctamente ubicado
require_once 'models/conexion.php';

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        // Logo izquierda
        $this->Image('Img/logo.png', 10, 10, 30); // Ruta al logo izquierdo
        // Logo derecha
        $this->Image('Img/logfisei.png', 160, 10, 40); // Ruta al logo derecho
        // Título
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('REPORTE DE ESTUDIANTES 2025'), 0, 1, 'C');
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final de la página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

// Conexión a la base de datos
$conn = new Conexion();
$con = $conn->conectar();

$sqlSelect = "SELECT * FROM estudiantes";
$result = $con->query($sqlSelect);

// Crear PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Configurar idioma para la fecha
setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish'); // Asegúrate de que el sistema soporte esta configuración
date_default_timezone_set('America/Guayaquil');
$fecha = strftime('%A %d de %B del %Y'); // Formato: "sábado 04 de enero del 2025"
$fecha = utf8_decode($fecha); // Corregir problemas con caracteres especiales
$hora = date('h:i A');

// Mostrar fecha y hora
$pdf->Cell(0, 10, "Fecha: $fecha   Hora: $hora", 0, 1, 'R');
$pdf->Ln(10);

// Encabezado de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 200, 200); // Fondo gris para el encabezado
$pdf->Cell(40, 10, 'CEDULA', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'NOMBRE', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'APELLIDO', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'TELEFONO', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'DIRECCION', 1, 1, 'C', true);

// Datos de los estudiantes
$pdf->SetFont('Arial', '', 12);

while ($fila = $result->fetch_object()) {
    $cedula = $fila->CED_EST;
    $nombre = utf8_decode($fila->NOM_EST);
    $apellido = utf8_decode($fila->APE_EST);
    $telefono = $fila->TEL_EST;
    $direccion = utf8_decode($fila->DIR_EST);

    $pdf->Cell(40, 10, $cedula, 1, 0, 'C');
    $pdf->Cell(40, 10, $nombre, 1, 0, 'C');
    $pdf->Cell(40, 10, $apellido, 1, 0, 'C');
    $pdf->Cell(30, 10, $telefono, 1, 0, 'C');
    $pdf->Cell(40, 10, $direccion, 1, 1, 'C');
}

// Salida del PDF para mostrar en el navegador
$pdf->Output('I', 'Reporte_Estudiantes.pdf'); // Cambiado a 'I' para mostrar en navegador
?>
